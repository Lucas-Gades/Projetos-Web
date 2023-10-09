<?php
include_once "conexao.php";
include_once "encomendasDao.php";

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location:login-adm.php');
    exit;
}

$conn = Conexao::getConexao();

$encomendaDAO = new EncomendaDAO($conn);


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['inserir'])) {
    $numero_pedido = $_POST['numero_pedido'];
    $nome_cliente = $_POST['nome_cliente'];
    $status = $_POST['status'];

    if (!empty($numero_pedido) && !empty($nome_cliente) && !empty($status)) {

        if ($encomendaDAO->verificarEncomendaExistente($numero_pedido)) {
            $warning = "Encomenda já existe.";
        } else {
            $encomendaDAO->inserirEncomenda($numero_pedido, $nome_cliente, $status);
            $warning = "Encomenda inserida com sucesso!";
            $numero_pedido = "";
            $nome_cliente = "";
            $status = "";
        }
    } else {
        $warning = "Por favor, preencha todos os campos.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['alterar'])) {
    $id = $_POST['id_encomenda'];
    $numero_pedido = $_POST['numero_pedido'];
    $nome_cliente = $_POST['nome_cliente'];
    $status = $_POST['status'];

    $encomendaDAO->alterarEncomenda($id, $numero_pedido, $nome_cliente, $status);
    $warning = "Alterado com sucesso !";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['excluir'])) {
    $id = $_POST['id_encomenda'];
    $confirmacao = isset($_POST['confirmacao']) ? $_POST['confirmacao'] : '';
    if ($confirmacao === 'sim') {
        $encomendaDAO->excluirEncomenda($id);
        $warning = "Excluido com sucesso !";
    }
}

$encomendas = $encomendaDAO->listarEncomendas();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Admin Panel</title>
    <!--Importação do Bootstrap CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!--Importação da biblioteca de ícones-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
    <main class="admin-panel-main">
        <div class="admin-panel-container">
            <h2 class="admin-panel-title">Bem-vindo ao Painel Administrativo</h2>
            <p class="admin-panel-username">Você está logado como <?php echo $_SESSION['username']; ?>. <a href="logout.php" class="admin-panel-logout">Log Out</a></p>

            <h3 class="admin-panel-subtitle">Encomendas</h3>
            <?php if (!empty($encomendas)) : ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Número do Pedido</th>
                            <th>Nome do Cliente</th>
                            <th>Status</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($encomendas as $encomenda) : ?>
                            <tr>
                                <td><?php echo $encomenda['id']; ?></td>
                                <td><?php echo $encomenda['numero_pedido']; ?></td>
                                <td><?php echo $encomenda['nome_cliente']; ?></td>
                                <td><?php echo $encomenda['status']; ?></td>
                                <td>
                                    <form method="POST" action="admin-painel.php" style="display:inline-block">
                                        <input type="hidden" name="id_encomenda" value="<?php echo $encomenda['id']; ?>">
                                        <input type="hidden" name="numero_pedido" value="<?php echo $encomenda['numero_pedido']; ?>">
                                        <input type="hidden" name="nome_cliente" value="<?php echo $encomenda['nome_cliente']; ?>">
                                        <input type="hidden" name="status" value="<?php echo $encomenda['status']; ?>">
                                        <input type="hidden" name="confirmacao" value="sim"> <!-- Campo de confirmação -->
                                        <button type="submit" name="excluir" class="btn btn-danger btn-sm" onclick="return confirm('Deseja realmente excluir esta encomenda <?php echo $encomenda['numero_pedido']; ?>?')"><i class="fas fa-trash-alt"></i> Excluir</button>
                                        <button type="submit" name="alterar" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Alterar</button>

                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <p class="admin-panel-no-data">Nem uma encomenda cadastrada....</p>
            <?php endif; ?>
            <h3 class="admin-panel-subtitle">Inserir/Editar Encomenda</h3>
            <form class="admin-panel-form" method="POST" action="admin-painel.php" novalidate>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="numero_pedido" class="admin-panel-label">Número do Pedido:</label>
                        <input type="text" id="numero_pedido" name="numero_pedido" required class="admin-panel-input" value="<?php echo isset($numero_pedido) ? str_replace(array('SEN-', '-BR'), '', $numero_pedido) : ''; ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="nome_cliente" class="admin-panel-label">Nome do Cliente:</label>
                        <input type="text" id="nome_cliente" name="nome_cliente" required class="admin-panel-input" value="<?php echo isset($nome_cliente) ? $nome_cliente : ''; ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="status" class="admin-panel-label">Status:</label>
                        <select id="status" name="status" required class="admin-panel-input">
                            <option value="" <?php echo (!isset($status) || empty($status)) ? 'selected' : ''; ?>>Selecione o status</option>
                            <option value="Em preparação" <?php echo isset($status) && $status === 'Em preparação' ? 'selected' : ''; ?>>Em preparação</option>
                            <option value="Em trânsito" <?php echo isset($status) && $status === 'Em trânsito' ? 'selected' : ''; ?>>Em trânsito</option>
                            <option value="Entregue" <?php echo isset($status) && $status === 'Entregue' ? 'selected' : ''; ?>>Entregue</option>
                        </select>
                    </div>
                </div>
                <div class="admin-panel-buttons">
                    <input type="hidden" id="id_encomenda" name="id_encomenda" value="<?php echo isset($encomenda['id']) ? $encomenda['id'] : ''; ?>">
                    <button type="submit" name="alterar" class="btn btn-success"><i class="fas fa-edit"></i> Alterar</button>
                    <button type="submit" name="excluir" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Excluir</button>

                    <button type="submit" name="inserir" class="btn btn-primary"><i class="fas fa-plus"></i> Inserir</button>
                    <button type="submit" name="limpar" class="btn btn-secondary" onclick="limparCampos()"><i class="fas fa-eraser"></i> Limpar</button>
                    <?php if (!empty($warning)) : ?>
                        <span style="color: <?php echo ($warning !== false) ? '#00d70e' : '#d70000';  ?>;"><?php echo $warning; ?></span>
                    <?php endif; ?>
                </div>
            </form>

        </div>
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
    <!--Importação do Bootstrap JS-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!--Importação da nossa biblioteca javascript-->
    <script src="js/script.js"></script>
</body>

</html>