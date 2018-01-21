package tests.opengl;

import org.lwjgl.BufferUtils;
import tests.opengl.Mesh.ColoredMesh;

import java.awt.*;
import java.nio.FloatBuffer;
import java.nio.IntBuffer;


public class Circle
{
        private FloatBuffer vertices;
        private IntBuffer indices;
        private ColoredMesh mesh;
        private static float RATIO_W = 600f/6000f;
        private static float RATIO_H = 600f/600f;
        private static float RATIO_D = 600f/600f;


        public Circle()
        {
                float radius = 0.3f;
                this.vertices = BufferUtils.createFloatBuffer(361 * 3);
                this.indices = BufferUtils.createIntBuffer(359 * 3);
                // VERTICES
                vertices.put(0f * RATIO_W);
                vertices.put(0f * RATIO_H);
                vertices.put(0f * RATIO_D);
                for (int i = 0; i < 360; ++i) {
                        vertices.put((float) Math.cos(i) * radius * RATIO_W);
                        vertices.put((float) Math.sin(i) * radius * RATIO_H);
                        vertices.put(0f * RATIO_D);
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
                // MESH
                this.mesh = new ColoredMesh(
                        this.vertices,
                        this.indices,
                        new Color(255, 255, 255));
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
