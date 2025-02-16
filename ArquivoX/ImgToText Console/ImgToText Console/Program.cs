using System.Text;

int contador = 0;


for (int i = 1; i < 1000; i++)
{
    if (File.Exists("img (" + i + ").png"))
    {
        processar("img (" + i + ").png");
        contador++;
    }
}
 
//------------------------------

for (int i = 1; i < 1000; i++)
{
    if (File.Exists("img (" + i + ").jpg"))
    {
        processar("img (" + i + ").jpg");
        contador++;
    }
}
 
//------------------------------

for (int i = 1; i < 1000; i++)
{
    if (File.Exists("img (" + i + ").jpeg"))
    {
        processar("img (" + i + ").jpeg");
        contador++;
    }
}
 
//------------------------------

for (int i = 1; i < 1000; i++)
{
    if (File.Exists("img (" + i + ").bmp"))
    {
        processar("img (" + i + ").bmp");
        contador++;
    }
}


if (contador > 0)
{
    Console.WriteLine("");
    Console.WriteLine("Foram criadoos " + contador + " arquivos");
    Console.WriteLine("");
    Thread.Sleep(5000);
}
else
{
    Console.WriteLine("");
    Console.WriteLine("Nenhuma foto encontrada.");
    Console.WriteLine("");
    Console.WriteLine("Selecione todas e renomeie para 'img', ficando:");
    Console.WriteLine("img (1)");
    Console.WriteLine("img (2)");
    Console.WriteLine("img (3)");
    Console.WriteLine("");
    Thread.Sleep(5000);
}



static void processar(string FileName) {
    string textBox1 = "dede";

    byte[] imageBytes = File.ReadAllBytes(FileName);
    string base64String = Convert.ToBase64String(imageBytes);

    //---------------------
    string input = textBox1;
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


    string richTextBox1 = Convert.ToBase64String(Encoding.UTF8.GetBytes(e2.ToString()));


    int ct = 1;
    for (int i = 1; i < 1000; i++)
    {
        if (!File.Exists("img (" + i + ").txt"))
        {
            ct = i;
            break;
        }
    }
    File.WriteAllText("img (" + ct + ").txt", richTextBox1);
    Console.WriteLine("Arquivo " + ct + " criado com sucesso");
    
}

 

 