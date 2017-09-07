/* SIMPLE CHAT SERVER USING CHILD PROCESS WITH FORK */
/*
  BLAB Stages
  Bind to a port
  Listen
  Accept Connection
  Begin Talk
 */
/* TODO SIGINT -> close() ????????????????? */

#include <stdio.h>              /* fprintf() */
#include <stdlib.h>             /* exit() */
#include <sys/socket.h>         /* socket() */
#include <unistd.h>
#include <errno.h>              /* errno */
#include <string.h>             /* strerrno() */
#include <arpa/inet.h>          /* bind() */
#include <pthread.h>
#include <limits.h>

#define MAX_CLIENTS 10

typedef struct client_t {
        int desc;
        char name[255];
} client_t;

int clients_no = 0;
client_t clients[MAX_CLIENTS];

/* main socket listener for the server */
int parent_d;

void error(char *msg)
{
        fprintf(stderr, "%s : %s\n", msg, strerror(errno));
        exit(1);
}

/* ==== CONNECTIONS ISSUES ==== */
void open_listener_socket()
{
        /* create socket descriptor */
        parent_d = socket(PF_INET, SOCK_STREAM, 0);
        /* check for error */
        if (parent_d == -1)
                error("Can't open socket");
}

void bind_to_port(int descriptor, int port)
{
        /* structure used to specify a local/remote end-point to connect to*/
        struct sockaddr_in name;
        name.sin_family = PF_INET;
        name.sin_port = (in_port_t) htons(port);
        name.sin_addr.s_addr = htonl (INADDR_ANY);
        /* define reuse before 30s */
        int reuse = 1;
        if (setsockopt(descriptor,
                       SOL_SOCKET,
                       SO_REUSEADDR,
                       (char *) &reuse,
                       sizeof(int)) == -1)
                error("Can't set reuse option on the socket");
        /* bind to port */
        int c = bind(parent_d, (struct sockaddr *) &name, sizeof(name));
        /* check for error */
        if (c == -1)
                error("Can't bind socket");
}

void set_listen()
{
        listen(parent_d, MAX_CLIENTS);
        puts("Waiting to connect...");
}

int accept_connection()
{
        struct sockaddr_storage client_addr;
        unsigned int address_size = sizeof(client_addr);
        return accept(parent_d,
                      (struct sockaddr*) &client_addr,
                      &address_size);
}

long enqueue_client(char *name, int descriptor)
{

        /* set new client */
        client_t c;
        strcpy(c.name, name);
        c.desc = descriptor;
        /* enqueue client */
        clients[clients_no] = c;
        ++clients_no;
        return clients_no - 1;
}

void dequeue_client(int descriptor)
{
        int i;
        /* find client pos in clients array */
        for (i = 0; i < clients_no; ++i)
                if (clients[i].desc == descriptor)
                        break;
        /* remove client by pulling all next elements back */
        while (i < clients_no - 1)
                clients[i + 1] = clients[i];
        /* decrease number of clients online */
        --clients_no;
}

int is_connected(int desc)
{
        /* for each client available */
        for (int i = 0; i < clients_no; ++i)
                /* check if it has the same descriptor (is connected) */
                if (clients[i].desc == desc)
                        return 1;
        /* if client is not connected */
        return 0;
}

/* ==== INPUT/OUTPUT ==== */
void send_msg_to_all(int sender_id, char *buffer_in)
{
        for (int i = 0; i < clients_no; ++i) {
                /* if it's not the sender */
                if (i != sender_id)
                        /* send message */
                        if (send(clients[i].desc,
                                 buffer_in,
                                 strlen(buffer_in),
                                 0) == -1)
                                error("Can't send message");
        }
}

