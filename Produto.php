<?php

require_once(__DIR__ . "/../config/Conexao.php");

class Produto {

    public static function adicionar($codigo, $nome_produto, $tipo, $valor, $data_validade, $peso_liquido, $tonalidade, $numero_estoque, $marca, $pigmentacao, $tipo_embalagem) {

        try {

            $conexao = Conexao::getConexao();
            $stmt = $conexao -> prepare("INSERT INTO produto(codigo, nome_produto, tipo, valor, data_validade, peso_liquido, tonalidade, numero_estoque, marca, pigmentacao, tipo_embalagem) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt -> execute([$codigo, $nome_produto, $tipo, $valor, $data_validade, $peso_liquido, $tonalidade, $numero_estoque, $marca, $pigmentacao, $tipo_embalagem]);

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
            $stmt = $conexao -> prepare("SELECT * FROM produto");
            $stmt -> execute(); 

            return $stmt -> fetchAll();

        } catch (Exception $e) {

            echo $e -> getMessage();
            exit;

        }

    }

    public static function existe($codigo) {

        try{

            $conexao = Conexao::getConexao();
            $stmt = $conexao -> prepare("SELECT COUNT(*) FROM produto WHERE codigo = ?");
            $stmt -> execute([$codigo]); 

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

    public static function existeNome($nome_produto) {

        try{

            $conexao = Conexao::getConexao();
            $stmt = $conexao -> prepare("SELECT COUNT(*) FROM produto WHERE nome_produto = ?");
            $stmt -> execute([$nome_produto]); 

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

    public static function podeDel($codigo){
        
        try{

            $conexao = Conexao::getConexao();
            $stmt = $conexao -> prepare("SELECT p.codigo FROM produto p WHERE NOT EXISTS(SELECT * FROM pedido pe, produto p WHERE codigo = ? AND pe.codigo_produto=p.codigo)");
            $stmt -> execute([$codigo]); 

            if ($stmt->rowCount() === 0) {
                return false;
            } else {
                return true; 
            }

        } catch (Exception $e) {

            echo $e -> getMessage();
            exit;

        }
    }

    public static function delete($codigo) {

        try{

            $conexao = Conexao::getConexao();
            $stmt = $conexao -> prepare("DELETE FROM produto WHERE codigo = ?");
            $stmt -> execute([$codigo]); 

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

    public static function pegar($codigo) {

        try{

            $conexao = Conexao::getConexao();
            $stmt = $conexao -> prepare("SELECT * FROM produto WHERE codigo = ?");
            $stmt -> execute([$codigo]); 

            return $stmt -> fetchAll()[0];

        } catch (Exception $e) {

            echo $e -> getMessage();
            exit;

        }

    }

    public static function atualizar($codigo, $nome_produto, $tipo, $valor, $data_validade, $peso_liquido, $tonalidade, $numero_estoque, $marca, $pigmentacao, $tipo_embalagem) {

        try{

            $conexao = Conexao::getConexao();
            $stmt = $conexao -> prepare("UPDATE produto SET nome_produto = :p1, tipo = :p2, valor = :p3, data_validade = :p4, peso_liquido = :p5, tonalidade = :p6, numero_estoque = :p7, marca = :p8, pigmentacao = :p9, tipo_embalagem = :p10 WHERE codigo = :p11");
            $stmt -> execute([
                'p1' => $nome_produto,
                'p2' => $tipo,
                'p3' => $valor,
                'p4' => $data_validade,
                'p5' => $peso_liquido,
                'p6' => $tonalidade,
                'p7' => $numero_estoque,
                'p8' => $marca,
                'p9' => $pigmentacao,
                'p10' => $tipo_embalagem,
                'p11' => $codigo
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

    // selects:

    public static function numeroPedidos($codigo){
        try{
            $conexao=Conexao::getConexao();
            $stmt=$conexao->prepare("SELECT nome_produto, count(id) FROM pedido JOIN produto ON codigo_produto=codigo WHERE codigo=?");
            $stmt->execute([$codigo]);
            
            return $stmt -> fetchAll();

        } catch (Exception $e) {

            echo $e -> getMessage();
            exit;

        }
    }

}