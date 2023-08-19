<?php

include_once "conexao.php";
session_start();



if (isset($_POST["button-login-adm"])) {
    $username = $_POST["login-name"];
    $password = $_POST["login-password"];

    $con = Conexao::getConexao();
    $query = "SELECT * FROM adm_register WHERE username = :username AND password = SHA1(:password)";
    $sql = $con->prepare($query);
    $sql->bindParam(":username", $username);
    $sql->bindParam(":password", $password);
    $sql->execute();


    if ($sql->rowCount() > 0) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header('Location: admin-painel.php');
        exit();
    } else {
        $warning = "<span class='error-message' style='color: red;'>Nome de usuário ou senha inválidos.</span>";
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senac Encomendas</title>
    <!-- Importando o arquivo CSS do Swiper -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <!-- Importação do normalize css para arrumar bugs -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- CSS - Bootstrap 5.3.0 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!--Icone da aba da pagina-->
    <link rel="shortcut icon" href="img/logo-aba.png">
    <!--Importação da nossa folha de estilo-->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- INICIO DO HEADER -->
    <header class="header-index">
        <!--LOGO DO MENU-->
        <div class="header-logo">
            <img class="header-logo-img" src="img/logo.png" alt="Logo da Senac Encomendas">
        </div>
        <!-- MENU  -->
        <nav class="nav-index">
            <ul class="list-menu-index">
                <li class="li-menu-index"><a href="index.php">Inicio</a></li>
                <li class="li-menu-index"><a href="galeria.php">Galeria</a></li>
                <li class="li-menu-index"><a href="rastrear-encomenda.php">Rastrear Encomenda</a></li>
                <li class="li-menu-index"><a href="#">Pedido</a></li>
                <li class="li-menu-index"><a href="agencia.php">Agências</a></li>
                <li class="li-menu-index"><a href="#">Contato</a></li>
                <li class="li-menu-index"><a href="feedback.php">Feedback</a></li>
            </ul>
        </nav>
    </header>
    <!--  MAIN LOGIN-ADM.HTML  -->
    <main class="main-login-adm">
        <section class="main-section-login">
            <h1 class="main-tittle-login">Login</h1>
            <article class="article-form-login-adm">
                <div class="conjunt-form-login-adm">
                    <ion-icon class="icon-user-form-login" name="person-circle-sharp"></ion-icon>
                    <form class="form-login-adm" action="#" method="post">
                        <input type="text" name="login-name" id="login-name" placeholder="Usuário" require>
                        <input type="password" name="login-password" id="login-password" placeholder="Senha" require>
                        <input type="submit" action="#" class="login-button" name="button-login-adm" value="LOGIN">
                        <input type="button" class="register-button" name="button-register-login-adm" value="REGISTRAR-SE" onclick="window.location.href='registrar-adm.php'">
                    </form>
                </div>
            </article>
            <article class="article-floating-img">
                <p class="team-motivational-phrase">
                    "REALIZE O LOGIN E FAÇA PARTE DO NOSSO TIME, JUNTOS ALCANÇAREMOS GRANDES CONQUISTAS."
                </p>
                <figure class="figure-head-floating-img">
                    <img class="img-hand-floating-img" src="./img/caixa-mao-flutuante.png" alt="Imagem da mão flutuando com uma caixa junto">
                </figure>
            </article>
        </section>
        <figure class="figure-icon-truck">
            <?php if (!empty($warning)) : ?>
                <span style="color: <?php echo ($warning !== false) ? '#00d70e' : '#d70000'; ?>;"><?php echo $warning; ?></span>
            <?php endif; ?>
            <img class="icon-truck" src="./img/caminhao-icone.png" alt="Icone do caminhão em movimento">

        </figure>
    </main>
    <!--  FOOTER  -->
    <footer class="footer-index">
        <div class="footer-row">
            <div class="footer-column">
                <h2 class="footer-title">Fale conosco</h2>
                <nav class="footer-nav">
                    <ul class="footer-list-nav">
                        <li class="footer-list-nav-li"><a href="#">Registro de manifestações</a></li>
                        <li class="footer-list-nav-li"><a href="#">Central de atendimento</a></li>
                        <li class="footer-list-nav-li"><a href="#">Soluções para o seu negócio</a></li>
                        <li class="footer-list-nav-li"><a href="#">Suporte ao cliente com contrato</a></li>
                        <li class="footer-list-nav-li"><a href="#">Ouvidoria</a></li>
                    </ul>
                </nav>
            </div>
            <div class="footer-column">
                <h2 class="footer-title">Sobre o Senac Encomendas</h2>
                <nav class="footer-nav">
                    <ul class="footer-list-nav">
                        <li class="footer-list-nav-li"><a href="#">Identidade corporativa</a></li>
                        <li class="footer-list-nav-li"><a href="#">Educação e cultura</a></li>
                        <li class="footer-list-nav-li"><a href="#">Código de Conduta Ética e Integridade</a></li>
                        <li class="footer-list-nav-li"><a href="#">Transparência e prestação de contas</a></li>
                        <li class="footer-list-nav-li"><a href="#">Política de privacidade e cookies</a></li>
                        <li class="footer-list-nav-li"><a href="#">Sustentabilidade</a></li>
                    </ul>
                </nav>
            </div>
            <div class="footer-column">
                <h2 class="footer-title">Outros Sites</h2>
                <nav class="footer-nav">
                    <ul class="footer-list-nav">
                        <li class="footer-list-nav-li"><a href="index.html">Lojas online do Senac Encomendas</a></li>
                        <li class="footer-list-nav-li"><a href="#">Postalis</a></li>
                        <li class="footer-list-nav-li"><a href="#">Postal Saúde</a></li>
                        <li class="footer-list-nav-li"><a href="#">Postalis</a></li>
                    </ul>
                </nav>
                <h2 class="footer-title">Redes Socias</h2>
                <nav class="footer-nav-social-networks">
                    <ul class="footer-list-nav-social-networks">
                        <li class="footer-list-nav-social-facebook">
                            <a href="https://www.facebook.com/" target="_blank">
                                <ion-icon name="logo-facebook"></ion-icon>
                            </a>
                        </li>
                        <li class="footer-list-nav-social-twitter" target="_blank">
                            <a href="https://www.twitter.com/">
                                <ion-icon name="logo-twitter"></ion-icon>
                            </a>
                        </li>
                        <li class="footer-list-nav-social-linkedin">
                            <a href="https://www.linkedin.com/" target="_blank">
                                <ion-icon name="logo-linkedin"></ion-icon>
                            </a>
                        </li>
                        <li class="footer-list-nav-social-whatsapp" target="_blank">
                            <a href="https://www.whatsapp.com/">
                                <ion-icon name="logo-whatsapp"></ion-icon>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="footer-copyright">
            <h2 class="footer-copyright-title">Senac Encomendas</h2>
            <ion-icon class="copyright-icon-box" name="cube-sharp"></ion-icon>
            <p class="copyright-senac-encomendas">&copy; 2023 Senac Encomendas. Todos os direitos reservados.</p>
        </div>
    </footer>
    <!-- JS - Bootstrap 5.3.0 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <!-- Importando o arquivo JavaScript do Swiper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.5/swiper-bundle.min.js"></script>
    <!-- importação da biblioteca de ícones -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!--Importação da biblioteca do JQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <!--Importação da nossa biblioteca javascript-->
    <script src="js/script.js"></script>
</body>

</html>