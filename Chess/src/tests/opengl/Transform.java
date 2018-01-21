/*
* There are three kinds of motion: translation, rotation and scaling
* This class is intended to provide those kinds of motion to an object
* */
package tests.opengl;

import org.joml.Matrix4f;
import org.joml.Vector3f;

public class Transform
{
        private Vector3f pos;
        private Vector3f rot;
        private Vector3f scale;


        public Transform()
        {
                this.pos = new Vector3f();
                this.rot = new Vector3f();
                this.scale = new Vector3f(1.0f, 1.0f, 1.0f);
        }


        public Transform(Vector3f pos, Vector3f rot, Vector3f scale)
        {
                this.pos = pos;
                this.rot = rot;
                this.scale = scale;
        }


        public Matrix4f getModel()
        {
                return new Matrix4f()
                        .translate(this.pos)
                        .rotateXYZ(this.rot)
                        .scale(this.scale);
        }


        public void translate(float x, float y, float z)
        {
                this.pos.x = x;
                this.pos.y = y;
                this.pos.z = z;
        }


        public void scale(float x, float y, float z)
        {
                this.scale.x = x;
                this.scale.y = y;
                this.scale.z = z;
        }


        public void rotate(float x, float y, float z)
        {
                this.rot.x = x;
                this.rot.y = y;
                this.rot.z = z;
        }


        public Vector3f getPos()
        {
                return this.pos;
        }


        public Vector3f getScale()
        {
                return this.scale;
        }


        public Vector3f getRot()
        {
                return this.rot;
        }
}
