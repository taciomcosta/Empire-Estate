#version 130

attribute vec3 positions; // we could do the same for colors

uniform vec3 inColors; // global var for getting color data from CPU (this can be used instead of a VBO)
out vec3 outFragColors; // output color for Fragment Shader

uniform mat4 transform;


void main()
{
    gl_Position = transform * vec4(positions, 1.0);
    outFragColors = inColors;
}
