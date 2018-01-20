package tests.opengl;

import org.lwjgl.BufferUtils;
import org.lwjgl.stb.STBImage;

import javax.imageio.ImageIO;
import java.awt.image.BufferedImage;
import java.io.File;
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
                if (data == null)
                        System.err.println("Error loading texture");
                texId = glGenTextures();
                glBindTexture(GL_TEXTURE_2D, texId);
                // Now, our Texture object was generated and bound
                glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_WRAP_S, GL_REPEAT);
                glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_WRAP_T, GL_REPEAT);
                // Now, our image was set to repeat for X and Y
                glTexParameterf(GL_TEXTURE_2D, GL_TEXTURE_MIN_FILTER, GL_LINEAR);
                glTexParameterf(GL_TEXTURE_2D, GL_TEXTURE_MAG_FILTER, GL_LINEAR);
                /*
                   Now, GL_LINEAR is defined as the default filtering
                   for scaling things up and downwards
                 */
                glTexImage2D(
                        GL_TEXTURE_2D, 0, GL_RGBA,
                        width, height, 0,
                        GL_RGBA, GL_UNSIGNED_BYTE, data
                );
                /*
                *  Now, our texture data was sent to the Texture Object
                * */
                STBImage.stbi_image_free(data);
        }


        public void bind(int unit)
        {
                glActiveTexture(GL_TEXTURE0 + unit);
                // Now, our texture unit was activated
                glBindTexture(GL_TEXTURE_2D, texId);
        }


        public ByteBuffer loadImage(String fileName)
        {
                ByteBuffer img = null;
                BufferedImage bi;
                try {
                        bi = ImageIO.read(new File(fileName));
                        this.width = bi.getWidth();
                        this.height = bi.getHeight();
                        this.numChannels = 3;
                } catch (Exception e) {
                        e.printStackTrace();
                }
                // Now, we have the size of our image
                IntBuffer width = BufferUtils.createIntBuffer(this.width);
                IntBuffer height = BufferUtils.createIntBuffer(this.height);
                IntBuffer numComponets = BufferUtils.createIntBuffer(3);
                STBImage.nstbi_set_flip_vertically_on_load(1);
                img = STBImage.stbi_load(
                        fileName,
                        width,
                        height,
                        numComponets,
                        4
                );
                // Now, our image was opened and loaded to img
                return img;
        }
}

