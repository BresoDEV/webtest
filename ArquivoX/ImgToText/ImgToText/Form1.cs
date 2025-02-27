using System.Text;
using System.Windows.Forms;
using static System.Net.Mime.MediaTypeNames;
using static ImgToText.ImgToText_Class;

namespace ImgToText
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
            richTextBox1.Text = "";

        }
        public static bool boleta = false;

        List<string> bruteforceCombinacoes = new List<string>();




        private void button1_Click(object sender, EventArgs e)
        {
            if (textBox1.Text.Length > 0)
            {
                richTextBox1.Text = ImgToText_Class.Com_OpenDialog.ImgtoText(textBox1.Text);
                pictureBox1.Image = ImgToText_Class.Sem_OpenDialog.Text_to_Img(richTextBox1.Text, textBox1.Text);
                
            }
            else
            {
                textBox1.BackColor = Color.FromArgb(250, 50, 50);
            }

        }

        private void button2_Click(object sender, EventArgs e)
        {
            if (richTextBox1.Text.Length > 0)
            {
                if (textBox1.Text.Length > 0)
                {
                    pictureBox1.Image = ImgToText_Class.Sem_OpenDialog.Text_to_Img(richTextBox1.Text, textBox1.Text);
                }
                else
                {
                    textBox1.BackColor = Color.FromArgb(250, 50, 50);
                }
            }
            else
            {
                richTextBox1.BackColor = Color.FromArgb(250, 50, 50);
            }
        }











        private void button3_Click(object sender, EventArgs e)
        {
            ImgToText_Class.Diversos.SalvarTXT(richTextBox1.Text);

        }

        private void button4_Click(object sender, EventArgs e)
        {
            
            Processamento.converter_todas_imagens_da_pasta_para_txt(textBox2.Text); 
            
        }

        private void button5_Click(object sender, EventArgs e)
        {
            Processamento.converter_todos_txt_da_pasta_para_png(pictureBox1, textBox2.Text);
        }

        private void button6_Click(object sender, EventArgs e)
        {

            Diversos.SalvarIMG(pictureBox1);
        }








        public static int ggggg = 0;
        private void timer1_Tick(object sender, EventArgs e)
        {

            //Habilita o botao de salvar a imagem, caso exista alguma imagen no picturebox
            if (pictureBox1.Image != null)
            {
                button6.Enabled = true;
            }
            else
            {
                button6.Enabled = false;
            }
            //------------------


            //Habilita o botao de salvar o arquivo de texto, caso exista algum texto no richtextbox
            if (richTextBox1.Text.Length > 0)
            {
                button3.Enabled = true;
            }
            else
            {
                button3.Enabled = false;
            }
            //------------------
            
            //Habilita os botoes de processar tudo, caso exista uma senha ja, no textbox2
            if (textBox2.Text.Length > 0)
            {
                button4.Enabled = true;
                button5.Enabled = true;
            }
            else
            {
                button4.Enabled = false;
                button5.Enabled = false;
            }
            //------------------





            pictureBox1.Size = new Size(trackBar1.Value, trackBar2.Value);

            if (boleta)
            {
                for (int i = 0; i < 100; i++)
                {
                    ggggg++;
                    brute();
                }
            }

            this.Text = "Combinações: " + bruteforceCombinacoes.Count + " / " + Math.Pow(62, bruteforceNumCaracteres);
        }

        public static int bruteforceNumCaracteres = 0;

        private void button7_Click(object sender, EventArgs e)
        {
            bruteforceNumCaracteres = (int)numericUpDown1.Value;

            pictureBox1.Image = null;

            boleta = true;
        }



        public void brute()
        {
            string g = "";

            g = Diversos.gerarSenha(bruteforceNumCaracteres);

            if (!bruteforceCombinacoes.Contains(g))
            {
                bruteforceCombinacoes.Add(g);
                try
                {



                    progressBar1.Maximum = (int)Math.Pow(62, bruteforceNumCaracteres);
                    progressBar1.Value = bruteforceCombinacoes.Count;

                    pictureBox1.Image = ImgToText_Class.Sem_OpenDialog.Text_to_Img(richTextBox1.Text, g);

                    boleta = false;
                    MessageBox.Show("Senha encontrada:\n" + g);

                    progressBar1.Maximum = 0;
                    progressBar1.Value = 0;
                    bruteforceCombinacoes.Clear();

                }
                catch { }
            }
        }

        private void textBox1_MouseHover(object sender, EventArgs e)
        {
            textBox1.BackColor = Color.FromArgb(50, 50, 50);
        }

        private void richTextBox1_MouseHover(object sender, EventArgs e)
        {
            richTextBox1.BackColor = Color.FromArgb(50, 50, 50);
        }
    }
}
