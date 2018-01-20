package thebennybox;

import org.joml.Vector3f;
import org.lwjgl.opengl.GL11;

import static org.lwjgl.glfw.GLFW.*;
import static org.lwjgl.opengl.GL11.*;

public class MainOpenGL
{
        static float[] vertices = {
                -0.5f, -0.5f, 0f,
                0f,    0.5f, 0f,
                0.5f, -0.5f, 0f,
        };
        static float[] textures = {
                0.0f, 0f,
                0.5f, 1f,
                1.0f, 0f,
        };

        static float[] v2 = {
                -0.500000f, -0.500000f, 0.500000f,
                0.500000f, -0.500000f, 0.500000f,
                -0.500000f, 0.500000f, 0.500000f,
                 0.500000f, 0.500000f, 0.500000f,
                 -0.500000f, 0.500000f, -0.500000f,
                 0.500000f, 0.500000f, -0.500000f,
                 -0.500000f, -0.500000f, -0.500000f,
                 0.500000f, -0.500000f, -0.500000f
        };


        public MainOpenGL()
        {
                Window window = new Window("Chess coming soon", 800, 600, true);
                Mesh mesh = new Mesh(vertices, textures);
                Shader shader = new Shader("src/thebennybox/res/basicShader");
                Texture texture = new Texture("res/imgs/menuBG.png");
                Transform transform = new Transform();
                float counter = 0.0f;
                while (!window.shouldClose()) {
                        if (window.keyPressed(GLFW_KEY_ESCAPE)) //OK
                                window.setShouldClose(true); //OK
                        float cos = (float) Math.cos(counter); //OK
                        float sin = (float) Math.sin(counter); //OK
                        transform.setScale(new Vector3f(cos, cos, cos)); //
                        transform.getPos().x = sin; //
                        transform.getRot().z = counter * 20; //
                        shader.bind(); // OK
                        texture.bind(0); // OK
                        shader.update(transform); //
                        mesh.draw(); // OK
                        window.update(); // OK
                        // Now, all things above window.update() were showed,
                        // then the screen was cleaned.
                        counter += 0.01f;
                }
        }

        /* OLD OPENGL WAY OF RENDERING THINGS (deprecated)*/
        public static void drawTable() {
                float tiles = 4;
                float c = 1 / tiles;
                float color = 0;
                glBegin(GL11.GL_TRIANGLES);
                for (float i = -1; i < 1; i += c) {
                        for (float j = -1; j < 1; j += c) {
                                glColor3f(color, color, color);
                                glVertex3f(j, i, 0f);
                                glVertex3f(j, i + c, 0f);
                                glVertex3f(j + c, i + c, 0f);
                                glVertex3f(j, i, 0f);
                                glVertex3f(j + c, i, 0f);
                                glVertex3f(j + c, i + c, 0f);
                                if (color == 0)
                                        color = 1f;
                                else
                                        color = 0f;
                        }
                        if (color == 0)
                                color = 1f;
                        else
                                color = 0f;
                }
                glEnd();
        }


        public static void main(String[] args)
        {
                new MainOpenGL();
        }
}