int read_in(int socket, char *buf, int len)
{
        /* clean buffer */
        char *sbuf = buf;
        int c = recv(socket, sbuf, len, 0);
        int alreadyRead = c;
        /* check for error or SIGINT */
        if (c <= 0) {
                strcpy(buf, "\\q");
                return 1;
        }
        /* while packets are sent */
        while (c == len) {
                c = recv(socket, sbuf, len, 0);
                sbuf += c;
                alreadyRead += c;
        }
        /* NOTE: change \r => \0 (only for telnet, uncomment line below)*/
        /* buf[alreadyRead - 2] = 0; */
        /* put null char in buffer */
        buf[alreadyRead] = '\0';
        /* print log */
        printf("Message sent by client %i\n", socket);
        return 0;
}

void get_name(int child_d, char name[], int len)
{
        /* vars */
        char buffer_in[255] = "Insert your name: ";
        /* get name */
        if (send(child_d, buffer_in, strlen(buffer_in), 0) == - 1)
                error("Can't get name");
        read_in(child_d, name, len);
}

/* ==== USERS COMMANDS ==== */
int show_online_users(int child_d)
{
        char buffer_in[255];
        sprintf(buffer_in, "\n==== USERS ONLINE (%c) ====\n", clients_no + 48);
        /* for each client connected */
        for (int i = 0; i < clients_no; ++i) {
                strcat(buffer_in, "- ");
                strcat(buffer_in, clients[i].name);
                strcat(buffer_in, "\n");
        }
        strcat(buffer_in, "==========================\n\n");
        /* send message to client */
        if (send(child_d, buffer_in, strlen(buffer_in), 0) == -1)
                error("Can't inform online users");
        return 1;
}

int show_help_list(int child_d)
{
        /* format buffer */
        char buffer_in[255];
        strcpy(buffer_in, "\n\n==== HELP ====\n");
        strcat(buffer_in, "\\u - online users\n");
        strcat(buffer_in, "\\q - quit\n");
        strcat(buffer_in, "\\h - help\n");
        strcat(buffer_in, "==============\n");
        /* send message */
        if (send(child_d, buffer_in, strlen(buffer_in), 0) == -1)
                error("Can't send help list");
        return 1;
}

int disconnect_client(int child_d)
{
        dequeue_client(child_d);
        close(child_d);
        return 1;
}

int run_command(char *msg, int child_d)
{
        /* help */
        if (!strcmp(msg, "\\h"))
                return show_help_list(child_d);
        /* users online */
        if (!strcmp(msg, "\\u"))
                return show_online_users(child_d);
        /* disconnection */
        if (!strcmp(msg, "\\q"))
                return disconnect_client(child_d);
        return 0;
}

/* ==== THREAD TO HANDLE EACH CLIENT ==== */
void *handle_client(void* c_d)
{
        /* cast socket descriptor */
        int child_d = (int) (long) c_d;
        /* get client name */
        char name[255] = "Client";
        get_name(child_d, name, sizeof(name));
        /* create new client structure and enqueue */
        long id = enqueue_client(name, child_d);
        printf("> %s connected\n", name);
        /* format name */
        strcpy(name, "[");
        strcat(name, clients[id].name);
        strcat(name, "]: ");
        /* show help list */
        show_help_list(child_d);
        /* loop forever :) */
        while (1) {
                /* check if client is still connected */
                if (!is_connected(child_d))
                        break;
                /* read message */
                char buffer_out[255];
                read_in(clients[id].desc, buffer_out, sizeof(buffer_out));
                if (run_command(buffer_out, child_d))
                        continue;
                /* set buffer to send message */
                char buffer_in[255] = {0};
                strcat(buffer_in, name);
                strcat(buffer_in, buffer_out);
                strcat(buffer_in, "\n");
                /* send message to all clients */
                send_msg_to_all(id, buffer_in);
        }
        return NULL;
}

int main(void)
{
        int port = 30000;
        open_listener_socket();
        bind_to_port(parent_d, port);
        set_listen();
        while (1) {
                /* socket for child */
                long child_d = accept_connection();
                /* create a thread to handle client */
                pthread_t t0;
                pthread_create(&t0, NULL, handle_client, (void *)child_d);
                /* threads can't be joined, because it won't allow other people to
                   connect */
        }
        return 0;
}
