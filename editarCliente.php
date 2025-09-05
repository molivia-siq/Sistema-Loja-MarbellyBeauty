<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>marbelle beauty</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="imgs/MARBELLE.png" type="image/x-icon">
</head>
<body>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>

    <?php

            $msg = " ";

            require_once(__DIR__ . "/model/Cliente.php");
            require_once(__DIR__ . "/config/utils.php");

            if(isset($_GET["cpf"])) {

                if (Cliente::existe($_GET['cpf'])) {

                    $cliente = Cliente::pegar($_GET['cpf']);
                    // var_dump($cliente);

                } else {

                    $msg = "<div id='msg' class='alert alert-danger' role='alert'>";
                    $msg .= "Erro! Cliente não existe!";
                    $msg .= "</div";
                    die;

                }

            }else{

                $msg = "<div id='msg' class='alert alert-danger' role='alert'>";
                $msg .= "Erro! Cliente não existe!";
                $msg .= "</div";
                die;

            }

            if (isMetodo("POST")) {

                if (parametrosValidos($_POST, ["cpf", "nome", "telefone", "data_nasc", "genero", "logradouro", "numero", "bairro", "cidade", "cep", "pais"])) {
                    
                    if (Cliente::existe($_POST["cpf"])) {

                        $res = Cliente::atualizar($_POST["cpf"], $_POST["nome"], $_POST["telefone"], $_POST["data_nasc"], $_POST["genero"], $_POST["logradouro"], $_POST["numero"], $_POST["bairro"], $_POST["cidade"], $_POST["cep"], $_POST["pais"]);

                        if ($res) {

                            $msg = "<div id='msg' class='alert alert-success' role='alert'>";
                            $msg .= $_POST["nome"] . " atualizado com sucesso ツ";
                            $msg .= "</div";

                        } else {

                            $msg = "<div id='msg' class='alert alert-danger' role='alert'>";
                            $msg .= "Erro! Cliente não atualizado!";
                            $msg .= "</div";

                        }

                    } else {

                        $msg = "<div id='msg' class='alert alert-danger' role='alert'>";
                        $msg .= "CPF inválido! Não é possível editar!";
                        $msg .= "</div";

                    }

                }

            }

    ?>

    <header>
        <h1>
            <a href="index.php" class="f">marbelle</a>
        </h1>
    </header>

    <?php 

            echo $msg;

    ?>

    <main>  

        <h2>EDITAR CLIENTE</h2>

        <h3> Editar <?= $cliente["nome"] ?> </h3>

        <div class="div-formC">

            <form method="POST">

                <input type="hidden" name="cpf" value="<?= $cliente["cpf"] ?>">

                <p class="p-form">Digite seu nome:</p>
                <input type="text" name="nome" required="required" class="input-form" value="<?= $cliente["nome"] ?>">

                <p class="p-form">Digite seu telefone:</p>
                <input type="text" name="telefone" required="required" class="input-form"  maxlength="9" value="<?= $cliente["telefone"] ?>">

                <p class="p-form">Digite sua data de nascimento:</p>
                <input type="date" name="data_nasc" required="required" class="input-form" value="<?= $cliente["data_nasc"] ?>">

                <p class="p-form">Escolha seu gênero:</p>
                <select name="genero" class="input-form" required>
                    <option value=""></option>
                    <option value="Feminino" <?= ($cliente['genero'] == 'Feminino') ? 'selected' : '' ?>>Feminino</option>
                    <option value="Masculino"  <?= ($cliente['genero'] == 'Masculino') ? 'selected' : '' ?>>Masculino</option>
                </select>

                <u><p class="p-form">Endereco:</p></u>

                <p class="p-form">Digite seu logradouro:</p>
                <input type="text" name="logradouro" required="required" class="input-form" value="<?= $cliente['logradouro'] ?>">

                <p class="p-form">Digite seu numero:</p>
                <input type="number" name="numero" required="required" class="input-form" value="<?= $cliente['numero'] ?>">

                <p class="p-form">Digite seu bairro:</p>
                <input type="text" name="bairro" required="required" class="input-form" value="<?= $cliente['bairro'] ?>">

                <p class="p-form">Digite sua cidade:</p>
                <input type="text" name="cidade" required="required" class="input-form" value="<?= $cliente['cidade'] ?>">

                <p class="p-form">Digite seu CEP: </p>
                <input type="text" name="cep" required="required" maxlength="8" class="input-form" value="<?= $cliente['cep'] ?>">

                <p class="p-form">Digite seu pais:</p>
                <input type="text" name="pais" required="required" class="input-form" value="<?= $cliente['pais'] ?>">

                <div><button type="submit" class="bt-cad">Atualizar</button></div>

            </form>

        </div>

    </main>

    <!-- <script src="js/javascript.js"></script> -->

    <script>
        const myTimeout = setTimeout(
            remover,
            5000);


        function remover() {
            $('#msg').hide();
        }
    </script>

</body>
</html>