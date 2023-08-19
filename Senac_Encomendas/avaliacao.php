<?php
session_start();
include_once("conexao.php");
$conn = Conexao::getConexao();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliações</title>
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
    <main>
        <form class="form-avaliacao" name="avaliacao" method="POST" action="processa.php" class="row g-6" enctype="multipart/form-data">
            <div class="col-md-4">
                <div class="mb-3" id="marge4">
                    <legend class="mb-4" style="color:navy">
                        <h4 style="font-family: Arial Black;">Avaliações Registradas</h4>
                    </legend>
                </div>
                <div class="mb-3 ">
                    <table class="table table-borderless">
                        <tbody>
                            <?php
                            $sql = "SELECT nome,estrela, mensagem FROM feedback order by codfeed desc";
                            $result = $conn->query($sql);
                            while ($list = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>";

                                if ($list['estrela'] == '1') {
                                    echo "<td><img src='img/Estrela_1.png'></td>";
                                }
                                if ($list['estrela'] == '2') {
                                    echo "<td><img src='img/Estrela_2.png'></td>";
                                }
                                if ($list['estrela'] == '3') {
                                    echo "<td><img src='img/Estrela_3.png'></td>";
                                }
                                if ($list['estrela'] == '4') {
                                    echo "<td><img src='img/Estrela_4.png'></td>";
                                }
                                if ($list['estrela'] == '5') {
                                    echo "<td><img src='img/Estrela_5.png'></td>";
                                }

                                if ($list['estrela'] <= '2') {
                                    echo "<td><img src='img/Negativo.png'></td>";
                                } else {
                                    echo "<td><img src='img/Positivo.png'></td>";
                                }
                                echo "</tr>";

                                echo "<tr>";
                                echo "<td><img src='img/Foto.png'></td>";
                                echo "<td>" . $list['nome'] . "</td>";
                                echo "<td>" . $list['mensagem'] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
        <div class="col-12 text-center mt-4">
            <a href="Feedback.php" class="btn btn-primary">Voltar à página de Feedback</a>
        </div>
    </main>
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
            <p class="footer-copyright-senac-encomendas">&copy; 2023 Senac Encomendas. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>

</html>