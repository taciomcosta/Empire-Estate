package gui;

import org.lwjgl.opengl.GL;

import static org.lwjgl.glfw.GLFW.*;

public class GUI
{
        static Window window;
        static Renderer renderer;

        public static void main(String[] args)
        {
                window = new Window();
                renderer = new Renderer();
                try {
                        renderer.init();
                } catch (Exception e) {
                        System.err.println("SHAZAM");
                        e.printStackTrace();
                }
                while (!window.isCloseRequested()) {
                        renderer.render();
                        glfwPollEvents();
                        glfwSwapBuffers(window.getId());
                }
                window.close();
        }

}

