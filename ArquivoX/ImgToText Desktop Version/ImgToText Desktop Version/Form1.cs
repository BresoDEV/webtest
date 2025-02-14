using System.Text;
using System.Windows.Forms;
using static System.Runtime.InteropServices.JavaScript.JSType;

namespace ImgToText_Desktop_Version
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
          

        }

        public static string Joaat(string input)
        {
            uint hash = 0;
            foreach (char c in input)
            {
                hash += (uint)c; // Soma o valor ASCII do caractere
                hash += (hash << 10); // Desloca 10 bits para a esquerda e soma
                hash ^= (hash >> 6); // Desloca 6 bits para a direita e faz XOR
            }

            hash += (hash << 3); // Desloca 3 bits para a esquerda e soma
            hash ^= (hash >> 11); // Desloca 11 bits para a direita e faz XOR
            hash += (hash << 15); // Desloca 15 bits para a esquerda e soma

            return "0x" + hash.ToString("X");
        }





        //funcionando
        static string Encrip(string text, string key)
        {
            StringBuilder e = new StringBuilder();
            int keyLength = key.Length;

            for (int i = 0; i < text.Length; i++)
            {
                e.Append((char)(text[i] ^ key[i % keyLength]));
            }

            return Convert.ToBase64String(Encoding.UTF8.GetBytes(e.ToString()));
        }


        static string Decrip(string text, string key)
        {
            string base64Decoded = Encoding.UTF8.GetString(Convert.FromBase64String(text));
            StringBuilder d = new StringBuilder();
            for (int i = 0; i < base64Decoded.Length; i++)
            {
                d.Append((char)(base64Decoded[i] ^ key[i % key.Length]));
            }
            return d.ToString();
        }


        private string ConverterImagemParaBase64(string caminhoImagem)
        {
            byte[] imageBytes = File.ReadAllBytes(caminhoImagem);
            return Convert.ToBase64String(imageBytes);
        }


        //funcionano filé
        private void button2_Click(object sender, EventArgs e)
        {
            

            using (OpenFileDialog openFileDialog = new OpenFileDialog { Filter = "Imagens|*.jpg;*.png;*.bmp" })
            {
                if (openFileDialog.ShowDialog() == DialogResult.OK)
                {
                    byte[] imageBytes = File.ReadAllBytes(openFileDialog.FileName);
                    string base64String = Convert.ToBase64String(imageBytes);
                   
                  richTextBox3.Text = Encrip(base64String, Joaat(textBox1.Text));
                }
            }
        }



       




    }
}