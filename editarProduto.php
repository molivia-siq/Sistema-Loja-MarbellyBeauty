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

            $msg = "";

            require_once(__DIR__ . "/config/utils.php");
            require_once(__DIR__ . "/model/Produto.php");

            if(isset($_GET['codigo'])) {

                if (Produto::existe($_GET['codigo'])) {

                    $produto = Produto::pegar($_GET['codigo']);
                    // var_dump($produto);

                } else {

                    $msg = "<div id='msg' class='alert alert-danger' role='alert'>";
                    $msg .= "Erro! Produto não existe!";
                    $msg .= "</div";
                    die;

                }

            }

            if (isMetodo('POST')) {

                if (parametrosValidos($_POST, ['codigo', 'nome_produto', 'tipo', 'valor', 'data_validade', 'peso_liquido', 'tonalidade', 'numero_estoque', 'marca', 'pigmentacao', 'tipo_embalagem'])) {

                    if (Produto::existe($_POST['codigo'])) {

                        $res = Produto::atualizar($_POST['codigo'], $_POST['nome_produto'], $_POST['tipo'], $_POST['valor'], $_POST['data_validade'], $_POST['peso_liquido'], $_POST['tonalidade'], $_POST['numero_estoque'], $_POST['marca'], $_POST['pigmentacao'], $_POST['tipo_embalagem']);

                        if ($res) {

                            $msg = "<div id='msg' class='alert alert-success' role='alert'>";
                            $msg .= $_POST['nome_produto'] . " atualizado com sucesso ツ";
                            $msg .= "</div";

                        } else {

                            $msg = "<div id='msg' class='alert alert-danger' role='alert'>";
                            $msg .= "Erro! Produto não atualizado!";
                            $msg .= "</div";

                        }

                    } else {

                        $msg = "<div id='msg' class='alert alert-danger' role='alert'>";
                        $msg .= "Código inválido! Não é possível editar!";
                        $msg .= "</div";

                    }

                }

            }

            $lista_produto = Produto::listar();

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

        <h2>EDITAR PRODUTO</h2>

        <h3> Editar <?= $produto['nome_produto'] ?> </h3>

        <div class="div-formC">

            <form method="POST">

                <input type="hidden" name="codigo" value="<?= $produto['codigo'] ?>">

                <p class="p-form">Digite o nome do produto:</p>
                <input type="text" name="nome_produto" required="required" class="input-form" value="<?= $produto['nome_produto'] ?>">

                <p class="p-form">Selecione o tipo:</p>
                <select name="tipo" required class="input-form">
                    <option value="" selected="selected"></option>
                    <?php 
                        $lista_tipo=["Sombra", "Batom", "Corretivo", "Rímel", "Base", "Deliniador", "Blush", "Contorno", "Iluminador"];
                        foreach($lista_tipo as $t){
                            $selected = ($t == $produto['tipo']) ? 'selected' : '';
                            echo "<option value='$t' $selected>$t</option>";
                        }
                    ?>
                </select>
    
                <p class="p-form">Digite o valor:</p>
                <input type="number" name="valor" required="required" class="input-form" value="<?= $produto['valor'] ?>">

                <p class="p-form">Digite a data de validade:</p>
                <input type="date" name="data_validade" required="required" class="input-form" value="<?= $produto['data_validade'] ?>">

                <p class="p-form">Digite o peso líquido (em gramas):</p>
                <input type="number" name="peso_liquido" required="required" class="input-form" value="<?= $produto['peso_liquido'] ?>">

                <p class="p-form">Selecione a tonalidade:</p>
                <select name="tonalidade" required class="input-form">
                    <option value="" selected="selected"></option>
                    <?php 
                        $lista_tonalidade=["Claro", "Médio", "Escuro"];
                        foreach($lista_tonalidade as $tn){
                            $selected = ($tn == $produto['tonalidade']) ? 'selected' : '';
                            echo "<option value='$tn' $selected>$tn</option>";
                        }
                    ?>
                </select>
                

                <p class="p-form">Digite a quantidade no estoque:</p>
                <input type="number" name="numero_estoque" required="required" class="input-form" value="<?= $produto['numero_estoque'] ?>">

                <p class="p-form">Selecione a marca: </p>
                <select name="marca" required class="input-form">
                    <option value="" selected="selected"></option>
                    <?php 
                        $lista_marca=["Fenty Beauty", "Makeup by Mario", "Too Faced", "Rare Beauty", "Huda Beauty", "Dior", "MAC", "Channel"];
                        foreach($lista_marca as $m){
                            $selected = ($m == $produto['marca']) ? 'selected' : '';
                            echo "<option value='$m' $selected>$m</option>";
                        }
                    ?>
                </select>

                <p class="p-form">Selecione a pigmentação:</p>
                <select name="pigmentacao" required class="input-form">
                    <option value="" selected="selected"></option>
                    <?php 
                        $lista_pigmentacao=["Baixa", "Média", "Alta"];
                        foreach($lista_pigmentacao as $p){
                            $selected = ($p == $produto['pigmentacao']) ? 'selected' : '';
                            echo "<option value='$p' $selected>$p</option>";
                        }
                    ?>
                </select>

                <p class="p-form">Selecione o tipo de embalagem:</p>
                <select name="tipo_embalagem" required class="input-form">
                    <option value="" selected="selected"></option>
                    <?php 
                        $lista_tipo_embalagem=["Plástico", "Vidro", "Acrílico"];
                        foreach($lista_tipo_embalagem as $te){
                            $selected = ($te == $produto['tipo_embalagem']) ? 'selected' : '';
                            echo "<option value='$te' $selected>$te</option>";
                        }
                    ?>
                </select>
                

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