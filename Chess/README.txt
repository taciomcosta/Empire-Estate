=== COMMAND FOR COMPILING (C++) ===
	g++ *.cpp *.c -o main -lSDL2 -lGLEW -lGL

=== LIBRARIES ===
    - OpenGL: Mainly for 3D Graphics (not only games and certainly not for windows)
    - GLFW: For creating windows and handle user events
    - GLEW: Acts like an extension for compatibility with Modern OpenGL
    - SDL2: For handling user inputs, audio issues...
    - STBI: For loading texture images (it also has other functions)


=== TUTORIAL ===
	- YouTube - "Modern OpenGL Tutorial - thebennybox"
	- Learn OpenGL - learnopengl.com/#!Getting-started/Hello-Window


=== CLASSES FUNCTIONALITIES ===
	- Window: Window and its controllers, deals with events
	- Shader: Shader Loader
	- Texture: Texture Loader
	- Mesh: 3D obj, responsible for loading
	  vertices data on the GPU.
	  Generally, Meshes have vertex positions, texCoords and indices for positions
	- ColoredMesh: A Mesh only colored
	- TexturedMesh: A Mesh only textured
	- Vertex: Contains model vertices and texture coordinates


=== CORE CONCEPTS ===
    - VBO: Memory allocated on GPU for storing any type of  data that
      will be displayed;
    - VAO: We can think of a VAO as a representaiton of a geometric object.
      However, it does not contain data about geometric objects, but it contains
      pointers to buffers that has the geometric object, it is, pointers to vbos;
    - SHADERS: A shader is a program. There are some kinds of shaders and not all
      of them are programmable. As an analogy, we can think that an geometric
      object has to go through an Assembly Line and a unique shader is a single
      process of this Line; ("gl_..." are OpenGL global variables)
    - SHADER PROGRAM OBJECT: Set of all shaders;


=== QUESTION ===
    - Should we have one shader program object (Shader class) for each model?
    - How we control a model?
    - How we should work with indices for not repeating coordinates? OK
