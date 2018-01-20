package gui;

import org.lwjgl.opengl.GL11;
import org.lwjgl.system.MemoryUtil;

import java.nio.FloatBuffer;

import static org.lwjgl.opengl.ARBVertexArrayObject.glBindVertexArray;
import static org.lwjgl.opengl.ARBVertexArrayObject.glGenVertexArrays;
import static org.lwjgl.opengles.GLES20.*;
import static org.lwjgl.system.MemoryUtil.memFree;

public class Renderer
{
        private Shader shader;
        private int vaoId;
        private int vboId;

        public void init() throws Exception
        {
                shader = new Shader();
                shader.link();
                float[] vertices = {
                        -0.5f, 0.5f, 0f,
                        0.5f, 0.5f, 0f,
                        0.5f, -0.5f, 0f,
                        -0.5f, -0.5f, 0f,
                };
                FloatBuffer verticesBuffer =
                        MemoryUtil.memAllocFloat(vertices.length);
                verticesBuffer.put(vertices).flip();
                vaoId = glGenVertexArrays();
                glBindVertexArray(vaoId);
                vboId = glGenBuffers();
                glBindBuffer(GL_ARRAY_BUFFER, vboId);
                glBufferData(GL_ARRAY_BUFFER, verticesBuffer, GL_STATIC_DRAW);
                memFree(verticesBuffer);
                glVertexAttribPointer(
                        0,
                        3,
                        GL_FLOAT,
                        false,
                        0,
                        0);
                glBindBuffer(GL_ARRAY_BUFFER, 0);
                glBindVertexArray(0);
                if (verticesBuffer != null)
                        MemoryUtil.memFree(verticesBuffer);
        }

        public void render()
        {
                glBindVertexArray(vaoId);
                glEnableVertexAttribArray(0);
                glDrawArrays(GL_TRIANGLES, 0, 3);
                glDisableVertexAttribArray(0);
                glBindVertexArray(0);
        }
}
