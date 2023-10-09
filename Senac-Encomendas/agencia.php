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
    <title>Buscar Agências</title>
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
        <nav class="nav-index">
            <ul class="list-menu-index">
                <li class="li-menu-index"><a href="index.php">Inicio</a></li>
                <li class="li-menu-index"><a href="galeria.php">Galeria</a></li>
                <li class="li-menu-index"><a href="rastrear-encomenda.php">Rastrear Encomenda</a></li>
                <li class="li-menu-index"><a href="#">Pedido</a></li>
                <li class="li-menu-index"><a class="active-li-menu" href="agencia.php">Agências</a></li>
                <li class="li-menu-index"><a href="#">Contato</a></li>
                <li class="li-menu-index"><a href="feedback.php">Feedback</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <form class="form-agencia" name="agencia" method="POST" action="" class="row g-6" enctype="multipart/form-data">
            <div class="col-md-4">
                <div class="mb-3">
                    <legend class="mb-4" style="color:navy">
                        <h4 style="font-family: Arial Black;">Buscar Agências</h4>
                    </legend>

                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example" name="uf">
                            <option value="">UF</option>
                            <option name="uf[]" value="RS">RS</option>
                            <option name="uf[]" value="SC">SC</option>
                            <option name="uf[]" value="SP">SP</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example" name="cidade">
                            <option value="">cidade</option>
                            <option value="Porto Alegre">Porto Alegre</option>
                            <option value="Gravataí">Gravataí</option>
                            <option value="Florianópolis">Florianópolis</option>
                            <option value="Campinas">Campinas</option>
                        </select>
                    </div>

                    <?php
                    $sql3 = "SELECT bairro FROM bairro order by bairro asc";
                    $result3 = $conn->query($sql3);
                    ?>

                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example">
                            <option value="">Bairro</option>
                            <?php
                            while ($list = $result3->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value=''>" . $list['bairro'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div>
                    <input type="submit" class="btn btn-primary" style="width: 150px;" value="LOCALIZAR">
                </div>
            </div>

            <div class="col-md-6">
                <img src="img/Agencias.png" alt="feedback" id="marge1">
            </div>

            <div class="mb-3" id="marge3" style="width:890px">
                <div class="p-3 text-primary-emphasis bg-primary-subtle border border-primary-subtle rounded-3" id="marge5">
                    <h5>AGÊNCIAS</h5>
                </div>
            </div>

            <?php

            $uf = $_POST["uf"] ?? null;
            $cidade = $_POST['cidade'] ?? null;

            $sql = "SELECT * FROM endereco WHERE uf = '$uf' AND cidade='$cidade'";
            $resultado = $conn->query($sql);

            while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                $cidade = $registro['cidade'];
                $uf = $registro['uf'];
                $bairro = $registro['bairro'];
                $endereco = $registro['endereco'];
                $cep = $registro['cep'];
                $tel = $registro['tel'];
                $agencia = $registro['agencia'];


            ?>
                <div class='mb-3' id='marge3' style="width:890px">
                    <table class="table table-borderless">
                        <tbody>
                            <tr class="align-left" style="color:navy">
                                <?php
                                echo "<td style='width:230px'><h5 style='font-family: Arial Black'>" . $agencia . "</h5</td>";
                                ?>
                            </tr>
                            <tr class="align-left" style="color:navy">
                                <?php
                                echo "<td>" . $endereco . "</td>";
                                echo "<td style='width:130px'>" . $bairro . "</td>";
                                echo "<td style='width:130px'>" . $cidade . "</td>";
                                echo "<td style='width:130px'>" . $uf . "</td>";
                                echo "<td>" . $cep . "</td>";
                                ?>
                            </tr>

                            <tr class="align-left" style="color:navy">
                                <td>
                                    <h6 style="font-family: Arial Black">Telefone</h6>
                                </td>
                            </tr>
                            <tr>
                                <?php
                                echo "<td style='color:navy'>" . $tel . "</td>";
                                ?>
                            </tr>

                        </tbody>
                    </table>
                </div>
            <?php
            }
            if ($resultado->rowCount() == 0) {
                echo "<div class='mb-3' id='marge3' style='width:890px'>";
                echo "<p>Nenhuma agência encontrada.</p>";
                echo "</div>";
            }
            ?>
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
            <ion-icon class="footer-copyright-icon-box" name="cube-sharp"></ion-icon>
            <p class="footer-copyright-senac-encomendas">&copy; 2023 Senac Encomendas. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>

</html>