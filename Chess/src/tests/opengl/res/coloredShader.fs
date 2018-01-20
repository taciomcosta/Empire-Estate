#version 130

in vec3 outFragColors;

void main()
{
        gl_FragColor = vec4(outFragColors, 1.0f); //color
}