namespace ImgToText
{
    partial class Form1
    {
        /// <summary>
        ///  Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        ///  Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        ///  Required method for Designer support - do not modify
        ///  the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            components = new System.ComponentModel.Container();
            textBox1 = new TextBox();
            button1 = new Button();
            richTextBox1 = new RichTextBox();
            button2 = new Button();
            button3 = new Button();
            pictureBox1 = new PictureBox();
            groupBox1 = new GroupBox();
            groupBox3 = new GroupBox();
            button6 = new Button();
            groupBox2 = new GroupBox();
            button5 = new Button();
            textBox2 = new TextBox();
            button4 = new Button();
            trackBar1 = new TrackBar();
            trackBar2 = new TrackBar();
            timer1 = new System.Windows.Forms.Timer(components);
            button7 = new Button();
            ((System.ComponentModel.ISupportInitialize)pictureBox1).BeginInit();
            groupBox1.SuspendLayout();
            groupBox3.SuspendLayout();
            groupBox2.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize)trackBar1).BeginInit();
            ((System.ComponentModel.ISupportInitialize)trackBar2).BeginInit();
            SuspendLayout();
            // 
            // textBox1
            // 
            textBox1.BackColor = Color.FromArgb(50, 50, 50);
            textBox1.ForeColor = SystemColors.AppWorkspace;
            textBox1.Location = new Point(6, 22);
            textBox1.Name = "textBox1";
            textBox1.PlaceholderText = "Senha";
            textBox1.Size = new Size(180, 23);
            textBox1.TabIndex = 0;
            // 
            // button1
            // 
            button1.BackColor = Color.FromArgb(50, 50, 50);
            button1.FlatStyle = FlatStyle.Flat;
            button1.ForeColor = SystemColors.AppWorkspace;
            button1.Location = new Point(6, 55);
            button1.Name = "button1";
            button1.Size = new Size(180, 36);
            button1.TabIndex = 1;
            button1.Text = "Abrir imagem e gerar codigo";
            button1.UseVisualStyleBackColor = false;
            button1.Click += button1_Click;
            // 
            // richTextBox1
            // 
            richTextBox1.BackColor = Color.FromArgb(50, 50, 50);
            richTextBox1.ForeColor = SystemColors.AppWorkspace;
            richTextBox1.Location = new Point(6, 19);
            richTextBox1.Name = "richTextBox1";
            richTextBox1.Size = new Size(180, 115);
            richTextBox1.TabIndex = 2;
            richTextBox1.Text = "\n";
            // 
            // button2
            // 
            button2.BackColor = Color.FromArgb(50, 50, 50);
            button2.FlatStyle = FlatStyle.Flat;
            button2.ForeColor = SystemColors.AppWorkspace;
            button2.Location = new Point(6, 140);
            button2.Name = "button2";
            button2.Size = new Size(180, 36);
            button2.TabIndex = 4;
            button2.Text = "Decodificar e exibir a imagem";
            button2.UseVisualStyleBackColor = false;
            button2.Click += button2_Click;
            // 
            // button3
            // 
            button3.BackColor = Color.FromArgb(50, 50, 50);
            button3.FlatStyle = FlatStyle.Flat;
            button3.ForeColor = SystemColors.AppWorkspace;
            button3.Location = new Point(211, 67);
            button3.Name = "button3";
            button3.Size = new Size(155, 36);
            button3.TabIndex = 6;
            button3.Text = "Salvar arquivo de texto";
            button3.UseVisualStyleBackColor = false;
            button3.Click += button3_Click;
            // 
            // pictureBox1
            // 
            pictureBox1.BackColor = SystemColors.ControlDarkDark;
            pictureBox1.Location = new Point(372, 21);
            pictureBox1.Name = "pictureBox1";
            pictureBox1.Size = new Size(348, 444);
            pictureBox1.SizeMode = PictureBoxSizeMode.StretchImage;
            pictureBox1.TabIndex = 3;
            pictureBox1.TabStop = false;
            // 
            // groupBox1
            // 
            groupBox1.Controls.Add(textBox1);
            groupBox1.Controls.Add(button1);
            groupBox1.Location = new Point(12, 12);
            groupBox1.Name = "groupBox1";
            groupBox1.Size = new Size(193, 101);
            groupBox1.TabIndex = 7;
            groupBox1.TabStop = false;
            // 
            // groupBox3
            // 
            groupBox3.Controls.Add(button2);
            groupBox3.Controls.Add(richTextBox1);
            groupBox3.Location = new Point(12, 119);
            groupBox3.Name = "groupBox3";
            groupBox3.Size = new Size(193, 191);
            groupBox3.TabIndex = 9;
            groupBox3.TabStop = false;
            // 
            // button6
            // 
            button6.BackColor = Color.FromArgb(50, 50, 50);
            button6.FlatStyle = FlatStyle.Flat;
            button6.ForeColor = SystemColors.AppWorkspace;
            button6.Location = new Point(211, 21);
            button6.Name = "button6";
            button6.Size = new Size(155, 36);
            button6.TabIndex = 7;
            button6.Text = "Salvar Imagem";
            button6.UseVisualStyleBackColor = false;
            button6.Click += button6_Click;
            // 
            // groupBox2
            // 
            groupBox2.Controls.Add(button5);
            groupBox2.Controls.Add(textBox2);
            groupBox2.Controls.Add(button4);
            groupBox2.Location = new Point(12, 316);
            groupBox2.Name = "groupBox2";
            groupBox2.Size = new Size(193, 142);
            groupBox2.TabIndex = 8;
            groupBox2.TabStop = false;
            // 
            // button5
            // 
            button5.BackColor = Color.FromArgb(50, 50, 50);
            button5.FlatStyle = FlatStyle.Flat;
            button5.ForeColor = SystemColors.AppWorkspace;
            button5.Location = new Point(6, 97);
            button5.Name = "button5";
            button5.Size = new Size(180, 36);
            button5.TabIndex = 2;
            button5.Text = "Processar Todos TXTs";
            button5.UseVisualStyleBackColor = false;
            button5.Click += button5_Click;
            // 
            // textBox2
            // 
            textBox2.BackColor = Color.FromArgb(50, 50, 50);
            textBox2.ForeColor = SystemColors.AppWorkspace;
            textBox2.Location = new Point(6, 22);
            textBox2.Name = "textBox2";
            textBox2.PlaceholderText = "Senha";
            textBox2.Size = new Size(180, 23);
            textBox2.TabIndex = 0;
            // 
            // button4
            // 
            button4.BackColor = Color.FromArgb(50, 50, 50);
            button4.FlatStyle = FlatStyle.Flat;
            button4.ForeColor = SystemColors.AppWorkspace;
            button4.Location = new Point(6, 55);
            button4.Name = "button4";
            button4.Size = new Size(180, 36);
            button4.TabIndex = 1;
            button4.Text = "Processar Todas Imagens";
            button4.UseVisualStyleBackColor = false;
            button4.Click += button4_Click;
            // 
            // trackBar1
            // 
            trackBar1.Location = new Point(211, 109);
            trackBar1.Maximum = 800;
            trackBar1.Minimum = 1;
            trackBar1.Name = "trackBar1";
            trackBar1.Size = new Size(155, 45);
            trackBar1.TabIndex = 10;
            trackBar1.Value = 348;
            // 
            // trackBar2
            // 
            trackBar2.Location = new Point(211, 160);
            trackBar2.Maximum = 800;
            trackBar2.Minimum = 1;
            trackBar2.Name = "trackBar2";
            trackBar2.Size = new Size(155, 45);
            trackBar2.TabIndex = 11;
            trackBar2.Value = 444;
            // 
            // timer1
            // 
            timer1.Enabled = true;
            timer1.Interval = 1;
            timer1.Tick += timer1_Tick;
            // 
            // button7
            // 
            button7.BackColor = Color.FromArgb(50, 50, 50);
            button7.FlatStyle = FlatStyle.Flat;
            button7.ForeColor = SystemColors.AppWorkspace;
            button7.Location = new Point(222, 286);
            button7.Name = "button7";
            button7.Size = new Size(134, 36);
            button7.TabIndex = 12;
            button7.Text = "Bruteforce";
            button7.UseVisualStyleBackColor = false;
            button7.Click += button7_Click;
            // 
            // Form1
            // 
            AutoScaleDimensions = new SizeF(7F, 15F);
            AutoScaleMode = AutoScaleMode.Font;
            BackColor = Color.FromArgb(50, 50, 50);
            ClientSize = new Size(732, 477);
            Controls.Add(button7);
            Controls.Add(trackBar2);
            Controls.Add(trackBar1);
            Controls.Add(button6);
            Controls.Add(button3);
            Controls.Add(groupBox2);
            Controls.Add(groupBox3);
            Controls.Add(groupBox1);
            Controls.Add(pictureBox1);
            FormBorderStyle = FormBorderStyle.SizableToolWindow;
            Name = "Form1";
            Text = "3";
            ((System.ComponentModel.ISupportInitialize)pictureBox1).EndInit();
            groupBox1.ResumeLayout(false);
            groupBox1.PerformLayout();
            groupBox3.ResumeLayout(false);
            groupBox2.ResumeLayout(false);
            groupBox2.PerformLayout();
            ((System.ComponentModel.ISupportInitialize)trackBar1).EndInit();
            ((System.ComponentModel.ISupportInitialize)trackBar2).EndInit();
            ResumeLayout(false);
            PerformLayout();
        }

        #endregion

        private TextBox textBox1;
        private Button button1;
        private RichTextBox richTextBox1;
        private Button button2;
        private Button button3;
        private PictureBox pictureBox1;
        private GroupBox groupBox1;
        private GroupBox groupBox3;
        private GroupBox groupBox2;
        private TextBox textBox2;
        private Button button4;
        private Button button5;
        private Button button6;
        private TrackBar trackBar1;
        private TrackBar trackBar2;
        private System.Windows.Forms.Timer timer1;
        private Button button7;
    }
}
