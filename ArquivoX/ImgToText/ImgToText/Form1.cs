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


        }
        public static bool boleta = false;




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

        private void timer1_Tick(object sender, EventArgs e)
        {
            pictureBox1.Size = new Size(trackBar1.Value, trackBar2.Value);

            if (boleta)
            {
                string g = "";
                try
                {
                    g = Diversos.gerarSenha(1);
                    if (g == "1")
                    {
                        MessageBox.Show("bin");
                    }
                    pictureBox1.Image = ImgToText_Class.Sem_OpenDialog.Text_to_Img(richTextBox1.Text, g);
                    boleta = false;
                    MessageBox.Show(g);
                }
                catch (Exception ex)
                {
                    this.Text = g;
                }
            }
        }

        private void button7_Click(object sender, EventArgs e)
        {
            boleta = true;
        }
    }
}
