package thebennybox;

import org.lwjgl.BufferUtils;
import java.nio.FloatBuffer;

import static thebennybox.Mesh.Type.*;
import static org.lwjgl.opengl.GL11.*;
import static org.lwjgl.opengl.GL15.*;
import static org.lwjgl.opengl.GL20.*;
import static org.lwjgl.opengl.GL30.glBindVertexArray;
import static org.lwjgl.opengl.GL30.glGenVertexArrays;


public class Mesh
{
        private int vao;
        private int[] vbos;


        public Mesh(float[] vertices, float[] textures)
        {
                vao = glGenVertexArrays();
                vbos = new int[2];
                glBindVertexArray(vao);
                // Now, the VAO was generated and attached to the shader program
                glGenBuffers(vbos);
                // Now, we allocated memory (buffers) on the GPU for having
                // a considerable amount of data for positions and textures
                glBindBuffer(GL_ARRAY_BUFFER, vbos[POSITIONS_VB.ordinal()]);
                FloatBuffer pos_buffer = toFloatBuff(vertices);
                glBufferData(GL_ARRAY_BUFFER, pos_buffer, GL_STATIC_DRAW);
                glEnableVertexAttribArray(0);
                glVertexAttribPointer(0, 3, GL_FLOAT, false, 0, 0);
                // Now, the position buffer was set and the position data
                // (pos_buffer) was sent to the buffer.
                glBindBuffer(GL_ARRAY_BUFFER, vbos[TEXCOORD_VB.ordinal()]);
                FloatBuffer tex_buffer = toFloatBuff(textures);
                glBufferData(GL_ARRAY_BUFFER, tex_buffer, GL_STATIC_DRAW);
                glEnableVertexAttribArray(1);
                glVertexAttribPointer(1, 2, GL_FLOAT, false, 0, 0);
                // Now, the texture buffer was set and the texture data
                // (tex_buffer) was sent to the buffer.
                glBindVertexArray(0);
                // Now, the VAO was detached to the program
        }


        public Mesh(float[] vertices)
        {
                vao = glGenVertexArrays();
                vbos = new int[1];
                glBindVertexArray(vao);
                glGenBuffers(vbos);
                glBindBuffer(GL_ARRAY_BUFFER, vbos[0]);
                FloatBuffer positions = toFloatBuff(vertices);
                glBufferData(GL_ARRAY_BUFFER, positions, GL_STATIC_DRAW);
                glEnableClientState(0);
                glVertexAttribPointer(0, 3, GL_FLOAT, false, 0, 0);
                glBindVertexArray(0);
        }


        public void draw()
        {
                glBindVertexArray(vao);
                glDrawArrays(GL_TRIANGLES, 0, 3);
                // Now, we asked the GPU to draw our shape
                glBindVertexArray(0);
        }


        public FloatBuffer toFloatBuff(float[] arr)
        {
                FloatBuffer buffer = BufferUtils.createFloatBuffer(arr.length);
                buffer.put(arr);
                buffer.flip();
                return buffer;
                // Now, the data was converted to the specified type (FloatBuff)
        }


        public enum Type {
                POSITIONS_VB,
                TEXCOORD_VB
        }
}
