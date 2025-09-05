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

            require_once(__DIR__ . "/model/Pedido.php");
            require_once(__DIR__ . "/config/utils.php");

            if(isset($_GET["id"])) {

                if (Pedido::existe($_GET['id'])) {

                    $pedido = Pedido::pegar($_GET['id']);
                    // var_dump($pedido);

                } else {

                    $msg = "<div id='msg' class='alert alert-danger' role='alert'>";
                    $msg .= "Erro! Produto não existe!";
                    $msg .= "</div";
                    die;

                }

            }else{

                $msg = "<div id='msg' class='alert alert-danger' role='alert'>";
                $msg .= "Erro! Produto não existe!";
                $msg .= "</div";
                die;

            }

            if (isMetodo("POST")) {

                if (parametrosValidos($_POST, ['id', 'data_entrega', 'desconto', 'cpf_cliente', 'qntd_produto', 'codigo_produto'])) {
                    
                    if (Pedido::existe($_POST["id"])) {

                        $res = Pedido::atualizar($_POST["id"], $_POST["data_entrega"], $_POST["desconto"], $_POST["cpf_cliente"], $_POST["qntd_produto"], $_POST["codigo_produto"]);

                        if ($res) {

                            $msg = "<div id='msg' class='alert alert-success' role='alert'>";
                            $msg .= "Pedido " . $_POST['id'] . " atualizado com sucesso ツ";
                            $msg .= "</div";

                        } else {

                            $msg = "<div id='msg' class='alert alert-danger' role='alert'>";
                            $msg .= "Erro! Pedido não atualizado!";
                            $msg .= "</div";

                        }

                    } else {

                        $msg = "<div id='msg' class='alert alert-danger' role='alert'>";
                        $msg .= "ID inválido! Não é possível editar!";
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

        <h2>EDITAR PEDIDO</h2>

        <h3> Editar pedido <?= $pedido["id"] ?> </h3>

        <div class="div-formC">

            <form method="POST">

                <input type="hidden" name="id" value="<?= $pedido["id"] ?>">

                <p class="p-form">Selecione a data de entrega:</p>
                <input type="date" name="data_entrega" required="required" class="input-form" value="<?= $pedido["data_entrega"] ?>">

                <p class="p-form">Digite o desconto:</p>
                <input type="number" name="desconto" required="required" class="input-form" value="<?= $pedido["desconto"] ?>">

                <p class="p-form">Digite o CPF do cliente:</p>
                <input type="text" name="cpf_cliente" required="required" maxlength="11" class="input-form" value="<?= $pedido['cpf_cliente'] ?>">

                <p class="p-form">Digite a quantidade de produtos:</p>
                <input type="number" name="qntd_produto" required="required" class="input-form" value="<?= $pedido['qntd_produto'] ?>">

                <p class="p-form">Digite o código de barras do produto:</p>
                <input type="text" name="codigo_produto" required="required" maxlength="12" class="input-form" value="<?= $pedido['codigo_produto'] ?>">

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