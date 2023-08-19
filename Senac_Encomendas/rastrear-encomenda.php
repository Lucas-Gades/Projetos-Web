<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rastrear - Encomenda</title>
    <!--Icone da aba da pagina-->
    <link rel="shortcut icon" href="img/logo-aba.png">
    <!--Importação da nossa folha de estilo-->
    <link rel="stylesheet" href="css/style.css">
</head>


<body class="body-rastrear">
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
                <li class="li-menu-index"><a class="active-li-menu" href="rastrear-encomenda.php">Rastrear Encomenda</a></li>
                <li class="li-menu-index"><a href="#">Pedido</a></li>
                <li class="li-menu-index"><a href="agencia.php">Agências</a></li>
                <li class="li-menu-index"><a href="#">Contato</a></li>
                <li class="li-menu-index"><a href="feedback.php">Feedback</a></li>
            </ul>
        </nav>
    </header>
    <main class="main-content-rastrear">
        <section class="acompanhe-principal-rastrear">
            <header class="acompanhe-rastrear">
                <figure class="icon-rastrear">
                    <ion-icon name="cube-outline"></ion-icon>
                </figure>
                <h1>Acompanhe o Seu Objeto</h1>
            </header>
            <form class="busca-rastrear" method="POST">
                <input type="text" name="pedido" placeholder="Buscar Pedido">
                <div class="search-icon">
                    <ion-icon name="search-outline"></ion-icon>
                </div>
                <div class="button-rastrear">
                    <button type="submit">Buscar</button>
                </div>
            </form>
            <div id="resultado-pedido" class="resultado-pedido">
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    require_once 'encomendasDao.php';
                    require_once 'conexao.php';

                    try {

                        $conexao = Conexao::getConexao();

                        $encomendaDAO = new EncomendaDAO($conexao);

                        if (isset($_POST['pedido'])) {
                            $pedido = $_POST['pedido'];
                            $encomenda = $encomendaDAO->buscarEncomendaPorNumero($pedido);
                            if ($encomenda) {
                                echo "Número do Pedido: " . $encomenda['numero_pedido'] . "<br>";
                                echo "Nome do Cliente: " . $encomenda['nome_cliente'] . "<br>";
                                echo "Status: " . $encomenda['status'] . "<br>";
                            } else {
                                echo "Nenhuma encomenda encontrada para o número de pedido informado.";
                            }
                        }
                    } catch (PDOException $e) {
                        echo "Erro na conexão com o banco de dados: " . $e->getMessage();
                    }
                }
                ?>
            </div>
        </section>
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
            <ion-icon class="footer-copyright-icon-box" name="cube-sharp"></ion-icon>
            <p class="footer-senac-encomendas">&copy; 2023 Senac Encomendas. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>

</html>