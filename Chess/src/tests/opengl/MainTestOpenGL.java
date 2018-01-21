package tests.opengl;

import tests.opengl.Mesh.Mesh;

import java.awt.*;

import static org.lwjgl.glfw.GLFW.*;

public class MainTestOpenGL
{
        public static void main(String[] args)
        {
                int size = 600;
                Window window = new Window("TESTING MESHES", size, size);
                //Mesh texturedMesh = new TexturedMesh(vertices, indices,
                //        texCoords, "res/imgs/coin.png");
                //Mesh coloredMesh = new ColoredMesh(vertices, indices,
                //        new Color(255, 255, 255));
                Circle circle = new Circle();
                //Coin coin = new Coin();
                Mesh cube = MeshLoader.parseFile(
                        "res/models/cube.obj",
                        window,
                        new Color(255, 100, 100));
                float counter = 0;
                while (!window.shouldClose()) {
                        if (window.keyPressed(GLFW_KEY_ESCAPE))
                                window.setShouldClose(true);
                        window.update();
                        counter += 0.01f;
                        cube.draw();
                        if (window.keyPressed(GLFW_KEY_UP))
                                cube.rotateX(counter);
                        else if (window.keyPressed(GLFW_KEY_RIGHT))
                                cube.rotateY(counter);
                        //circle.draw();
                        //coin.translate((float) Math.sin(counter), 0f, 0f);
                        //coin.draw();

                }
        }
}
