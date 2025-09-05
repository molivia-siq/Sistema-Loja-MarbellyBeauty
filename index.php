<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>marbelle beauty</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="imgs/MARBELLE.png" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>

    <!-- 
        O website PHP a ser desenvolvido deverá possibilitar realizar as operações CRUD sobre as entidades do sistema. Além dessas operações básicas, é necessário que outras operações sejam adicionadas como forma de exemplificar a utilização correta do banco de dados, como por exemplo:

            "Liste a raça e o número de animais de cada raça".
            "Liste os donos e o número de animais que possuem em ordem decrescente".
            "Liste o animal mais velho cadastrado".
            "Liste o animal que foi cadastrado mais recentemente".
            Entre outras...
        
        Nossas operações:

            "Liste ..."
     -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>

    <?php

        // CLIENTE - INICIO

        $msg = ' ';

        require_once(__DIR__ . '/config/utils.php');
        require_once(__DIR__ . '/model/Cliente.php');
        require_once(__DIR__ . '/model/Produto.php');
        require_once(__DIR__ . '/model/Pedido.php');

        if (isMetodo('POST')) {

            if (parametrosValidos($_POST, ['cpf', 'nome', 'telefone', 'data_nasc', 'genero', 'logradouro', 'numero', 'bairro', 'cidade', 'cep', 'pais'])) {

                // Eu posso adicionar esse cara?

                if(Cliente::existe($_POST["cpf"])) {

                    $msg= "<div id='msg' class='alert alert-success' role='alert'>";
                    $msg .= "CPF " . $_POST['cpf'] . " já existente! Não é possível cadastrar!";
                    $msg .= "</div";

                } else {

                    $res = Cliente::adicionar($_POST["cpf"], $_POST["nome"], $_POST["telefone"], $_POST["data_nasc"], $_POST["genero"], $_POST["logradouro"], $_POST["numero"], $_POST["bairro"], $_POST["cidade"], $_POST["cep"], $_POST["pais"]);

                    if ($res) {

                        $msg= "<div id='msg' class='alert alert-success' role='alert'>";
                        $msg .= $_POST['nome'] . " adicionado com sucesso ツ";
                        $msg .= "</div";

                    } else {

                        $msg= "<div id='msg' class='alert alert-danger' role='alert'>";
                        $msg .= "Erro! Cliente não adicionado!";
                        $msg .= "</div";
                    }

                }

            }

        }

        // DELETAR TUDO

        if (isMetodo('GET')) {

            if (parametrosValidos($_GET, ['op', 'pk'])) {

                $op = $_GET['op'];

                switch ($op) {

                    case 'delCliente':

                        if (Cliente::existe($_GET['pk'])){
                        
                            $pode=Cliente::podeDel($_GET['pk']);

                            if ($pode) {

                                $res = Cliente::delete($_GET['pk']);
                            } else{

                                $res=false;
                            }
                        
                            if ($res) {

                                $msg = "<div id='msg' class='alert alert-success' role='alert'>";
                                $msg .= "Cliente deletado com sucesso ツ";
                                $msg .= "</div";

                            } else {
                                $msg = "<div id='msg' class='alert alert-danger' role='alert'>";
                                $msg .= "Erro! Cliente não deletado!";
                                $msg .= "</div";

                            }

                            break;
                        }

                    case 'delProduto':

                        if (Produto::existe($_GET['pk'])) {
                            
                            $pode=Produto::podeDel($_GET['pk']);

                            if ($pode) {

                                $res = Produto::delete($_GET['pk']);
                            } else{

                                $res=false;
                            }
    
                            if ($res) {
    
                                $msg = "<div id='msg' class='alert alert-success' role='alert'>";
                                $msg .= "Produto deletado com sucesso ツ";
                                $msg .= "</div";
    
                            } else {
                                $msg = "<div id='msg' class='alert alert-danger' role='alert'>";
                                $msg .= "Erro! Produto não deletado!";
                                $msg .= "</div";
                            }
    
                            break;
                        }

                    case 'delPedido':

                        if (Pedido::existe($_GET['pk'])) {
                            $res = Pedido::delete($_GET['pk']);

                            if ($res) {

                                $msg = "<div id='msg' class='alert alert-success' role='alert'>";
                                $msg .= "Pedido deletado com sucesso ツ";
                                $msg .= "</div";

                            } else {
                                $msg = "<div id='msg' class='alert alert-danger' role='alert'>";
                                $msg .= "Erro! Pedido não deletado!";
                                $msg .= "</div";
                            }

                            break;
                        }

                }

            }

        }

        // CLIENTE - FIM

        // DELETE - FIM

        // PRODUTO - INICIO

        if (isMetodo('POST')) {

            if (parametrosValidos($_POST, ['codigo', 'nome_produto', 'tipo', 'valor', 'data_validade', 'peso_liquido', 'tonalidade', 'numero_estoque', 'marca', 'pigmentacao', 'tipo_embalagem'])) {

                // posso adicionar esse produto?

                if (Produto::existe($_POST['codigo'])) {

                    $msg= "<div id='msg' class='alert alert-success' role='alert'>";
                    $msg .= "Código " . $_POST['codigo'] . " já existente! Não é possível cadastrar!";
                    $msg .= "</div";

                } else if (Produto::existeNome($_POST['nome_produto'])){

                    $msg= "<div id='msg' class='alert alert-success' role='alert'>";
                    $msg .= "Produto " . $_POST['nome_produto'] . " já existente! Não é possível cadastrar!";
                    $msg .= "</div";

                } else {

                    $res = Produto::adicionar($_POST['codigo'], $_POST['nome_produto'], $_POST['tipo'], $_POST['valor'], $_POST['data_validade'], $_POST['peso_liquido'], $_POST['tonalidade'], $_POST['numero_estoque'], $_POST['marca'], $_POST['pigmentacao'], $_POST['tipo_embalagem']);

                    if ($res) {

                        $msg= "<div id='msg' class='alert alert-success' role='alert'>";
                        $msg .= $_POST['nome_produto'] . " adicionado com sucesso ツ";
                        $msg .= "</div";

                    } else {

                        $msg= "<div id='msg' class='alert alert-danger' role='alert'>";
                        $msg .= "Erro! Produto não adicionado!";
                        $msg .= "</div";

                    }

                }

            }

        }

        // PRODUTO - FIM

        // PEDIDO - INICIO

        if (isMetodo('POST')) {


            if (parametrosValidos($_POST, ['data_entrega', 'desconto', 'cpf_cliente', 'qntd_produto', 'codigo_produto'])) {

                // Posso adicionar esse pedido?

                    $res = Pedido::adicionar($_POST['data_entrega'], $_POST['desconto'], $_POST['cpf_cliente'], $_POST['qntd_produto'], $_POST['codigo_produto']);

                    if ($res) {

                        $msg= "<div id='msg' class='alert alert-success' role='alert'>";
                        $msg .= "Pedido adicionado com sucesso ツ";
                        $msg .= "</div";

                    } else {

                        $msg= "<div id='msg' class='alert alert-danger' role='alert'>";
                        $msg .= "Erro! Pedido não adicionado!";
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

    <nav>

        <ul class="nav justify-content-center">

            <li class="nav-item">
                <a id="btCliente" class="an nav-link active" aria-current="page" href="#">CLIENTE</a>
            </li>
            <li class="nav-item">
                <a id="btProdutoMaquiagem" class="an nav-link" href="#">PRODUTO DE MAQUIAGEM</a>
            </li>
            <li class="nav-item">
                <a id="btPedido" class="an nav-link" href="index.php#espDesenvolvimentoPedido">PEDIDO</a>
            </li>

        </ul>

    </nav>

    <main>

        <?php 

            echo $msg;

        ?>

        <div class="carousel slide" data-bs-ride="carousel">

            <div class="carousel-inner" interval="3000" pause="false">

                <div class="carousel-item active">
                    <img src="https://r.lvmh-static.com/uploads/2017/09/21427257_1616245731759377_453079733919700565_o-1584x872.png" class="d-block w-100" alt="Imagem Produto" height="500px">
                </div>
                <div class="carousel-item ">
                    <img src="https://api.soimilk.com/genThumb.php?file=sites/default/files/pjimage_3_1.jpg&maxw=1200&maxh=1200" class="d-block w-100" alt="Imagem Produto" height="500px">
                </div>
                <div class="carousel-item">
                    <img src="https://static-cdn.giftano.com/fls/merchants/merchant-profile-picture-fenty-beauty-1.png" class="d-block w-100" alt="Imagem Produto" height="500px">
                </div>

            </div>

        </div>

        <h2 class="d">REGISTROS</h2>

        <h2>CLIENTES</h2>

        <table border="1">

            <thead>
                <tr>
                    <th>CPF</th>
                    <th>NOME</th>
                    <th>TELEFONE</th>
                    <th>DATA NASCIMENTO</th>
                    <th>GENERO</th>
                    <th>ENDERECO</th>
                    <th>OPCOES</th>
                </tr>
            </thead>

            <tbody>
            <?php

                $lista_cliente = Cliente::listar();
                // print_r ($lista_cliente);

                foreach ($lista_cliente as $c) {
                    echo '<tr>';
                    echo '<td>' . $c['cpf'] . '</td>';
                    echo '<td>' . $c['nome'] . '</td>';
                    echo '<td>' . $c['telefone'] . '</td>';
                    echo '<td>' . $c['data_nasc'] . '</td>';
                    echo '<td>' . $c['genero'] . '</td>';
                    echo '<td>';
                    echo '<table>';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th> LOGRADOURO </th>';
                    echo '<th> NUMERO </th>';
                    echo '<th> BAIRRO </th>';
                    echo '<th> CIDADE </th>';
                    echo '<th> CEP </th>';
                    echo '<th> PAIS </th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    echo '<tr>';
                    echo '<td>' . $c['logradouro'] . '</td>'; 
                    echo '<td>' . $c['numero'] . '</td>';
                    echo '<td>' . $c['bairro'] . '</td>';
                    echo '<td>' . $c['cidade'] . '</td>';
                    echo '<td>' . $c['cep'] . '</td>';
                    echo '<td>' . $c['pais'] . '</td>';
                    echo '</tr>';
                    echo '</tbody>';
                    echo '</table>';
                    echo '</td>';
                    echo '<td>';
                    echo '<a class="bt-op" href="editarCliente.php?cpf=' . $c['cpf'] . '"">Editar</a>';
                    echo '<br>';
                    echo '<a class="bt-op" href="index.php?op=delCliente&pk=' . $c['cpf'] . '">Deletar</a>';
                    echo '</td>';
                    echo '</tr>';
                }

            ?>
            </tbody>

        </table>

        <h2>PRODUTOS</h2>

        <table border="1">

            <thead>
                <tr>
                    <th>CODIGO</th>
                    <th>NOME</th>
                    <th>TIPO</th>
                    <th>VALOR</th>
                    <th>DATA DE VALIDADE</th>
                    <th>PESO LiQUIDO</th>
                    <th>TONALIDADE</th>
                    <th>QUANTIDADE NO ESTOQUE</th>
                    <th>MARCA</th>
                    <th>PIGMENTACAO</th>
                    <th>TIPO DE EMBALAGEM</th>
                    <th>OPCOES</th>
                </tr>
            </thead>

            <tbody>
            <?php
            $lista_produto = Produto::listar();
            // print_r($lista_produto);
            foreach ($lista_produto as $p) {
                echo '<tr>';
                echo '<td>' . $p['codigo'] . '</td>';
                echo '<td>' . $p['nome_produto'] . '</td>';
                echo '<td>' . $p['tipo'] . '</td>';
                echo '<td>' . $p['valor'] . '</td>';
                echo '<td>' . $p['data_validade'] . '</td>';
                echo '<td>' . $p['peso_liquido'] . '</td>';
                echo '<td>' . $p['tonalidade'] . '</td>';
                echo '<td>' . $p['numero_estoque'] . '</td>';
                echo '<td>' . $p['marca'] . '</td>';
                echo '<td>' . $p['pigmentacao'] . '</td>';
                echo '<td>' . $p['tipo_embalagem'] . '</td>';
                echo '<td>';
                echo '<a class="bt-op" href="editarProduto.php?codigo=' . $p['codigo'] . '"">Editar</a>';
                echo '<br>';
                echo '<a class="bt-op" href="index.php?op=delProduto&pk=' . $p['codigo'] . '"">Deletar</a>';
                echo '</td>';
                echo '</tr>';
            }
            ?>
            </tbody>

        </table>

        <h2>PEDIDOS</h2>

        <table border="1">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>DATA ENTREGA</th>
                    <th>DESCONTO</th>
                    <th>CPF DO CLIENTE</th>
                    <th>DATA DO PEDIDO</th>
                    <th>HORARIO DO PEDIDO</th>
                    <th>QUANTIDADE DE PRODUTOS</th>
                    <th>CODIGO DO PRODUTO</th>
                </tr>
            </thead>

            <tbody>
            <?php
            $lista_pedido = Pedido::listar();
            foreach ($lista_pedido as $p) {
                list($data_pedido, $hora_pedido) = explode(" ", $p['data_hora_pedido']);
                echo '<tr>';
                echo '<td>' . $p['id'] . '</td>';
                echo '<td>' . $p['data_entrega'] . '</td>';
                echo '<td>' . $p['desconto'] . '</td>';
                echo '<td>' . $p['cpf_cliente'] . '</td>';
                echo '<td>' . $data_pedido . '</td>';
                echo '<td>' . $hora_pedido . '</td>';
                echo '<td>' . $p['qntd_produto'] . '</td>';
                echo '<td>' . $p['codigo_produto'] . '</td>';
                echo '<td>';
                echo '<a class="bt-op" href="editarPedido.php?id=' . $p['id'] . '"">Editar</a>';
                echo '<br>';
                echo '<a class="bt-op" href="index.php?op=delPedido&pk=' . $p['id'] . '"">Deletar</a>';
                echo '</td>';
                echo '</tr>';
            }
            ?>
            </tbody>

        </table>

        <h2 class="d">DADOS</h2>

        <h2>PEDIDOS POR PRODUTO</h2>

        <table border="1">

            <thead>
                <tr>
                    <th>NOME DO PRODUTO</th>
                    <th>CODIGO DO PRODUTO</th>
                    <th>NUMERO DE PEDIDOS</th>
                </tr>
            </thead>

            <tbody>
            <?php
            $lista_produto = Produto::listar();
            // print_r($lista_produto);
            foreach ($lista_produto as $p) {

                $numero_pedidos=Produto::numeroPedidos($p['codigo']);

                echo '<tr>';
                echo '<td>' . $p['nome_produto'] . '</td>';
                echo '<td>' . $p['codigo'] . '</td>';
                echo '<td>' . $numero_pedidos[0]['count(id)'] . '</td>';
                echo '</tr>';
            }
            ?>
            </tbody>

        </table>

        <h2>PEDIDOS POR CLIENTE</h2>

        <table border="1">

            <thead>
                <tr>
                    <th>NOME DO CLIENTE</th>
                    <th>CPF DO CLIENTE</th>
                    <th>NUMERO DE PEDIDOS</th>
                </tr>
            </thead>

            <tbody>
            <?php
            $lista_cliente = Cliente::listar();
            // print_r($lista_produto);
            foreach ($lista_cliente as $c) {

                $numero_pedidos=Cliente::numeroPedidos($c['cpf']);

                echo '<tr>';
                echo '<td>' . $c['nome'] . '</td>';
                echo '<td>' . $c['cpf'] . '</td>';
                echo '<td>' . $numero_pedidos[0]['count(id)'] . '</td>';
                echo '</tr>';
            }
            ?>
            </tbody>

        </table>
        
        <h2>INFO ENTREGAS</h2>

        <table border="1">

            <thead>
                <tr>
                    <th>ID DO PEDIDO</th>
                    <th>DATA ENTREGA</th>
                    <th>CPF DO CLIENTE</th>
                    <th>NOME DO CLIENTE</th>
                    <th>ENDERECO</th>
                </tr>
            </thead>

            <tbody>
            <?php
            $infoEntrega=Pedido::infoEntrega();

            foreach ($infoEntrega as $i) {

                echo '<tr>';
                echo '<td>'.$i['id'].'</td>';
                echo '<td>'.$i['data_entrega'].'</td>';
                echo '<td>'.$i['cpf'].'</td>';
                echo '<td>'.$i['nome'].'</td>';
                echo '<td>';
                echo '<table>';
                echo '<thead>';
                echo '<tr>';
                echo '<th> LOGRADOURO </th>';
                echo '<th> NUMERO </th>';
                echo '<th> BAIRRO </th>';
                echo '<th> CIDADE </th>';
                echo '<th> CEP </th>';
                echo '<th> PAIS </th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                echo '<tr>';
                echo '<td>' . $i['logradouro'] . '</td>'; 
                echo '<td>' . $i['numero'] . '</td>';
                echo '<td>' . $i['bairro'] . '</td>';
                echo '<td>' . $i['cidade'] . '</td>';
                echo '<td>' . $i['cep'] . '</td>';
                echo '<td>' . $i['pais'] . '</td>';
                echo '</tr>';
                echo '</tbody>';
                echo '</table>';
                echo '</td>';
            }
             
            ?>
            </tbody>

        </table>

        <h2>PEDIDOS POR DIA</h2>

        <table border="1">

            <thead>
                <tr>
                    <th>DATA</th>
                    <th>NUMERO DE PEDIDOS</th>
                </tr>
            </thead>

            <tbody>
            <?php
            $pedidos_dia = Pedido::pedidosDia();

            foreach ($pedidos_dia as $pd) {

                echo '<tr>';
                echo '<td>' . $pd['data_pedido'] . '</td>';
                echo '<td>' . $pd['count(id)'] . '</td>';
                echo '</tr>';
            }
            ?>
            </tbody>

        </table>

        <h2 class="d">CADASTRO</h2>

        <div id="espDesenvolvimentoPedido">

            <h2>CADASTRAR PEDIDO</h2>

            <div class="div-formC">

                <form method="POST">

                    <p class="p-form">Selecione a data de entrega:</p>
                    <input type="date" name="data_entrega" class="input-form" required>

                    <p class="p-form">Digite o desconto (%):</p>
                    <input type="number" name="desconto" class="input-form" required>

                    <p class="p-form">Selecione o cliente:</p>
                    <select name="cpf_cliente" class="input-form" required>
                        <option value=""></option>
                        <?php
                        $lista_cliente = Cliente::listar();
                        foreach($lista_cliente as $c){
                            $cpf = $c['cpf'];
                            $nome = $c['nome'];
                            echo "<option value='$cpf'>$nome</option>";
                        }
                        ?>
                    </select>

                    <p class="p-form">Digite a quantidade do produto:</p>
                    <input type="number" name="qntd_produto" class="input-form" required>

                    <p class="p-form">Selecione o produto:</p>
                    <select name="codigo_produto" class="input-form" required>
                        <option value=""></option>
                        <?php
                        $lista_produto = Produto::listar();
                        foreach($lista_produto as $p){
                            $codigo = $p['codigo'];
                            $nome = $p['nome_produto'];
                            echo "<option value='$codigo'>$nome</option>";
                        }
                        ?>
                    </select>

                    <div>
                        <button type="submit" class="bt-cad">cadastrar</button>
                    </div>

                </form>

            </div>

        </div>

    </main>

    <footer>

        <div class="img-footer"><img src="imgs/MARBELLE.png" alt="Logo" height="200px"></div>
        <p class="txt-footer">marbelle beauty</p>
        <p class="txt2-footer">Maria Olívia Meca e Isabelly Galli</p>

    </footer>

    <script src="js/javascript.js"></script>
    
</body>
</html>