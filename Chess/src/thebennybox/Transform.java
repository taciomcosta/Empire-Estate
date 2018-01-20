/*
* There are three kinds of motion: translation, rotation and scaling
* This class is intended to provide those kinds of motion to an object
* */
package thebennybox;

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


        public Vector3f getPos() { return this.pos; }
        public Vector3f getRot() { return this.rot; }
        public Vector3f getScale() { return this.scale; }


        public void setPos(Vector3f pos) { this.pos = pos; }
        public void setRot(Vector3f rot) { this.rot = rot; }
        public void setScale(Vector3f scale) { this.scale = scale; }
}
