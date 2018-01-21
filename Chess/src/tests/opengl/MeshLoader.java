package tests.opengl;

import org.lwjgl.BufferUtils;
import tests.opengl.Mesh.ColoredMesh;
import tests.opengl.Mesh.Mesh;
import tests.opengl.Mesh.TexturedMesh;

import java.awt.*;
import java.io.BufferedReader;
import java.io.FileReader;
import java.nio.FloatBuffer;
import java.nio.IntBuffer;
import java.util.LinkedList;

// Should it be a static class?
public class MeshLoader
{
        private static FloatBuffer vertices;
        private static FloatBuffer texCoords;
        private static IntBuffer indices;
        private static Mesh mesh;


        public static Mesh parseFile(String filePath, Window window)
        {
                float ratioW = Window.DEFAULT_WIDTH / window.getWidth();
                float ratioH = Window.DEFAULT_HEIGHT / window.getHeight();
                LinkedList<Float> vList = new LinkedList<>();
                LinkedList<Integer> iList = new LinkedList<>();
                try {
                        FileReader fr = new FileReader(filePath);
                        BufferedReader br = new BufferedReader(fr);
                        String line;
                        while ((line = br.readLine()) != null) {
                                if (line.startsWith("v "))
                                        addLineToVerticesList(line, vList);
                                else if (line.startsWith("f "))
                                        addLineToIndicesList(line, iList);
                        }
                } catch (Exception e) {
                        e.printStackTrace();
                }
                vertices = BufferUtils.createFloatBuffer(vList.size());
                indices = BufferUtils.createIntBuffer(iList.size());
                for (int i = 0; i < vList.size() - 2; i+=3) {
                        vList.set(i, vList.get(i) * ratioW);
                        vList.set(i + 1, vList.get(i + 1) * ratioH);
                }
                for(Float f : vList)
                        vertices.put(f);
                for(Integer i : iList)
                        indices.put(i);
                vertices.flip();
                indices.flip();
                System.out.println("Positions: " + String.valueOf(vList.size()));
                for (Integer i : iList) System.out.println(i);
                return mesh = new ColoredMesh(
                        vertices,
                        indices,
                        new Color(255, 255, 0)); //TODO make it cusomizable
        }


        public static Mesh parseFile(String filePath, String textureFilePath)
        {
                LinkedList<Float> vList = new LinkedList<>();
                LinkedList<Integer> iList = new LinkedList<>();
                LinkedList<Float> tList = new LinkedList<>();
                try {
                        FileReader fr = new FileReader(filePath);
                        BufferedReader br = new BufferedReader(fr);
                        String line;
                        while ((line = br.readLine()) != null) {
                                if (line.startsWith("v "))
                                        addLineToVerticesList(line, vList);
                                else if (line.startsWith("f "))
                                        addLineToIndicesList(line, iList);
                                else if (line.startsWith("t "))
                                        addLineToTexCoordsList(line, tList);

                        }
                } catch (Exception e) {
                        e.printStackTrace();
                }
                vertices = BufferUtils.createFloatBuffer(vList.size());
                indices = BufferUtils.createIntBuffer(iList.size());
                texCoords = BufferUtils.createFloatBuffer(tList.size());
                for(Float f : vList)
                        vertices.put(f);
                for(Integer i : iList)
                        indices.put(i);
                for(Float f : tList)
                        texCoords.put(f);
                vertices.flip();
                indices.flip();
                texCoords.flip();
                return mesh = new TexturedMesh(
                        vertices,
                        indices,
                        texCoords,
                        textureFilePath
                );
        }


        private static void addLineToVerticesList(String line, LinkedList vList)
        {
                String[] e = line.split(" ");
                vList.add(Float.parseFloat(e[1]));
                vList.add(Float.parseFloat(e[2]));
                vList.add(Float.parseFloat(e[3]));
        }


        private static void addLineToIndicesList(String line, LinkedList iList)
        {
                String[] e = line.split(" ");
                iList.add(Integer.parseInt(e[1].split("/")[0]));
                iList.add(Integer.parseInt(e[2].split("/")[0]));
                iList.add(Integer.parseInt(e[3].split("/")[0]));
        }


        private static void addLineToTexCoordsList(String line, LinkedList tList)
        {
                String[] e = line.split(" ");
                tList.add(Float.parseFloat(e[1]));
                tList.add(Float.parseFloat(e[2]));
        }
}
