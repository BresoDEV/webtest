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
            richTextBox1.Text = ImgToText_Class.Com_OpenDialog.ImgtoText(textBox1.Text);
            pictureBox1.Image = ImgToText_Class.Sem_OpenDialog.Text_to_Img(richTextBox1.Text, textBox1.Text);
        }

        private void button2_Click(object sender, EventArgs e)
        {
            pictureBox1.Image = ImgToText_Class.Sem_OpenDialog.Text_to_Img(richTextBox1.Text, textBox1.Text);
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





        static bool VerificarImagemValida(PictureBox pictureBox)
        {
            // Verifica se a propriedade Image não é nula
            if (pictureBox.Image != null)
            {
                // Verifica se a imagem possui um formato válido (uma verificação simples, pode ser expandida)
                try
                {
                    using (var img = pictureBox.Image)
                    {
                        // Testa se a imagem tem um formato válido
                        return true;  // Imagem válida
                    }
                }
                catch
                {
                    // Caso a imagem não seja válida (por exemplo, corrompida ou com formato inválido)
                    return false;
                }
            }
            return false;  // Não há imagem (Image é null)
        }



        private void timer1_Tick(object sender, EventArgs e)
        {



            pictureBox1.Size = new Size(trackBar1.Value, trackBar2.Value);

            if (boleta)
            {
                string g = "";

                g = Diversos.gerarSenha(bruteforceNumCaracteres);

                if (!bruteforceCombinacoes.Contains(g))
                {
                    bruteforceCombinacoes.Add(g);
                    try
                    {

                        this.Text = "Combinações: " + bruteforceCombinacoes.Count + " / " + Math.Pow(62, bruteforceNumCaracteres);

                        progressBar1.Maximum = (int)Math.Pow(62, bruteforceNumCaracteres);
                        progressBar1.Value = bruteforceCombinacoes.Count;

                        pictureBox1.Image = ImgToText_Class.Sem_OpenDialog.Text_to_Img(richTextBox1.Text, g);

                        boleta = false;
                        MessageBox.Show("Senha encontrada:\n" + g);

                        progressBar1.Maximum = 0;
                        progressBar1.Value = 0;

                    }
                    catch { }



                    // if (VerificarImagemValida(pictureBox1))
                    // {
                    //     boleta = false;
                    //     // MessageBox.Show(g);
                    // }
                }



            }
        }

        public static int bruteforceNumCaracteres = 0;

        private void button7_Click(object sender, EventArgs e)
        {
            bruteforceNumCaracteres = (int)numericUpDown1.Value;

            pictureBox1.Image = null;

            boleta = true;
        }
    }
}
