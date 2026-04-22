<?php
include('api_dashboard.php');
 
 
if(isset($_GET['email']) && isset($_GET['password']))
{
  $retorno = Login($_GET['email'],$_GET['password']);
  if($retorno == 1){
      $_SESSION['logado'] = $_GET['email'];
      header("Location: index_adm.php");
       exit;
  }
  if($retorno == 2){
      header("Location: login.php?alerta=Usuario invalido");
       exit;
  }
  if($retorno == 3){
      header("Location: login.php?alerta=Senha invalida");
       exit;
  }


  //header("Location: login.php?alerta=Usuario ou senha invalidos");
}

   

?>



<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Painel de Login Dark</title>
    <style>
    .red {
        color: red;
    }

    :root {
        --bg: #0b0f14;
        --panel: rgba(18, 24, 33, 0.92);
        --panel-2: #18212c;
        --border: #263241;
        --text: #eef4ff;
        --muted: #9aa8ba;
        --accent: #5aa9ff;
        --accent-2: #7a5cff;
        --accent-soft: rgba(90, 169, 255, 0.12);
        --shadow: 0 24px 60px rgba(0, 0, 0, 0.35);
        --radius: 22px;
    }

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        min-height: 100vh;
        display: grid;
        place-items: center;
        padding: 24px;
        font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        color: var(--text);
        background:
            radial-gradient(circle at top left, rgba(90, 169, 255, 0.18), transparent 28%),
            radial-gradient(circle at top right, rgba(122, 92, 255, 0.14), transparent 22%),
            radial-gradient(circle at bottom center, rgba(90, 169, 255, 0.08), transparent 30%),
            var(--bg);
    }

    button,
    input {
        font: inherit;
    }

    .login-shell {
        width: min(1080px, 100%);
        min-height: 680px;
        /*display: grid;*/
        grid-template-columns: 1.05fr 0.95fr;
        background: var(--panel);
        border: 1px solid var(--border);
        border-radius: 30px;
        overflow: hidden;
        box-shadow: var(--shadow);
        backdrop-filter: blur(12px);
    }

    .brand-side {
        position: relative;
        padding: 42px;
        background:
            linear-gradient(180deg, rgba(90, 169, 255, 0.08), rgba(122, 92, 255, 0.03)),
            rgba(10, 14, 20, 0.55);
        border-right: 1px solid var(--border);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 28px;
    }

    .brand-top {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .logo {
        width: 52px;
        height: 52px;
        border-radius: 16px;
        display: grid;
        place-items: center;
        font-size: 1.15rem;
        font-weight: 800;
        background: linear-gradient(135deg, var(--accent), var(--accent-2));
        color: white;
        box-shadow: 0 16px 30px rgba(90, 169, 255, 0.2);
    }

    .brand-name h1 {
        font-size: 1.1rem;
        margin-bottom: 4px;
    }

    .brand-name span {
        color: var(--muted);
        font-size: 0.92rem;
    }

    .hero-copy h2 {
        font-size: clamp(2rem, 4vw, 3.4rem);
        line-height: 1.05;
        margin-bottom: 16px;
        max-width: 8ch;
    }

    .hero-copy p {
        max-width: 48ch;
        color: var(--muted);
        line-height: 1.7;
        font-size: 1rem;
    }

    .feature-list {
        display: grid;
        gap: 14px;
        margin-top: 28px;
    }

    .feature-card {
        display: flex;
        gap: 14px;
        align-items: flex-start;
        padding: 16px;
        border-radius: 18px;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.05);
    }

    .feature-icon {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        flex-shrink: 0;
        display: grid;
        place-items: center;
        background: var(--accent-soft);
        color: #9dcbff;
        font-weight: 800;
    }

    .feature-card strong {
        display: block;
        margin-bottom: 4px;
        font-size: 0.96rem;
    }

    .feature-card p {
        color: var(--muted);
        line-height: 1.6;
        font-size: 0.9rem;
    }

    .brand-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
        color: var(--muted);
        font-size: 0.9rem;
    }

    .status-pill {
        padding: 8px 12px;
        border-radius: 999px;
        border: 1px solid rgba(90, 169, 255, 0.2);
        background: rgba(90, 169, 255, 0.08);
        color: #9dcbff;
        font-weight: 700;
        font-size: 0.82rem;
    }

    .login-side {
        display: grid;
        place-items: center;
        padding: 34px;
        background: linear-gradient(180deg, rgba(255, 255, 255, 0.015), rgba(255, 255, 255, 0));
        background-color: transparent;
    }

    .login-card {
        width: min(420px, 100%);
        display: flex;
        flex-direction: column;
        gap: 22px;
    }

    .login-header h3 {
        font-size: 1.9rem;
        margin-bottom: 8px;
    }

    .login-header p {
        color: var(--muted);
        line-height: 1.65;
    }

    .social-login {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .social-btn,
    .ghost-btn,
    .submit-btn {
        border-radius: 14px;
        padding: 13px 16px;
        cursor: pointer;
        transition: transform 0.2s ease, opacity 0.2s ease, border-color 0.2s ease;
    }

    .social-btn,
    .ghost-btn {
        border: 1px solid var(--border);
        background: rgba(255, 255, 255, 0.03);
        color: var(--text);
    }

    .submit-btn {
        border: none;
        background: linear-gradient(135deg, var(--accent), var(--accent-2));
        color: white;
        font-weight: 700;
        box-shadow: 0 16px 26px rgba(90, 169, 255, 0.18);
    }

    .social-btn:hover,
    .ghost-btn:hover,
    .submit-btn:hover {
        transform: translateY(-1px);
        opacity: 0.98;
    }

    .divider {
        display: flex;
        align-items: center;
        gap: 12px;
        color: var(--muted);
        font-size: 0.86rem;
    }

    .divider::before,
    .divider::after {
        content: "";
        flex: 1;
        height: 1px;
        background: var(--border);
    }

    .login-form {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .field {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .field-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
    }

    .field label,
    .field-row label {
        color: var(--muted);
        font-size: 0.9rem;
        font-weight: 600;
    }

    .field a,
    .signup-row a {
        color: #9dcbff;
        text-decoration: none;
    }

    .input-wrap {
        position: relative;
    }

    .input-wrap input {
        width: 100%;
        height: 54px;
        padding: 0 16px;
        border-radius: 15px;
        border: 1px solid var(--border);
        background: var(--panel-2);
        color: var(--text);
        outline: none;
    }

    .input-wrap input:focus {
        border-color: rgba(90, 169, 255, 0.45);
        box-shadow: 0 0 0 4px rgba(90, 169, 255, 0.08);
    }

    .password-toggle {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        border: none;
        background: transparent;
        color: var(--muted);
        padding: 8px 10px;
        border-radius: 10px;
        cursor: pointer;
    }

    .extra-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
        color: var(--muted);
        font-size: 0.9rem;
    }

    .checkbox {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .checkbox input {
        accent-color: var(--accent);
    }

    .signup-row {
        text-align: center;
        color: var(--muted);
        font-size: 0.92rem;
    }

    .toast {
        position: fixed;
        right: 24px;
        bottom: 24px;
        padding: 14px 16px;
        border-radius: 16px;
        background: rgba(18, 24, 33, 0.96);
        border: 1px solid rgba(90, 169, 255, 0.24);
        color: var(--text);
        box-shadow: var(--shadow);
        opacity: 0;
        transform: translateY(12px);
        pointer-events: none;
        transition: opacity 0.25s ease, transform 0.25s ease;
    }

    .toast.show {
        opacity: 1;
        transform: translateY(0);
    }

    @media (max-width: 900px) {
        .login-shell {
            grid-template-columns: 1fr;
        }

        .brand-side {
            border-right: none;
            border-bottom: 1px solid var(--border);
        }
    }

    @media (max-width: 560px) {
        body {
            padding: 14px;
        }

        .brand-side,
        .login-side {
            padding: 24px;
        }

        .social-login {
            grid-template-columns: 1fr;
        }

        .hero-copy h2 {
            max-width: none;
        }
    }
    </style>
</head>

<script src="particulas.js"></script>

<body>
    <main class="login-shell">
        <!--

        <section class="brand-side">
            <div>
                <div class="brand-top">
                    <div class="logo">M</div>
                    <div class="brand-name">
                        <h1>MailBox Dark</h1>
                        <span>Área segura de acesso</span>
                    </div>
                </div>

                <div class="hero-copy" style="margin-top: 46px;">
                    <h2>Acesse sua caixa com estilo.</h2>
                    <p>
                        Um painel de login com a mesma identidade visual da interface principal, usando tons escuros,
                        detalhes em azul e roxo e um layout moderno focado em clareza.
                    </p>
                </div>

                <div class="feature-list">
                    <article class="feature-card">
                        <div class="feature-icon">01</div>
                        <div>
                            <strong>Visual consistente</strong>
                            <p>Mesma linguagem estética do inbox: dark mode, brilho suave e contraste elegante.</p>
                        </div>
                    </article>

                    <article class="feature-card">
                        <div class="feature-icon">02</div>
                        <div>
                            <strong>Experiência moderna</strong>
                            <p>Campos amplos, hierarquia tipográfica clara e botões com destaque visual.</p>
                        </div>
                    </article>

                    <article class="feature-card">
                        <div class="feature-icon">03</div>
                        <div>
                            <strong>Pronto para integrar</strong>
                            <p>Estrutura em HTML, CSS e JavaScript puro, fácil de conectar ao seu backend depois.</p>
                        </div>
                    </article>
                </div>
            </div>

            <div class="brand-footer">
                <span class="status-pill">Segurança ativa</span>
                <span>Ambiente protegido • Dark UI</span>
            </div>
        </section>
  -->

        <section class="login-side">


            <center>

                <div class="login-card">

                    <div class="login-header">


                        <style>
                        .logo2 {
                            width: 80%;
                            background-color: transparent;
                        }
                        </style>


                        <center>
                            <img src="logo4.png" class="logo2" alt="">
                        </center>

                        <h3>Entrar</h3>
                        <p>Faça login para acessar sua conta, revisar mensagens e gerenciar sua caixa de entrada.</p>

                    </div>



                    <div class="divider"></div>

                    <?php 
                            
                            if(isset($_GET['alerta']))
                            {
                                  echo '<p class="red"><b>'.$_GET['alerta'].'</b></p>';
                            } 
                        ?>

                    <form class="login-form" id="loginForm">
                        <div class="field">
                            <label for="email">Usuário</label>
                            <div class="input-wrap">
                                <input id="email" name="email" type="text" placeholder="Nome de Usuario" required />
                            </div>
                        </div>

                        <div class="field">
                            <div class="field">
                                <label for="password">Senha</label>
                            </div>
                            <div class="input-wrap">
                                <input id="password" name="password" type="password" placeholder="Digite sua senha"
                                    required />
                                <button class="password-toggle" type="button" id="togglePassword">Mostrar</button>
                            </div>
                        </div>

                        <!--
                         <div class="extra">
                            <label class="checkbox">
                                <input type="checkbox" />
                                <span>Lembrar de mim</span>
                            </label>

                        </div>
                          -->

                        <button class="submit-btn" id="Logar">Entrar na conta</button>

                    </form>

                    <!--
                     <div class="signup-row">
                        Não tem conta? <a href="#">Criar acesso</a>
                    </div>
                    -->

                </div>


            </center>
        </section>
    </main>

    <div class="toast" id="toast">Aguarde...</div>

    <script>
    document.getElementById('Logar').addEventListener('click', () => {

        document.getElementById('Logar').textContent = "Aguarde..."
        document.getElementById('Logar').classList.replace("submit-btn", "ghost-btn");

        const nomeusuario = document.getElementById('email').value;
        const senhausuario = document.getElementById('password').value;

        if (nomeusuario !== "" && senhausuario !== "") {
            window.location.href = "login.php?usuario=" +
                nomeusuario +
                "&senha=" +
                senhausuario;
        }


    })



















    const loginForm = document.getElementById('loginForm');
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const toast = document.getElementById('toast');

    function showToast(message) {
        toast.textContent = message;
        toast.classList.add('show');
        clearTimeout(showToast.timeoutId);
        showToast.timeoutId = setTimeout(() => {
            toast.classList.remove('show');
        }, 2400);
    }

    togglePassword.addEventListener('click', () => {
        const isPassword = passwordInput.type === 'password';
        passwordInput.type = isPassword ? 'text' : 'password';
        togglePassword.textContent = isPassword ? 'Ocultar' : 'Mostrar';
    });

    loginForm.addEventListener('submit', (event) => {
        event.preventDefault();
        showToast('Login enviado com sucesso.');
    });
    </script>
</body>


</html>