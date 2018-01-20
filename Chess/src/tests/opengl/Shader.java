package tests.opengl;

import org.joml.Matrix4f;
import org.lwjgl.BufferUtils;

import java.io.BufferedReader;
import java.io.FileReader;
import java.nio.FloatBuffer;

import static org.lwjgl.opengl.GL11.GL_FALSE;
import static org.lwjgl.opengl.GL20.*;
import static tests.opengl.Shader.ShaderType.FRAGMENT;
import static tests.opengl.Shader.ShaderType.VERTEX;

public class Shader
{
        enum ShaderType {
                VERTEX,
                FRAGMENT
        };
        public int program;
        private int shaders[] = new int[2];


        public Shader(String fileName)
        {
                program = glCreateProgram();
                shaders[VERTEX.ordinal()] = createShader(
                        fileToString(fileName + ".vs"),
                        GL_VERTEX_SHADER);
                /* Now, our VERTEX SHADER was created */
                shaders[FRAGMENT.ordinal()] = createShader(
                        fileToString(fileName + ".fs"),
                        GL_FRAGMENT_SHADER
                );
                /* Now, our FRAGMENT SHADER was created */
                bindAttributeVariables();
                glLinkProgram(program);
                if (glGetProgrami(program, GL_LINK_STATUS) == GL_FALSE)
                        System.err.println("Error linking program");
                /* Now, our program was linked * */
                glValidateProgram(program);
                if (glGetProgrami(program, GL_VALIDATE_STATUS) == GL_FALSE)
                        System.err.println("Error validating program");
                /* Now, our program was compiled (validated)*/
        }


        private void bindAttributeVariables()
        {
                glBindAttribLocation(program, 0, "positions");
                glBindAttribLocation(program, 1, "texCoord");
                /* * Now, our shader variables were bound to VAO attributes */
        }


        private int createShader(String fileName, int shaderType)
        {
                int shaderId = glCreateShader(shaderType);
                if (shaderId == 0)
                        System.err.println("Error creating shader");
                glShaderSource(shaderId, fileName);
                glCompileShader(shaderId);
                if (glGetShaderi(shaderId, GL_COMPILE_STATUS) == GL_FALSE)
                        System.err.println("Error compiling shader" + glGetShaderInfoLog(shaderId));
                /* Now, our shader was created */
                glAttachShader(program, shaderId);
                /*
                * Now, our shader was attached to
                * the program (Shader Program Obj)
                * */
                return shaderId;
        }


        private String fileToString(String fileName)
        {
                StringBuilder builder = new StringBuilder();
                try {
                        FileReader reader = new FileReader(fileName);
                        BufferedReader br = new BufferedReader(reader);
                        String line;
                        while ((line = br.readLine()) != null) {
                                builder.append(line);
                                builder.append("\n");
                        }
                        br.close();
                } catch (Exception e) {
                        e.printStackTrace();
                }
                return builder.toString();
        }


        public void updatePositions(Matrix4f modelMatrix)
        {
                FloatBuffer buff = BufferUtils.createFloatBuffer(16); // 4x4
                int transform = glGetUniformLocation(program, "transform");
                glUniformMatrix4fv(transform, false, modelMatrix.get(buff));
        }


        public void bind()
        {
                glUseProgram(program);
        }


        public int getProgram()
        {
                return this.program;
        }
}
