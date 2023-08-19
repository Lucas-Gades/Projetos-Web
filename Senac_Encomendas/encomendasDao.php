<?php

class EncomendaDAO
{
    private $conexao;

    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }

    public function listarEncomendas()
    {
        $sql = "SELECT * FROM encomendas";
        $resultado = $this->conexao->query($sql);
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarEncomenda($id)
    {
        $sql = "SELECT * FROM encomendas WHERE id = :id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function inserirEncomenda($numero_pedido, $nome_cliente, $status)
    {
        try {
            $numero_pedido = 'SEN-' . $numero_pedido . '-BR';

            $stmt = $this->conexao->prepare("INSERT INTO encomendas (numero_pedido, nome_cliente, status) VALUES (:numero_pedido, :nome_cliente, :status)");
            $stmt->bindParam(':numero_pedido', $numero_pedido);
            $stmt->bindParam(':nome_cliente', $nome_cliente);
            $stmt->bindParam(':status', $status);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao inserir encomenda: " . $e->getMessage();
        }
    }


    public function excluirEncomenda($id)
    {
        $sql = "DELETE FROM encomendas WHERE id = :id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function alterarEncomenda($id, $numero_pedido, $nome_cliente, $status)
    {
        try {
            $numero_pedido = 'SEN-' . $numero_pedido . '-BR';
            $stmt = $this->conexao->prepare("UPDATE encomendas SET numero_pedido = :numero_pedido, nome_cliente = :nome_cliente, status = :status WHERE id = :id");
            $stmt->bindParam(':numero_pedido', $numero_pedido);
            $stmt->bindParam(':nome_cliente', $nome_cliente);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao alterar encomenda: " . $e->getMessage();
        }
    }

    public function verificarEncomendaExistente($numero_pedido)
    {
        try {
            $stmt = $this->conexao->prepare("SELECT * FROM encomendas WHERE numero_pedido = :numero_pedido");
            $stmt->bindParam(':numero_pedido', $numero_pedido);
            $stmt->execute();
            $encomenda = $stmt->fetch(PDO::FETCH_ASSOC);

            return $encomenda !== false;
        } catch (PDOException $e) {
            echo "Erro ao verificar encomenda existente: " . $e->getMessage();
            return false;
        }
    }

    public function buscarEncomendaPorNumero($numeroPedido)
    {
        $sql = "SELECT * FROM encomendas WHERE numero_pedido = :numero_pedido";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':numero_pedido', $numeroPedido);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
