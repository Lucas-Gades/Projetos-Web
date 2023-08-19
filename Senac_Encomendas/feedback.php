<?php
session_start();
include_once("conexao.php");

try {
    $conexao = Conexao::getConexao(); // Obter a conexão com o banco de dados

    // Verificar se o formulário foi submetido
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verificar se todos os campos foram preenchidos
        if (!empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['mensagem']) && !empty($_POST['estrela'])) {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $mensagem = $_POST['mensagem'];
            $estrela = $_POST['estrela'];

            // Preparar a consulta SQL
            $consulta = $conexao->prepare("INSERT INTO feedback (nome, email, mensagem, estrela) VALUES (:nome, :email, :mensagem, :estrela)");

            // Bind dos parâmetros
            $consulta->bindParam(':nome', $nome);
            $consulta->bindParam(':email', $email);
            $consulta->bindParam(':mensagem', $mensagem);
            $consulta->bindParam(':estrela', $estrela);

            // Executar a consulta
            if ($consulta->execute()) {
                $_SESSION['msg'] = "AVALIAÇÃO CADASTRADA COM SUCESSO";
                header("Location: Feedback.php");
                exit;
            } else {
                $_SESSION['msg'] = "ERRO AO CADASTRAR A AVALIAÇÃO";
                header("Location: Feedback.php");
                exit;
            }
        } else {
            $_SESSION['msg'] = "TODOS OS CAMPOS SÃO OBRIGATÓRIOS";
            header("Location: Feedback.php");
            exit;
        }
    }
} catch (PDOException $e) {
    echo "Erro na conexão com o banco de dados: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <!-- Importação do normalize css para arrumar bugs -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- CSS - Bootstrap 5.3.0 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
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
                <li class="li-menu-index"><a class="active-li-menu" href="">Feedback</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <form class="form-feed" name="feedback" method="POST" action="#" class="row " enctype="multipart/form-data">
            <div class="col-md-4">

                <div class="mb-3" id="marge4">
                    <legend class="mb-4" style="color:navy">
                        <h4 style="font-family: Arial Black;">Feedback</h4>
                    </legend>
                    <input type="nome" class="form-control" id="nome" placeholder="Nome" name="nome">
                </div>

                <div class="mb-3">
                    <input type="email" class="form-control" id="email" placeholder="E-mail" name="email">
                </div>

                <div class="mb-5">
                    <textarea class="form-control" id="mensagem" rows="3" placeholder="Mensagem" style="height: 270px;" name="mensagem"></textarea>
                    <div id="marge5">
                        <legend style="color:navy">
                            <h4 style="font-family: Arial Black">Avaliação</h4>
                        </legend>
                    </div>

                    <div class="estrelas">
                        <input type="radio" id="vazio" name="estrela" value="" checked>

                        <label for="estrela_1"><i class="fa"></i></label>
                        <input type="radio" id="estrela_1" name="estrela" value="1">

                        <label for="estrela_2"><i class="fa"></i></label>
                        <input type="radio" id="estrela_2" name="estrela" value="2">

                        <label for="estrela_3"><i class="fa"></i></label>
                        <input type="radio" id="estrela_3" name="estrela" value="3">

                        <label for="estrela_4"><i class="fa"></i></label>
                        <input type="radio" id="estrela_4" name="estrela" value="4">

                        <label for="estrela_5"><i class="fa"></i></label>
                        <input type="radio" id="estrela_5" name="estrela" value="5">
                    </div>

                </div>

                <div>
                    <button type="submit" class="btn btn-primary" style="width: 150px;">ENVIAR</button>
                </div>
            </div>

            <div class="col-md-6">
                <img src="img/Feedback.png" alt="feedback" id="marge1">
                <div id="marge2">
                    <p><a class="link-opacity-10" href="Avaliacao.php">
                            <button type="button" class="btn btn-primary" id="marge5" style="width: 200px;">VISUALIZAR <BR> AVALIAÇÕES</button>
                        </a></p>
                </div>

                <div>
                    <legend style="color:navy">
                        <h5 style="font-family: Arial Black">
                            <?php
                            if (isset($_SESSION['msg'])) {
                                echo $_SESSION['msg'];
                                unset($_SESSION['msg']);
                            }
                            ?>
                        </h5>
                    </legend>
                </div>
            </div>
        </form>
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
            <p class="copyright-senac-encomendas">&copy; 2023 Senac Encomendas. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>

</html>