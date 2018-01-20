package thebennybox;

import org.joml.Matrix4f;
import org.lwjgl.BufferUtils;

import java.io.BufferedReader;
import java.io.File;
import java.io.FileReader;
import java.io.IOException;
import java.nio.FloatBuffer;

import static thebennybox.Shader.Uniforms.NUM_UNIFORMS;
import static thebennybox.Shader.Uniforms.TRANSFORM_U;
import static org.lwjgl.opengl.GL11.GL_FALSE;
import static org.lwjgl.opengl.GL20.*;

public class Shader
{
        enum Uniforms {
                TRANSFORM_U,
                NUM_UNIFORMS
        };

        private int program;
        private int shaders[] = new int[2];
        private int uniforms[] = new int[NUM_UNIFORMS.ordinal()];


        public Shader(String fileName)
        {
                program = glCreateProgram();
                shaders[0] = createShader(
                        castFileToString(fileName + ".vs"),
                        GL_VERTEX_SHADER);
                shaders[1] = createShader(
                        castFileToString(fileName + ".fs"),
                        GL_FRAGMENT_SHADER);
                for (int i = 0; i < 2; ++i)
                        glAttachShader(program, shaders[i]);
                // Now, our shaders (vertex and fragment) are created and
                // attached to the Shader Program Object
                glBindAttribLocation(program, 0, "position");
                glBindAttribLocation(program, 1, "texCoord");
                // Now, position and texture data are associated with the
                // variables in the Vertex Shader
                glLinkProgram(program);
                if (glGetProgrami(program, GL_LINK_STATUS) == GL_FALSE) {
                        System.err.println("Error linking program");
                        System.err.println(glGetProgramInfoLog(program));
                }
                glValidateProgram(program);
                if (glGetProgrami(program, GL_VALIDATE_STATUS) == GL_FALSE)
                        System.err.println("Error validating program");
                uniforms[TRANSFORM_U.ordinal()] =
                        glGetUniformLocation(program, "transform");
        }


        public void update(Transform transform)
        {
                FloatBuffer fb = BufferUtils.createFloatBuffer(16);
                Matrix4f model = transform.getModel();
                glUniformMatrix4fv(
                        uniforms[TRANSFORM_U.ordinal()],
                        false,
                        model.get(fb));
                // Now, our Model Matrix was sent to the uniform variable in our
                // shader
        }




        private int createShader(String text, int shaderType)
        {
                int shader = glCreateShader(shaderType);
                if (shader == 0)
                        System.err.println("Error creating shader");
                glShaderSource(shader, text);
                glCompileShader(shader);
                if (glGetShaderi(shader, GL_COMPILE_STATUS) == GL_FALSE)
                        System.err.println("Error compiling program");
                return shader;
                // Now, some kind of shader is created and compiled
        }


        private String castFileToString(String fileName)
        {
                StringBuilder string = new StringBuilder();
                BufferedReader br;
                try {
                        br = new BufferedReader(
                                new FileReader(new File(fileName)));
                        String line;
                        while ((line = br.readLine()) != null) {
                                string.append(line);
                                string.append("\n");
                        }
                        br.close();
                } catch (IOException e) {
                        e.printStackTrace();
                }
                return string.toString();
                // Now, a shader source code is formatted as a string
        }


        public void bind()
        {
                glUseProgram(program);
        }
}
