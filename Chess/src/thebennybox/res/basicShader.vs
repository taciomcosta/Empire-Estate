#version 120

attribute vec3 position; // attributes are elements in a VAO, i.e., VBOs

uniform mat4 transform;

attribute vec2 texCoord;
varying vec2 texCoord0;


void main()
{
   gl_Position = transform * vec4(position, 1.0);
   texCoord0 = texCoord;
}
