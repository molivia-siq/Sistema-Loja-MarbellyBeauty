<?php

require_once(__DIR__ . "/../config/Conexao.php");

class Pedido {

    public static function adicionar($data_entrega, $desconto, $cpf_cliente, $qntd_produto, $codigo_produto) {

        try{

            $conexao = Conexao::getConexao();
            $stmt = $conexao -> prepare("INSERT INTO pedido(data_entrega, desconto, cpf_cliente, data_hora_pedido, qntd_produto, codigo_produto) VALUES (?, ?, ?, now(), ?, ?)");
            $stmt -> execute([$data_entrega, $desconto, $cpf_cliente, $qntd_produto, $codigo_produto]);

            if ($stmt -> rowCount() > 0) {
                return true;
            } else {
                return false;
            }

        } catch (Exception $e) {

            echo $e -> getMessage();
            exit;

        }

    }

    public static function listar() {

        try{

            $conexao = Conexao::getConexao();
            $stmt = $conexao -> prepare("SELECT * FROM pedido");
            $stmt -> execute(); 

            return $stmt -> fetchAll();

        } catch (Exception $e) {

            echo $e -> getMessage();
            exit;

        }

    }

    public static function existe($id) {

        try{

            $conexao = Conexao::getConexao();
            $stmt = $conexao -> prepare("SELECT COUNT(*) FROM pedido WHERE id = ?");
            $stmt -> execute([$id]); 

            if ($stmt -> fetchColumn() > 0) {
                return true;
            } else {
                return false;
            }

        } catch (Exception $e) {

            echo $e -> getMessage();
            exit;

        }

    }

    public static function delete($id) {

        try{

            $conexao = Conexao::getConexao();
            $stmt = $conexao -> prepare("DELETE FROM pedido WHERE id = ?");
            $stmt -> execute([$id]); 

            if ($stmt -> rowCount() > 0) {
                return true;
            } else {
                return false;
            }

        } catch (Exception $e) {

            echo $e -> getMessage();
            exit;

        }

    }

    public static function pegar($id) {

        try{

            $conexao = Conexao::getConexao();
            $stmt = $conexao -> prepare("SELECT * FROM pedido WHERE id = ?");
            $stmt -> execute([$id]); 

            return $stmt -> fetchAll()[0];

        } catch (Exception $e) {

            echo $e -> getMessage();
            exit;

        }

    }

    public static function atualizar($id, $data_entrega, $desconto, $cpf_cliente, $qntd_produto, $codigo_produto) {

        try{

            $conexao = Conexao::getConexao();
            $stmt = $conexao -> prepare("UPDATE pedido SET data_entrega = :p2, desconto = :p3, cpf_cliente = :p4, qntd_produto = :p5, codigo_produto = :p6 WHERE id = :p7");
            $stmt -> execute([
                'p2' => $data_entrega,
                'p3' => $desconto,
                'p4' => $cpf_cliente,
                'p5' => $qntd_produto,
                'p6' => $codigo_produto,
                'p7' => $id
            ]);

            if ($stmt -> rowCount() > 0) {
                return true;
            } else {
                return false;
            }

        } catch (Exception $e) {

            echo $e -> getMessage();
            exit;

        }

    }

    public static function infoEntrega(){
        try{
            $conexao=Conexao::getConexao();
            $stmt=$conexao->prepare("SELECT p.id, p.data_entrega, c.cpf, c.nome, c.logradouro, c.numero, c.bairro, c.cidade, c.cep, c.pais FROM pedido p JOIN cliente c ON p.cpf_cliente=c.cpf ORDER BY p.data_entrega");
            $stmt->execute();

            return $stmt->fetchAll();

        } catch (Exception $e){

            echo $e -> getMessage();
            exit;

        }
    }

    public static function pedidosDia(){
        try{
            $conexao=Conexao::getConexao();
            $stmt=$conexao->prepare("SELECT date(data_hora_pedido) as data_pedido, count(id) FROM pedido GROUP BY data_pedido ORDER BY data_pedido");
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e){
            echo $e -> getMessage();
            exit;
        }
    }
}
