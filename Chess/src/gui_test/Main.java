package gui_test;

import org.lwjgl.glfw.GLFWVidMode;
import org.lwjgl.opengl.GL;
import org.lwjgl.opengles.GLES20;

import static org.lwjgl.glfw.GLFW.*;
import static org.lwjgl.opengl.GL11.*;
import static org.lwjgl.opengles.GLES20.glClear;

public class Main
{
        public static void main(String[] args)
        {
                if (!glfwInit())
                        throw new IllegalStateException("Failed to initialize GLFW");
                glfwWindowHint(GLFW_VISIBLE, GLFW_FALSE);
                long window = glfwCreateWindow(640, 480, "Title", 0, 0);
                if (window == 0)
                        throw new IllegalStateException("Failed to create window");
                GLFWVidMode videoMode = glfwGetVideoMode(glfwGetPrimaryMonitor());
                glfwSetWindowPos(window, (videoMode.width() - 640) / 2, (videoMode.height() - 480) / 2);
                glfwShowWindow(window);
                glfwMakeContextCurrent(window);
                GL.createCapabilities();
                glEnable(GL_TEXTURE_2D);
                float[] vertices = new float[] {
                        -0.5f, 0.5f, 0, // top left 0
                        0.5f, 0.5f, 0, //top right 1
                        0.5f, -0.5f, 0, //bottom right 2
                        -0.5f, -0.5f, 0, //bottom right 3
                };

                float[] texture = new float[] {
                        0, 0,
                        1, 0,
                        1, 1,
                        0, 1,
                };

                int[] indices = new int[] {
                        0, 1, 2,
                        2, 3, 0
                };
                Model model = new Model(vertices, texture, indices);
                Shader shader = new Shader("shader");
//                Texture tex = new Texture("/home/taciomcosta/Desktop/Resume/Chess/res/blackKing.png");
                while (!glfwWindowShouldClose(window)) {
                        if (glfwGetKey(window, GLFW_KEY_ESCAPE) == GL_TRUE) {
                                glfwSetWindowShouldClose(window, true);
                        }
                        glfwPollEvents();
                        glClear(GL_COLOR_BUFFER_BIT);
//                        tex.bind();
                        shader.bind();
                        model.render();
//                        glBegin(GL_QUADS);
//                                glTexCoord2f(0, 0);
//                                glVertex2f(-0.5f, 0.5f);
//                                glTexCoord2f(1, 0);
//                                glVertex2f(0.5f, 0.5f);
//                                glTexCoord2f(1, 1);
//                                glVertex2f(0.5f, -0.5f);
//                                glTexCoord2f(0, 1);
//                                glVertex2f(-0.5f, -0.5f);
//                        glEnd();
                        glfwSwapBuffers(window);
                }
                glfwTerminate();
        }
}
