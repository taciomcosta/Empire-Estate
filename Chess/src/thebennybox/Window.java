package thebennybox;

import org.lwjgl.glfw.GLFWVidMode;
import org.lwjgl.opengl.GL11;

import static org.lwjgl.glfw.GLFW.*;
import static org.lwjgl.opengl.GL.createCapabilities;
import static org.lwjgl.opengl.GL11.GL_COLOR_BUFFER_BIT;

public class Window
{
        private long windowId;


        public Window(String title, int width, int height, boolean centralized)
        {
                glfwInit();
                windowId = glfwCreateWindow(width, height, title, 0, 0);
                glfwMakeContextCurrent(windowId);
                // Now the GPU data corresponding to our program won't be messy
                // with the other programs data.
                createCapabilities();
                if (centralized) {
                        GLFWVidMode videoMode =
                                glfwGetVideoMode(glfwGetPrimaryMonitor());
                        glfwSetWindowPos(
                                windowId,
                                (videoMode.width() - width) / 2,
                                (videoMode.height() - height) / 2);
                        // Now, our window is centralized
                }
        }


        public boolean keyPressed(int key)
        {
                return glfwGetKey(windowId, key) == GLFW_TRUE;
        }


        private void clear()
        {
                GL11.glClearColor(0f, 0.15f, 0.3f, 1f);
                // Now, a color was defined as the default color for clearing
                // the screen with the glClear().
                GL11.glClear(GL_COLOR_BUFFER_BIT);
                // Now, the color buffer is clear.
                // It means that the results of the previous iteration of the
                // main loop are not being exhibit anymore.
        }


        public void update()
        {
                glfwPollEvents();
                // Now, events in the event queue were processed
                glfwSwapBuffers(windowId);
                // Now, the buffer that contains the info sent by us
                // is being displayed
                clear();
        }


        public void setShouldClose(boolean b)
        {
                glfwSetWindowShouldClose(windowId, b);
        }


        public boolean shouldClose()
        {
                return glfwWindowShouldClose(windowId);
        }


        public long getId()
        {
                return this.windowId;
        }
}
