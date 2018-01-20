package thebennybox;

import org.lwjgl.BufferUtils;
import org.lwjgl.stb.STBImage;

import javax.imageio.ImageIO;
import java.awt.image.BufferedImage;
import java.io.File;
import java.io.IOException;
import java.nio.ByteBuffer;
import java.nio.IntBuffer;

import static org.lwjgl.opengl.GL11.*;
import static org.lwjgl.opengl.GL13.GL_TEXTURE0;
import static org.lwjgl.opengl.GL13.glActiveTexture;

public class Texture
{
        private int width;
        private int height;
        private int numChannels;
        private int texId;


        public Texture(String fileName)
        {
                ByteBuffer data = loadImage(fileName);
                if (data == null) {
                        System.err.println("Can't load image");
                        System.exit(1);
                }
                texId = glGenTextures();
                glBindTexture(GL_TEXTURE_2D, texId);
                glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_WRAP_S, GL_REPEAT);
                glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_WRAP_T, GL_REPEAT);
                // Now, the texture is set to repeat for x and y (S, T)
                // depending on coordinates
                glTexParameterf(GL_TEXTURE_2D, GL_TEXTURE_MIN_FILTER, GL_LINEAR);
                glTexParameterf(GL_TEXTURE_2D, GL_TEXTURE_MAG_FILTER, GL_LINEAR);
                // Now, GL_LINEAR is defined as the texture filtering option
                // for scaling things up and downwards
                glTexImage2D(
                        GL_TEXTURE_2D, 0, GL_RGBA,
                        width, height, 0,
                        GL_RGBA, GL_UNSIGNED_BYTE, data);
                // Now, the texture object has our image (data)
                STBImage.stbi_image_free(data);
        }


        public void bind(int unit)
        {
                glActiveTexture(GL_TEXTURE0 + unit);
                // Now, our texture unit at [unit] is activated
                glBindTexture(GL_TEXTURE_2D, texId);
        }


        public ByteBuffer loadImage(String fileName)
        {
                BufferedImage bi;
                try {
                        bi = ImageIO.read(new File(fileName));
                        this.width = bi.getWidth();
                        this.height = bi.getHeight();
                        this.numChannels = 3;
                } catch (IOException e) {
                        e.printStackTrace();
                }
                IntBuffer width = BufferUtils.createIntBuffer(this.width);
                IntBuffer height = BufferUtils.createIntBuffer(this.height);
                IntBuffer numComponents = BufferUtils.createIntBuffer(3);
                STBImage.nstbi_set_flip_vertically_on_load(1);
                ByteBuffer img = STBImage.stbi_load(
                        fileName,
                        width,
                        height,
                        numComponents,
                        4
                );
                return img;
                // Now, our image is structured as the required data type
        }
}
