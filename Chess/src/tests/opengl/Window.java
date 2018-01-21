package tests.opengl;

import static org.lwjgl.glfw.GLFW.*;

import org.lwjgl.glfw.GLFWVidMode;

import static org.lwjgl.opengl.GL.createCapabilities;
import static org.lwjgl.opengl.GL11.*;

public class Window
{
        public static final float DEFAULT_WIDTH = 600f;
        public static final float DEFAULT_HEIGHT = 600;
        private long windowId;
        private int width;
        private int height;


        public Window(String title, int width, int height)
        {
                this.width = width;
                this.height = height;
                glfwInit();
                windowId = glfwCreateWindow(width, height, title, 0, 0);
                glfwMakeContextCurrent(windowId);
                createCapabilities();
                // Now, a window was created in foreground and supported by
                // the given hardware
                GLFWVidMode video = glfwGetVideoMode(glfwGetPrimaryMonitor());
                int xpos = video.width() / 2 - width / 2;
                int ypos = video.height() / 2 - height / 2;
                glfwSetWindowPos(windowId, xpos, ypos);
                // Now, the window is centralized
        }


        void update()
        {
                glfwPollEvents();
                glfwSwapBuffers(windowId);
                clear();
        }


        private void clear()
        {
                glClearColor(0.1f, 0.1f, 0.3f, 0.5f);
                glClear(GL_COLOR_BUFFER_BIT | GL_DEPTH_BUFFER_BIT);
        }


        public boolean keyPressed(int key)
        {
                return glfwGetKey(windowId, key) == 1;
        }


        boolean shouldClose()
        {
                return glfwWindowShouldClose(windowId);
        }


        public void setShouldClose(boolean b)
        {
                glfwSetWindowShouldClose(windowId, b);
        }


        public int getWidth()
        {
                return this.width;
        }


        public int getHeight()
        {
                return this.height;
        }
}
