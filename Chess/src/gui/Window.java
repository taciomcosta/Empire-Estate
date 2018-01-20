package gui;

import org.lwjgl.opengl.GL;

import static org.lwjgl.glfw.GLFW.*;
import static org.lwjgl.opengl.GL11.GL_FALSE;
import static org.lwjgl.opengl.GL11.GL_TRUE;
import static org.lwjgl.opengl.GL11.glViewport;

public class Window
{
        private long windowId;
        private static final int WIDTH = 600;
        private static final int HEIGHT = 600;

        public Window()
        {
                if (!glfwInit()) {
                        System.err.println("Eror initializing GLFW");
                        System.exit(1);
                }
                windowId = glfwCreateWindow(
                         WIDTH,
                         HEIGHT,
                        "Test",
                        0,
                        0);
                if (windowId == 0) {
                        System.err.println("Error creating windowId");
                        System.exit(1);
                }
                glfwWindowHint(GLFW_SAMPLES, 4);
                glfwWindowHint(GLFW_CONTEXT_VERSION_MAJOR, 3);
                glfwWindowHint(GLFW_CONTEXT_VERSION_MINOR, 2);
                glfwWindowHint(GLFW_OPENGL_FORWARD_COMPAT, GL_TRUE);
                glfwWindowHint(GLFW_OPENGL_PROFILE, GLFW_OPENGL_CORE_PROFILE);
                glfwWindowHint(GLFW_RESIZABLE, GL_FALSE);
                glfwMakeContextCurrent(windowId);
                GL.createCapabilities();
                glfwSwapInterval(1);
        }

        public long getId()
        {
                return windowId;
        }

        public void close()
        {
                glfwDestroyWindow(windowId);
                glfwTerminate();
        }

        public boolean isCloseRequested()
        {
                return glfwWindowShouldClose(windowId);
        }

}
