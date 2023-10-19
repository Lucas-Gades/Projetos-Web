<?php
class Imagem
{
    public static function uploadImagem($caminho)
    {
        if (!empty($_FILES['user_image']['name'])) {

            $nomeImagem = $_FILES['user_image']['name'];
            $tipo = $_FILES['user_image']['type'];
            $nomeTemporario = $_FILES['user_image']['tmp_name'];
            $tamanho = $_FILES['user_image']['size'];
            $erros = array();

            $tamanhoMaximo = 1024 * 1024 * 5; // 5MB
            if ($tamanho > $tamanhoMaximo) {
                $erros[] = "Seu arquivo excede o tamanho máximo<br>";
                return false;
            }

            $arquivosPermitidos = ["png", "jpg", "jpeg"];
            $extensao = pathinfo($nomeImagem, PATHINFO_EXTENSION);
            if (!in_array($extensao, $arquivosPermitidos)) {
                $erros[] = "Arquivo não permitido.<br>";
                return false;
            }

            $typesPermitidos = ["image/png", "image/jpg", "image/jpeg"];
            if (!in_array($tipo, $typesPermitidos)) {
                $erros[] = "Tipo de arquivo não permitido.<br>";
                return false;
            }

            if (!empty($erros)) {
                echo implode("", $erros);
            } else {
                preg_match("/\.(gif|bmp|png|jpg|jpeg)$/i", $nomeImagem, $ext);
                $nome_imagem = md5(uniqid(time())) . "." . $ext[1];
                $hoje = date("d-m-Y_h-i");
                $novoNome = $hoje . "-" . $nome_imagem;
                if (move_uploaded_file($nomeTemporario, $caminho . $novoNome)) {
                    return $novoNome;
                } else {
                    return false;
                }
            }
        }
    }
}
