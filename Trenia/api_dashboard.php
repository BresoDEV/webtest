<?php
session_start();
 
$administradorNOME = "Eduardo";
$administradorSENHA = "1020";

$pastaEmails = joaat('emails');

init();
function init(){

    global $pastaEmails;

    if(!is_dir($pastaEmails)){
        mkdir($pastaEmails);
    }

}


function redirecionar($link){
    echo '<script>window.location.href="'.$link.'"</script>';
}



function joaat($st)
{
   for ($i = 0; $i < 10; $i++) {
       $st = hash('joaat', $st);
   }
   return strtoupper($st);
}


function encrip1($st)
{
    $encrypted = openssl_encrypt($st, "aes-256-cbc", "BresoDEV", 0, 'BresoDEVBresoDEV');
    //return base64_encode($encrypted);
    return base64_encode($encrypted);
}
function decrip1($st)
{
    $decrypted = openssl_decrypt(base64_decode($st), "aes-256-cbc", "BresoDEV", 0, 'BresoDEVBresoDEV');
    return $decrypted;
}

function encrip($st)
{
    $a = encrip1($st);
    for ($i=0; $i < 3; $i++) { 
      $a = encrip1($a);
    }
    return $a;
}

function decrip($st)
{
    $a = decrip1($st);
    for ($i=0; $i < 3; $i++) { 
      $a = decrip1($a);
    }
    return $a;
}

  
    function Login($usuario, $senha)
    {
        //1 = Logado com sucesso
        //2 = Usuario invalido
        //3 = Senha incorreta

        global $administradorNOME, $administradorSENHA;

        if($usuario == $administradorNOME){
             if( $senha == $administradorSENHA){
                return 1;
             }else
             {
                return 3;
             }
        }else{
            return 2;
        }
    }



function LerEmails(){

    global $pastaEmails;
    $s = "";
    $ct = 1;

    for ($i = 1000; $i > 0; $i--) { 
       
        if(file_exists($pastaEmails.'/'.joaat($i).'.txt')){

            $email = decrip(file_get_contents($pastaEmails.'/'.joaat($i).'.txt'));
             
            if(!empty($email)){

                $s .= "
            {
                id: '".joaat($i)."',
                name: '".explode("|",$email)[0]."',
                email: '".explode("|",$email)[1]."',
                subject: '".explode("|",$email)[2]."',
                snippet: '".explode("|",$email)[3]."',
                body: `".explode("|",$email)[3]."`,
                time: '".explode("|",$email)[5].", ".explode("|",$email)[4]."',
                date: '".explode("|",$email)[5].", ".explode("|",$email)[4]."',
                tag: 'Trabalho',
                tagClass: 'primary',
                attachment: '',
                unread: true
            },
            ";
            }
            

            $ct++;
        }
        
    }
    return $s;
}



//EscreverEmail("Eduardo","ed@gmail.com","Teste","teste testador");
//EscreverEmail("Milena","mimi@gmail.com","Parquinho","Quero ir no parquinho hoje");
//EscreverEmail("Julyely","juju@gmail.com","Te amo","Amo vc");
//EscreverEmail("Cuca","croquete@auau.com","Carro","Ensinei a Tina e a Cacau a subir no carro pra espiar la fora");
//EscreverEmail("Tina","botina@auau.com","Coco da Mika","Comi a merda da Mika e gostei");
//EscreverEmail("Cacau","polenta@auau.com","Coco","Caguei pela garagem toda, desculpa");
//EscreverEmail("Mika","miau@auau.com","Sem ração","Ração acabou");

if(isset($_GET['enviarEmail'])){
	/*
	document.getElementById('nome').value
			document.getElementById('empresa').value
			document.getElementById('telefone').value
			document.getElementById('servico').value
			document.getElementById('mensagem').value
			*/
	EscreverEmail($_GET['nome'].' - '.$_GET['empresa'],$_GET['telefone'],$_GET['servico'],$_GET['mensagem']);		
}

function EscreverEmail($nome,$emailOuWhats,$assunto,$texto){

    global $pastaEmails;
    
    $index = 1;

    for ($i = 1; $i < 10000; $i++) { 
        if(file_exists($pastaEmails.'/'.joaat($i).'.txt')){
            $index++;
        }else{
            break;
        }
        
    }

    date_default_timezone_set("America/Sao_Paulo");

    file_put_contents($pastaEmails.'/'.joaat($index).'.txt',
    encrip(htmlspecialchars($nome.'|'.$emailOuWhats.'|'.$assunto.'|'.$texto.'|'.date("H:i").'|'.date("d/m/Y"), ENT_QUOTES, 'UTF-8')));
     
    
}


if(isset($_GET['apagarEmail'])){
    apagarEmail($_GET['apagarEmail']);
    redirecionar('index_adm.php');
}

function apagarEmail($id){
    global $pastaEmails;
    file_put_contents($pastaEmails.'/'.$id.'.txt',"");
}

 
function apagarTodosEmails(){
    global $pastaEmails;

    for ($i = 1; $i < 10000; $i++) { 
        if(file_exists($pastaEmails.'/'.joaat($i).'.txt')){
            unlink($pastaEmails.'/'.joaat($i).'.txt');
        }else{
            break;
        }
        
    }

    
}
?>