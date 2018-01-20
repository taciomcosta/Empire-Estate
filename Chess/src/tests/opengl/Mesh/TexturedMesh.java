package tests.opengl.Mesh;

import tests.opengl.Shader;
import tests.opengl.Texture;

import java.nio.FloatBuffer;
import java.nio.IntBuffer;

import static org.lwjgl.opengl.GL11.*;
import static org.lwjgl.opengl.GL15.GL_ARRAY_BUFFER;
import static org.lwjgl.opengl.GL15.GL_ELEMENT_ARRAY_BUFFER;
import static org.lwjgl.opengl.GL20.glGetUniformLocation;
import static org.lwjgl.opengl.GL30.glBindVertexArray;
import static org.lwjgl.opengl.GL30.glGenVertexArrays;
import static tests.opengl.Mesh.Mesh.VertexBufferType.*;

public class TexturedMesh extends Mesh
{
        private Texture texture;


        // TODO create shader properly
        public TexturedMesh(FloatBuffer vertices, IntBuffer indices,
                    FloatBuffer texCoords, String textureFilePath)
        {
                this.shader = new Shader("src/tests/opengl/res/texturedShader");
                this.buffers[POSITION.ordinal()] = vertices;
                this.buffers[ELEMENT.ordinal()] = indices;
                this.buffers[TEXTURE.ordinal()] = texCoords;
                this.texture = new Texture(textureFilePath);
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
                /// TEXTURES
                generateBuffer(GL_ARRAY_BUFFER,
                        GL_FLOAT,
                        TEXTURE.ordinal(),
                        2);
                glBindVertexArray(0);
        }


        public void draw()
        {
                this.shader.bind();
                this.shader.updatePositions(this.transform.getModel());
                this.texture.bind(0);
                glBindVertexArray(vao);
                glDrawElements(
                        GL_TRIANGLES,
                        buffers[ELEMENT.ordinal()].remaining(), //remaining??
                        GL_UNSIGNED_INT, 0);
                //glDrawArrays(GL_TRIANGLES, 0, vertices.size() / coords);
                glBindVertexArray(0);
        }
}
