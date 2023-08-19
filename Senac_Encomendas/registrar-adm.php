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
<?php


include_once "admDao.php";
include_once "adm.php";
include_once "img-adm.php";

session_start();

if (isset($_POST["button-register"])) {
    if ($_POST["button-register"] == "REGISTRAR") {
        $id = null;
        $name = $_POST["name"];
        $username = $_POST["username"];
        $occupation = $_POST["occupation"];
        $specialty = $_POST["specialty"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $password = $_POST["password"];
        $arquivo = $_FILES["user_image"];
        if ($arquivo != "" && $arquivo != null) {
            $userImage = Imagem::uploadImagem("./img/uploads/");
            if ($userImage !== false) {
                $warning = "Cadastrado com sucesso.";
                $adm = new Adm(
                    $id,
                    $name,
                    $username,
                    $occupation,
                    $specialty,
                    $email,
                    $phone,
                    sha1($password),
                    $userImage
                );
                AdmDao::inserir($adm);
                header("Location: login-adm.php");
            } else {
                $warning = "Erro ao fazer o upload!";
            }
        }
    }
}



?>

<body>
    <header class="header-index">
        <div class="header-logo">
            <img class="header-logo-img" src="img/logo.png" alt="Logo da Senac Encomendas">
        </div>
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
    <!--  MAIN REGISTRAR-ADM.HTML  -->
    <main class="main-register-adm">
        <section class="main-section-register-adm">
            <h1 class="main-tittle-register-adm">Registrar</h1>
            <article class="article-card-user-data">
                <div class="card-user-data">
                    <div class="header-card-user-data">
                        Senac Encomendas
                    </div>
                    <div class="circle-img-user-card-user-data">
                        <img src="#" class="img-user-card-user-data" id="show-image">
                    </div>
                    <div class="information-card-user-data">
                        <div class="name-card-user-data">
                            <span id="name-view">Nome</span>
                        </div>
                        <div class="specialty-card-user-data">
                            <span id="specialty-view">Especialidade</span>
                        </div>
                        <ul class="list-information-card-user-data">
                            <li class="li-information-card-user-data">Usuário: <span id="username-view"></span>
                            </li>
                            <li class="li-information-card-user-data">Área de atuação: <span id="occupation-view"></span>
                            </li>
                            <li class="li-information-card-user-data">E-mail: <span id="email-view"></span>
                            </li>
                            <li class="li-information-card-user-data">Telefone: <span id="phone-view"></span></li>
                        </ul>
                    </div>
                    <div class="footer-card-user-data">

                    </div>
                </div>
            </article>
            <article class="article-form-register-adm">
                <div class="conjunt-form-register-adm">
                    <form class="form-register-adm" action="#" method="post" enctype="multipart/form-data">
                        <input type="text" name="name" id="name" onkeyup="getvalues('name')" placeholder="Nome:" required>
                        <input type="text" name="username" id="username" onkeyup="getvalues('username') " placeholder="Usuário:" required>
                        <select name="occupation" id="occupation" onchange="selectValues()" required>
                            <option value="" hidden>Selecione uma área de atuação</option>
                            <option value="rh">Recursos Humanos</option>
                            <option value="finance">Financeiro</option>
                            <option value="marketing">Marketing</option>
                            <option value="ti">Tecnologia da Informação</option>
                            <option value="sales">Vendas</option>
                        </select>
                        <input type="text" name="specialty" id="specialty" onkeyup="getvalues('specialty')" placeholder="Especialidade:" required>
                        <input type="email" name="email" id="email" onkeyup="getvalues('email')" placeholder="Email:" required>
                        <input type="tel" name="phone" id="phone" onkeyup="getvalues('phone')" placeholder="Telefone:" required>
                        <input type="password" name="password" id="password" placeholder="Senha:" required>
                        <label for="user-img-register" id="label-register-file-img-user">Sua foto aqui:</label>
                        <input type="file" name="user_image" id="user_image" required>


                        <input type="submit" class="register-button-adm-register" name="button-register" value="REGISTRAR">
                        <input type="reset" class="clear-button-adm-register" value="LIMPAR">
                        <input type="button" class="return-button-adm-register" value="RETORNAR AO LOGIN" onclick="window.location.href='login-adm.php'">

                    </form>
                    <?php if (!empty($warning)) : ?>
                        <h2 style="color: <?php echo ($userImage !== false) ? '#00d70e' : '#d70000'; ?>;"><?php echo $warning; ?></h2>
                    <?php endif; ?>
                </div>
            </article>
        </section>
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