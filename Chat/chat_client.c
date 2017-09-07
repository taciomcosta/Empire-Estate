/*CLIENT PROGRAM FOR CHATROOM */
#include <stdio.h>              /* fprintf() */
#include <stdlib.h>             /* exit() */
#include <sys/socket.h>         /* socket() */
#include <arpa/inet.h>          /* ?? */
#include <errno.h>              /* errno */
#include <string.h>             /* strerror */
#include <netdb.h>              /* getaddrinfo() */
#include <unistd.h>             /* close() */
#include <pthread.h>
#include <signal.h>

/* global socket descriptor */
int d_sock;

void error(char *msg)
{
        fprintf(stderr, "%s: %s\n", msg, strerror(errno));
        exit(1);
}

/* ==== CONNECTION ISSUES ==== */
int open_socket(char *host, char *port)
{
        struct addrinfo *res;
        struct addrinfo hints;
        memset(&hints, 0, sizeof(hints));
        hints.ai_family = PF_UNSPEC;
        hints.ai_socktype = SOCK_STREAM;
        if (getaddrinfo(host, port, &hints, &res) == -1)
                error("Can't resolve the address");
        int d_sock = socket(res->ai_family, res->ai_socktype, res->ai_protocol);
        if (d_sock == -1)
                error("Can't open socket");
        int c = connect(d_sock, res->ai_addr, res->ai_addrlen);
        freeaddrinfo(res);
        if (c == -1)
                error("Can't connect to socket");
        return d_sock;
}

void finish_connection()
{
        /* send msg for server close its socket */
        char *buf = "\\q";
        if (send(d_sock, buf, strlen(buf), 0) == -1)
                error("Can't send message to server");
        /* finish connection */
        puts("\nConnection closed :) ");
        close(d_sock);
        /* exit with no errors */
        exit(0);
}

/* ==== INPUT/OUTPUT ==== */
void *read_in()
{
        while (1) {
                /* vars */
                int len = 255;
                char buf[255];
                int c = recv(d_sock, buf, len, 0);
                /* while packets are sent */
                while (c == len) {
                        printf("%s", buf);
                        c = recv(d_sock, buf, len, 0);
                }
                /* check for error */
                if (c < 0)
                        return NULL;
                /* last print */
                buf[c] = 0;
                printf("%s", buf);
        }
        return NULL;
}

void *send_in()
{
        while (1) {
                /* vars */
                int len = 255;
                char buf[len];
                fgets(buf, len, stdin);
                /* remove trailling '\n' */
                if (buf[strlen(buf) - 1] == '\n')
                        buf[strlen(buf) - 1] = '\0';
                /* send message */
                if (send(d_sock, buf, strlen(buf), 0) == -1)
                        error("Can't send message to server");
        }
        return NULL;
}

/* ==== SIGACTIONS REGISTER ==== */
int catch_signal(int sig, void (*handler) (int))
{
        /* create sigaction */
        struct sigaction action;
        /* inform which function shoud be called */
        action.sa_handler = handler;
        /* mask  */
        sigemptyset(&action.sa_mask);
        /* additional flags */
        action.sa_flags = 0;
        /* register sigaction */
        return sigaction(sig, &action, NULL);
}

int main(int argc, char *argv[])
{
        /* register finish connection to SIGINT (CTRL + C) */
        if (catch_signal(SIGINT, finish_connection) == -1)
                error("Error registering finish_connection");
        /* open socket according to parameters settings*/
        if (argc == 3)
                d_sock = open_socket(argv[1], argv[2]);
        else
                d_sock = open_socket("127.0.0.1", "30000");
        /* first read for getting name */
        read_in();
        /* create threads for receiving and sending data at the same time */
        pthread_t t0;
        pthread_t t1;
        pthread_create(&t0, NULL, read_in, NULL);
        pthread_create(&t1, NULL, send_in, NULL);
        /* join threads so program must wait to finish */
        void *result;
        pthread_join(t0, &result);
        pthread_join(t1, &result);
        /* close connection */
        close(d_sock);
        return 0;
}
