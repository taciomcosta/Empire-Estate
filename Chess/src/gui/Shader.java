package gui;

import java.io.BufferedReader;
import java.io.File;
import java.io.FileReader;
import java.io.IOException;

import static org.lwjgl.opengl.GL20.*;
import static org.lwjgl.opengles.GLES20.GL_FALSE;
import static org.lwjgl.opengles.GLES20.glCreateProgram;

public class Shader
{
        private int programId;
        private int vertexShaderId;
        private int fragmentShaderId;

        public Shader() throws Exception
        {
                programId = glCreateProgram();
                if (programId == 0)
                        throw new Exception("Couldn't create program");
                vertexShaderId =
                        createVertexShader(readFile("src/gui/vertex.vs"));
                fragmentShaderId =
                        createFragmentShader(readFile("src/gui/fragment.fs"));
                bind();
        }

        public String readFile(String fileName)
        {
                StringBuilder string = new StringBuilder();
                BufferedReader br;
                try {
                        br = new BufferedReader(
                                new FileReader(
                                        new File(fileName)
                                )
                        );
                        String line;
                        while ((line = br.readLine()) != null)
                                string.append(line + "\n");
                        br.close();
                } catch (IOException e) {
                        e.printStackTrace();
                }
                return string.toString();

        }

        public int createVertexShader(String shaderCode) throws Exception
        {
                return createShader(shaderCode, GL_VERTEX_SHADER);
        }

        public int createFragmentShader(String shaderCode) throws Exception
        {
                return createShader(shaderCode, GL_FRAGMENT_SHADER);
        }

        public int createShader(String shaderCode, int shaderType)
                throws Exception
        {
                int shaderId = glCreateShader(shaderType);
                if (shaderId == 0)
                        throw new Exception("Couldn't create shader");
                glShaderSource(shaderId, shaderCode);
                glCompileShader(shaderId);
                if (glGetShaderi(shaderId, GL_COMPILE_STATUS) == GL_FALSE)
                        throw new Exception("Couldn't compile shader" +
                                glGetShaderInfoLog(shaderId, 1024));
                glAttachShader(programId, shaderId);
                return shaderId;
        }


        public void link() throws Exception
        {
                glBindAttribLocation(programId, 0, "vertices");
                glLinkProgram(programId);
                if (glGetProgrami(programId, GL_LINK_STATUS) == GL_FALSE)
                        throw new Exception("Error linking program: " +
                                glGetProgramInfoLog(programId));
                if (vertexShaderId != 0)
                        glDetachShader(programId, vertexShaderId);
                if (fragmentShaderId != 0)
                        glDetachShader(programId, fragmentShaderId);
                glValidateProgram(programId);
                if (glGetProgrami(programId, GL_VALIDATE_STATUS) == GL_FALSE)
                        System.err.println("Error validating program: " +
                                glGetProgramInfoLog(programId));
        }

        public void bind()
        {
                glUseProgram(programId);
        }

        public void unbind()
        {
                glUseProgram(0);
        }

        public void cleanup()
        {
                unbind();
                if (programId != 0)
                        glDeleteProgram(programId);
        }

}
