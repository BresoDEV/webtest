using System.Text;
using System.Windows.Forms;
using static System.Net.Mime.MediaTypeNames;

namespace ImgToText
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        public static string aJoaat(string input)
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



        private void button1_Click(object sender, EventArgs e)
        {
            if (textBox1.Text.Length != 0)
            {
                using (OpenFileDialog openFileDialog = new OpenFileDialog { Filter = "Imagens|*.jpg;*.png;*.bmp" })
                {
                    if (openFileDialog.ShowDialog() == DialogResult.OK)
                    {
                        byte[] imageBytes = File.ReadAllBytes(openFileDialog.FileName);
                        string base64String = Convert.ToBase64String(imageBytes);

                        //---------------------
                        string input = textBox1.Text;
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

                        //-------------------------
                        string text = base64String;
                        string key = "0x" + hash.ToString("X");
                        StringBuilder e2 = new StringBuilder();
                        int keyLength = key.Length;

                        for (int i = 0; i < text.Length; i++)
                        {
                            e2.Append((char)(text[i] ^ key[i % keyLength]));
                        }


                        richTextBox1.Text = Convert.ToBase64String(Encoding.UTF8.GetBytes(e2.ToString()));
                    }
                }
            }
            else
            {
                MessageBox.Show("Senha vazia");
            }

        }

        private void button2_Click(object sender, EventArgs e)
        {


            try
            {
                string key = textBox1.Text;
                string base64Decoded = Encoding.UTF8.GetString(Convert.FromBase64String(richTextBox1.Text));
                StringBuilder d = new StringBuilder();
                for (int i = 0; i < base64Decoded.Length; i++)
                {
                    d.Append((char)(base64Decoded[i] ^ key[i % key.Length]));
                }
                richTextBox1.Text = d.ToString();

                byte[] imgb = Convert.FromBase64String(richTextBox1.Text);
                using (MemoryStream ms = new MemoryStream(imgb))
                {
                    pictureBox1.Image = System.Drawing.Image.FromStream(ms);// d.ToString();
                }
            }
            catch (Exception v)
            {
                MessageBox.Show(v.Message);
            }


        }

        private void button3_Click(object sender, EventArgs e)
        {
            if (richTextBox1.Text.Length != 0)
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
                File.WriteAllText("img (" + ct + ").txt", richTextBox1.Text);
                MessageBox.Show("Arquivo " + ct + " criado com sucesso");
            }
            else
            {
                MessageBox.Show("Codigo vazio");
            }





        }

        private void button4_Click(object sender, EventArgs e)
        {
            
        }
    }
}
