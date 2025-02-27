using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using static System.Windows.Forms.VisualStyles.VisualStyleElement;

namespace ImgToText
{
    internal class ImgToText_Class
    {
        public class Diversos
        { 
            public static string gerarSenha(int num_caracteres)
            {
                const string caracteresPermitidos = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                StringBuilder senha = new StringBuilder();

                // Instanciar um gerador de números aleatórios
                Random random = new Random();

                // Gerar a senha
                for (int i = 0; i < num_caracteres; i++)
                {
                    // Escolher um caractere aleatório da string de caracteresPermitidos
                    int indice = random.Next(caracteresPermitidos.Length);
                    senha.Append(caracteresPermitidos[indice]);
                }

                return senha.ToString();
            }
            public static void SalvarTXT(string imagem_convertida)
            {
                if (imagem_convertida.Length != 0)
                {
                    int ct = 1;
                    for (int i = 1; i < 1000; i++)
                    {
                        if (!File.Exists("img (" + i + ").txt"))
                        {
                            ct = i;
                            break;
                        }
                    }
                    File.WriteAllText("img (" + ct + ").txt", imagem_convertida);
                }
                
            } 
            public static void SalvarIMG(PictureBox picturebox)
            {
                try
                {
                    const string caracteresPermitidos = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                    StringBuilder senha = new StringBuilder();

                    // Instanciar um gerador de números aleatórios
                    Random random = new Random();

                    // Gerar a senha
                    for (int i = 0; i < 10; i++)
                    {
                        // Escolher um caractere aleatório da string de caracteresPermitidos
                        int indice = random.Next(caracteresPermitidos.Length);
                        senha.Append(caracteresPermitidos[indice]);
                    }

                    string filePath = senha.ToString() + ".png";

                    if(picturebox.Image != null)
                    {
                        using (Bitmap copia = new Bitmap(picturebox.Image))
                        {
                            copia.Save(filePath, System.Drawing.Imaging.ImageFormat.Png);
                        }
                    }
                    
                }
                catch(Exception o) {
                    MessageBox.Show(o.ToString());

                }
            }
            public static string joaat_hexadecimal(string input)
            {
                uint hash = 0;
                foreach (char c in input)
                {
                    hash += (uint)c; 
                    hash += (hash << 10); 
                    hash ^= (hash >> 6); 
                }

                hash += (hash << 3); 
                hash ^= (hash >> 11); 
                hash += (hash << 15); 

                return "0x" + hash.ToString("X");
            }
            public static string joaat_decimal(string input)
            {
                uint hash = 0;
                foreach (char c in input)
                {
                    hash += (uint)c; 
                    hash += (hash << 10); 
                    hash ^= (hash >> 6); 
                }

                hash += (hash << 3); 
                hash ^= (hash >> 11); 
                hash += (hash << 15); 

                return hash.ToString();
            }
        }
        public class Com_OpenDialog
        {
            public static string ImgtoText(string password)
            {
                using (OpenFileDialog openFileDialog = new OpenFileDialog {  })
                {
                    if (openFileDialog.ShowDialog() == DialogResult.OK)
                    {
                        byte[] imageBytes = File.ReadAllBytes(openFileDialog.FileName);
                        string base64String = Convert.ToBase64String(imageBytes);

                        //---------------------
                        string input = password;
                        uint hash = 0;
                        foreach (char c in input)
                        {
                            hash += (uint)c; 
                            hash += (hash << 10); 
                            hash ^= (hash >> 6); 
                        }

                        hash += (hash << 3); 
                        hash ^= (hash >> 11); 
                        hash += (hash << 15); 

                        //-------------------------
                        string text = base64String;
                        string key = "0x" + hash.ToString("X");
                        StringBuilder e2 = new StringBuilder();
                        int keyLength = key.Length;

                        for (int i = 0; i < text.Length; i++)
                        {
                            e2.Append((char)(text[i] ^ key[i % keyLength]));
                        }


                        return Convert.ToBase64String(Encoding.UTF8.GetBytes(e2.ToString()));
                    }
                    else
                    {
                        return "";
                    }
                }
            }
        }
        public class Sem_OpenDialog
        {
            public static string ImgtoText(string caminho_img,string password)
            {
                byte[] imageBytes = File.ReadAllBytes(caminho_img);
                        string base64String = Convert.ToBase64String(imageBytes);

                        //---------------------
                        string input = password;
                        uint hash = 0;
                        foreach (char c in input)
                        {
                            hash += (uint)c; 
                            hash += (hash << 10); 
                            hash ^= (hash >> 6); 
                        }

                        hash += (hash << 3); 
                        hash ^= (hash >> 11); 
                        hash += (hash << 15); 

                        //-------------------------
                        string text = base64String;
                        string key = "0x" + hash.ToString("X");
                        StringBuilder e2 = new StringBuilder();
                        int keyLength = key.Length;

                        for (int i = 0; i < text.Length; i++)
                        {
                            e2.Append((char)(text[i] ^ key[i % keyLength]));
                        }

                        return Convert.ToBase64String(Encoding.UTF8.GetBytes(e2.ToString()));
                    
                   
            }
            public static Image Text_to_Img(string texto, string password)
            {
                try
                {
                    string input = password;
                    uint hash = 0;
                    foreach (char c in input)
                    {
                        hash += (uint)c;
                        hash += (hash << 10);
                        hash ^= (hash >> 6);
                    }

                    hash += (hash << 3);
                    hash ^= (hash >> 11);
                    hash += (hash << 15);


                    string key = "0x" + hash.ToString("X");
                    string base64Decoded = Encoding.UTF8.GetString(Convert.FromBase64String(texto));


                    StringBuilder d = new StringBuilder();
                    for (int i = 0; i < base64Decoded.Length; i++)
                    {
                        d.Append((char)(base64Decoded[i] ^ key[i % key.Length]));
                    }



                    byte[] imageBytes = Convert.FromBase64String(d.ToString());

                    // Cria um stream a partir dos bytes da imagem
                    using (MemoryStream ms = new MemoryStream(imageBytes))
                    {
                        // Carrega a imagem no PictureBox
                        return System.Drawing.Image.FromStream(ms);
                    }
                }
                catch { return null; }
            }
        }
 
        public class Processamento
        {
            public static void converter_todas_imagens_da_pasta_para_txt(string password)
            {
                string diretorio = AppDomain.CurrentDomain.BaseDirectory;
                string[] extensoesImagem = new string[] { "*.jpg", "*.jpeg", "*.png", "*.bmp", "*.gif" };
                string[] arquivosImagens = new string[0];
                foreach (var extensao in extensoesImagem)
                {
                    arquivosImagens = arquivosImagens.Concat(Directory.GetFiles(diretorio, extensao)).ToArray();
                }

                int ct = 0;
                foreach (var imagem in arquivosImagens)
                {
                    
                    Diversos.SalvarTXT(Sem_OpenDialog.ImgtoText(imagem, password));
                    ct++;
                    
                }
                MessageBox.Show(ct + " imagens convertidas");
                 
            }
            public static void converter_todos_txt_da_pasta_para_png(PictureBox pictureBox,string password)
            {
                int ct = 1;

              

                while (File.Exists("img (" + ct + ").txt"))
                {
                    pictureBox.Image = Sem_OpenDialog.Text_to_Img(File.ReadAllText("img (" + ct + ").txt"), password);
                     
                    Diversos.SalvarIMG(pictureBox);

                    ct++;


                }


                MessageBox.Show(ct + " imagens convertidas");
            }
        }
    }
}


