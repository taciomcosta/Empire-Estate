package tests.opengl;

import org.lwjgl.BufferUtils;
import tests.opengl.Mesh.ColoredMesh;
import tests.opengl.Mesh.TexturedMesh;

import java.awt.*;
import java.nio.FloatBuffer;
import java.nio.IntBuffer;

public class Coin
{
        private FloatBuffer vertices;
        private FloatBuffer texCoords;
        private IntBuffer indices;
        private TexturedMesh mesh;


        public Coin()
        {
                float radius =  0.3f;
                this.vertices = BufferUtils.createFloatBuffer(361 * 3);
                this.indices = BufferUtils.createIntBuffer(359 * 3);
                this.texCoords = BufferUtils.createFloatBuffer(361 * 2);
                // VERTICES
                vertices.put(0f);
                vertices.put(0f);
                vertices.put(0f);
                for (int i = 0; i < 360; ++i) {
                        vertices.put((float) Math.cos(i) * radius);
                        vertices.put((float) Math.sin(i) * radius);
                        vertices.put(0f);
                }
                vertices.flip();
                // INDICES
                for (int i = 1; i < 359; ++i) {
                        indices.put(0);
                        indices.put(i);
                        indices.put(i + 1);
                }
                indices.put(0);
                indices.put(359);
                indices.put(1);
                indices.flip();
                // TEXCOORDS
                texCoords.put(0.5f);
                texCoords.put(0.5f);
                for (int i = 0; i < 360; ++i) {
                        texCoords.put((float) (Math.cos(i) + 1) / 2);
                        texCoords.put((float) (Math.sin(i) + 1) / 2);
                }
                texCoords.flip();
                // MESH
                this.mesh = new TexturedMesh(
                        this.vertices,
                        this.indices,
                        this.texCoords,
                        "res/imgs/coin.png");
        }


        public void draw()
        {
                mesh.draw();
        }


        public void translate(float x, float y, float z)
        {
                mesh.translate(x, y, z);
        }
}
