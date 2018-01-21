package tests.opengl.Mesh;

import tests.opengl.Shader;

import java.awt.*;
import java.nio.FloatBuffer;
import java.nio.IntBuffer;

import static org.lwjgl.opengl.GL11.*;
import static org.lwjgl.opengl.GL15.GL_ARRAY_BUFFER;
import static org.lwjgl.opengl.GL15.GL_ELEMENT_ARRAY_BUFFER;
import static org.lwjgl.opengl.GL20.glGetUniformLocation;
import static org.lwjgl.opengl.GL20.glUniform3f;
import static org.lwjgl.opengl.GL30.glBindVertexArray;
import static org.lwjgl.opengl.GL30.glGenVertexArrays;
import static tests.opengl.Mesh.Mesh.VertexBufferType.*;


public class ColoredMesh extends Mesh
{
        private Color color;


        // TODO include color uniform variable DONE
        // TODO create shader properly
        public ColoredMesh(FloatBuffer vertices, IntBuffer indices, Color color)
        {
                shader = new Shader("src/tests/opengl/res/coloredShader");
                buffers[POSITION.ordinal()] = vertices;
                buffers[ELEMENT.ordinal()] = indices;
                this.color = color;
                vao = glGenVertexArrays();
                glBindVertexArray(vao);
                /// POSITIONS
                generateBuffer(GL_ARRAY_BUFFER,
                        GL_FLOAT,
                        POSITION.ordinal(),
                        COORDS);
                /// INDICES
                generateBuffer(GL_ELEMENT_ARRAY_BUFFER,
                        GL_UNSIGNED_INT,
                        ELEMENT.ordinal(),
                        COORDS);
                //glUniform3f(colors,
                //color.getRed() / 255f,
                //color.getGreen() / 255f,
                //color.getBlue() / 255f);
                /*
                * Now, the chosen color was sent to our uniform variable
                * in our vertex shader
                * */
                glBindVertexArray(0);
        }


        public void draw()
        {
                shader.bind();
                shader.updatePositions(transform.getModel());
                int colors =
                        glGetUniformLocation(shader.getProgram(), "inColors");
                glUniform3f(
                        colors,
                        this.color.getRed() / 255f,
                        this.color.getGreen() / 255f,
                        this.color.getBlue() / 255f);
                glBindVertexArray(vao);
                glDrawElements(
                        GL_TRIANGLES,
                        buffers[ELEMENT.ordinal()].remaining(),
                        GL_UNSIGNED_INT, 0);
                //glDrawArrays(GL_TRIANGLES, 0, vertices.size() / coords);
                glBindVertexArray(0);
        }
}
