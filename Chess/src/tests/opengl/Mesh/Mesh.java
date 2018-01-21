package tests.opengl.Mesh;

import org.joml.Vector3f;
import tests.opengl.Shader;
import tests.opengl.Transform;

import java.nio.Buffer;
import java.nio.FloatBuffer;
import java.nio.IntBuffer;

import static org.lwjgl.opengl.GL20.*;
import static org.lwjgl.opengl.GL11.*;
import static org.lwjgl.opengl.GL15.*;
import static org.lwjgl.opengl.GL30.glGenVertexArrays;
import static tests.opengl.Mesh.Mesh.VertexBufferType.*;


public abstract class Mesh
{
        protected enum VertexBufferType {
                POSITION,
                TEXTURE,
                ELEMENT, // indices
                NUM_VBOS
        }
        protected Shader shader;
        protected Transform transform = new Transform();
        protected int vao;
        private int vbos[] = new int[NUM_VBOS.ordinal()];
        protected Buffer buffers[] = new Buffer[NUM_VBOS.ordinal()];
        protected static final int COORDS = 3;


        public Mesh(){}


        /*
        * @param bufferType: GL_ARRAY_BUFFER, GL_ELEMENT_ARRAY_BUFFER
        * @param dataType: GL_FLOAT, GL_UNSIGEND_INT
        * @param index: is used as VBO, VAO and 'buffers' reference
        * @param elementsPerVertex: is used in glVertexAttribPointer()
        * */
        protected void generateBuffer(int bufferType, int dataType,
                                   int index, int elementsPerVertex)
        {
                vbos[index] = glGenBuffers();
                glBindBuffer(bufferType, vbos[index]);
                // Now, our VBO was generated and bound to the VAO
                if (dataType == GL_FLOAT)
                        glBufferData(bufferType,
                                (FloatBuffer) buffers[index],
                                GL_STATIC_DRAW);
                else
                        glBufferData(bufferType,
                                (IntBuffer) buffers[index],
                                GL_STATIC_DRAW);
                // Now, our data was sent to the VBO
                glEnableVertexAttribArray(index);
                glVertexAttribPointer(index, elementsPerVertex,
                        dataType, false, 0, 0);
                // Now, the VAO element corresponding to our vbo was enabled
        }


        public abstract void draw();


        public void translate(float x, float y, float z)
        {
                this.transform.translate(x, y, z);
        }


        public void scale(float x, float y, float z)
        {
                this.transform.scale(x, y, z);
        }


        public void rotate(float x, float y, float z)
        {
                this.transform.rotate(x, y, z);
        }


        public void translateX(float x)
        {
                Vector3f pos = this.transform.getPos();
                transform.translate(x, pos.y, pos.z);
        }


        public void translateY(float y)
        {
                Vector3f pos = this.transform.getPos();
                transform.translate(pos.x, y, pos.z);
        }


        public void translateZ(float z)
        {
                Vector3f pos = this.transform.getPos();
                transform.translate(pos.x, pos.y, z);
        }


        public void rotateX(float x)
        {
                Vector3f rot = this.transform.getRot();
                transform.rotate(x, rot.y, rot.z);
        }


        public void rotateY(float y)
        {
                Vector3f rot = this.transform.getRot();
                transform.rotate(rot.x, y, rot.z);
        }


        public void rotateZ(float z)
        {
                Vector3f rot = this.transform.getRot();
                transform.rotate(rot.x, rot.y, z);
        }


        public void scaleX(float x)
        {
                Vector3f scale = this.transform.getScale();
                transform.scale(x, scale.y, scale.z);
        }


        public void scaleY(float y)
        {
                Vector3f scale = this.transform.getScale();
                transform.scale(scale.x, y, scale.z);
        }


        public void scaleZ(float z)
        {
                Vector3f scale = this.transform.getScale();
                transform.scale(scale.x, scale.y, z);
        }


}
