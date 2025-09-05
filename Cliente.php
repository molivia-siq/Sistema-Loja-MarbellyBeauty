<?php

require_once(__DIR__ . "/../config/Conexao.php");

class Cliente {

    public static function adicionar($cpf, $nome, $telefone, $data_nasc, $genero, $logradouro, $numero, $bairro, $cidade, $cep, $pais) {

        try{

            $conexao = Conexao::getConexao();
            $stmt = $conexao -> prepare("INSERT INTO cliente(cpf, nome, telefone, data_nasc, genero, logradouro, numero, bairro, cidade, cep, pais) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt -> execute([$cpf, $nome, $telefone, $data_nasc, $genero, $logradouro, $numero, $bairro, $cidade, $cep, $pais]);

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
            $stmt = $conexao -> prepare("SELECT * FROM cliente");
            $stmt -> execute(); 

            return $stmt -> fetchAll();

        } catch (Exception $e) {

            echo $e -> getMessage();
            exit;

        }

    }

    public static function existe($cpf) {

        try{

            $conexao = Conexao::getConexao();
            $stmt = $conexao -> prepare("SELECT COUNT(*) FROM cliente WHERE cpf = ?");
            $stmt -> execute([$cpf]); 

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
    public static function podeDel($cpf){
        
        try{

            $conexao = Conexao::getConexao();
            $stmt = $conexao -> prepare("SELECT c.cpf FROM cliente c WHERE NOT EXISTS(SELECT * FROM pedido p, cliente c WHERE cpf = ? AND p.cpf_cliente=c.cpf)");
            $stmt -> execute([$cpf]); 

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

    public static function delete($cpf) {

        try{

            $conexao = Conexao::getConexao();
            $stmt = $conexao -> prepare("DELETE FROM cliente WHERE cpf = ?");
            $stmt -> execute([$cpf]); 

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

    public static function pegar($cpf) {

        try{

            $conexao = Conexao::getConexao();
            $stmt = $conexao -> prepare("SELECT * FROM cliente WHERE cpf = ?");
            $stmt -> execute([$cpf]); 

            return $stmt -> fetchAll()[0];

        } catch (Exception $e) {

            echo $e -> getMessage();
            exit;

        }

    }

    public static function atualizar($cpf, $nome, $telefone, $data_nasc, $genero, $logradouro, $numero, $bairro, $cidade, $cep, $pais) {

        try{

            $conexao = Conexao::getConexao();
            // $stmt = $conexao -> prepare("UPDATE cliente SET nome = :c1, telefone = :c2, data_nasc = :c3, genero = :c4, logradouro = :c5, numero = :c6, bairro = :c7, cidade = :c8, cep = :c9, pais = :c10 WHERE cpf = :c11");
            // $stmt -> execute([
            //     'c1' => $nome,
            //     'c2' => $telefone,
            //     'c3' => $data_nasc,
            //     'c4' => $genero,
            //     'c5' => $logradouro,
            //     'c6' => $numero,
            //     'c7' => $bairro,
            //     'c8' => $cidade,
            //     'c9' => $cep,
            //     'c10' => $pais,
            //     'c11' => $cpf
            // ]);
            $stmt=$conexao->prepare("UPDATE cliente SET nome=?, telefone=?, data_nasc=?, genero=?, logradouro=?, numero=?, bairro=?, cidade=?, cep=?, pais=? WHERE cpf=?");
            $stmt->execute([$nome, $telefone, $data_nasc, $genero, $logradouro, $numero, $bairro, $cidade, $cep, $pais, $cpf]);

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

    public static function numeroPedidos($cpf){
        try{
            $conexao=Conexao::getConexao();
            $stmt=$conexao->prepare("SELECT nome, count(id) FROM pedido JOIN cliente ON cpf_cliente=cpf WHERE cpf=?");
            $stmt->execute([$cpf]);
            
            return $stmt -> fetchAll();

        } catch (Exception $e) {

            echo $e -> getMessage();
            exit;

        }
    }

}