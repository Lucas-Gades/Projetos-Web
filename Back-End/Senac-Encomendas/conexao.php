<?php

class Conexao
{
    public static $conexao;

    public static function getConexao()
    {
        $stringConexao = "mysql:host=localhost;port=3306;dbname=senac_encomendas";
        $usuario = "root";
        $senha = "";

        if (!isset(self::$conexao)) {
            try {
                self::$conexao = new PDO($stringConexao, $usuario, $senha);
            } catch (PDOException $e) {

                $erro = $e->getCode();
                if ($erro == 1049) {
                    echo "Base de dados não encontrada.<br>";
                }
            }
        }

        return self::$conexao;
    }
}
