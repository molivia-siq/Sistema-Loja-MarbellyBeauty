
var btCliente = document.querySelector('#btCliente');
var btProdutoMaquigem = document.querySelector('#btProdutoMaquiagem');
var btPedido = document.querySelector('#btPedido');

btCliente.addEventListener('click', espDesenvolvimentoCliente);

btProdutoMaquigem.addEventListener('click', espDesenvolvimentoProduto);

// btPedido.addEventListener('click', espDesenvolvimentoPedido);

function limparMain(main) {
    main.innerHTML = '';
}

function espDesenvolvimentoCliente() {
    // console.log('ola c');

    var main = document.querySelector('main');
    limparMain(main);

    let h2 = document.createElement('h2');
    let txt = document.createTextNode('CADASTRAR CLIENTE');
    h2.append(txt);
    main.append(h2);

    // <form method="POST">

    //     <h2>cadastrar Pessoa:</h2>

    //     <p>digite seu nome:</p>
    //     <input type="text" name="nome" required>

    //     <p>digite sua data de nascimento:</p>
    //     <input type="date" name="dataNasc" required>

    //     <br> <br>

    //     <button>cadastrar</button>

    // </form>

    let form = document.createElement('form');
    form.setAttribute('method', 'POST');

    let divForm = document.createElement('div');
    divForm.setAttribute('class', 'div-formC');

    let p = document.createElement('p');
    p.setAttribute('class', 'p-form');
    p.innerText = 'Digite o CPF:';
    let input = document.createElement('input');
    input.setAttribute('type', 'text');
    input.setAttribute('name', 'cpf');
    input.setAttribute('required', 'required');
    input.setAttribute('maxlength', '11');
    input.setAttribute('class', 'input-form');

    form.append(p);
    form.append(input);
    divForm.append(form);

    p = document.createElement('p');
    p.setAttribute('class', 'p-form');
    p.innerText = 'Digite o nome:';
    input = document.createElement('input');
    input.setAttribute('type', 'text');
    input.setAttribute('name', 'nome');
    input.setAttribute('required', 'required');
    input.setAttribute('class', 'input-form');

    form.append(p);
    form.append(input);
    divForm.append(form);

    p = document.createElement('p');
    p.setAttribute('class', 'p-form');
    p.innerText = 'Digite o telefone:';
    input = document.createElement('input');
    input.setAttribute('type', 'text');
    input.setAttribute('name', 'telefone');
    input.setAttribute('required', 'required');
    input.setAttribute('maxlength', '9');
    input.setAttribute('class', 'input-form');

    form.append(p);
    form.append(input);
    divForm.append(form);

    p = document.createElement('p');
    p.setAttribute('class', 'p-form');
    p.innerText = 'Digite a data de nascimento:';
    input = document.createElement('input');
    input.setAttribute('type', 'date');
    input.setAttribute('name', 'data_nasc');
    input.setAttribute('required', 'required');
    input.setAttribute('class', 'input-form');

    form.append(p);
    form.append(input);
    divForm.append(form);

    // <select name="select">
    //  <option value="valor1">Valor 1</option>
    //  <option value="valor2" selected>Valor 2</option>
    //  <option value="valor3">Valor 3</option>
    // </select>

    p = document.createElement('p');
    p.setAttribute('class', 'p-form');
    p.innerText = 'Selecione o genero:';
    let select = document.createElement('select');
    select.setAttribute('name', 'genero');
    let op = document.createElement('option');
    op.setAttribute('value' , '');
    op.setAttribute('selected', 'selected');
    let op1 = document.createElement('option');
    op1.setAttribute('value' , 'Feminino');
    op1.innerText = 'Feminino';
    let op2 = document.createElement('option');
    op2.setAttribute('value' , 'Masculino');
    op2.innerText = 'Masculino';
    select.setAttribute('required', 'required');
    select.setAttribute('class', 'input-form');
    select.append(op);
    select.append(op1);
    select.append(op2);

    form.append(p);
    form.append(select);
    divForm.append(form);

    let pE = document.createElement('p');
    pE.setAttribute('class', 'p-form');
    pE.innerText = 'Endereco: ';
    let pUnderLine = document.createElement('u');
    pUnderLine.append(pE);

    p = document.createElement('p');
    p.setAttribute('class', 'p-form');
    p.innerText = 'Digite o logradouro:';
    input = document.createElement('input');
    input.setAttribute('type', 'text');
    input.setAttribute('name', 'logradouro');
    input.setAttribute('required', 'required');
    input.setAttribute('class', 'input-form');

    form.append(pUnderLine);
    form.append(p);
    form.append(input);
    divForm.append(form);

    p = document.createElement('p');
    p.setAttribute('class', 'p-form');
    p.innerText = 'Digite o numero:';
    input = document.createElement('input');
    input.setAttribute('type', 'number');
    input.setAttribute('name', 'numero');
    input.setAttribute('required', 'required');
    input.setAttribute('class', 'input-form');

    form.append(p);
    form.append(input);
    divForm.append(form);

    p = document.createElement('p');
    p.setAttribute('class', 'p-form');
    p.innerText = 'Digite o bairro:';
    input = document.createElement('input');
    input.setAttribute('type', 'text');
    input.setAttribute('name', 'bairro');
    input.setAttribute('required', 'required');
    input.setAttribute('class', 'input-form');

    form.append(p);
    form.append(input);
    divForm.append(form);

    p = document.createElement('p');
    p.setAttribute('class', 'p-form');
    p.innerText = 'Digite a cidade:';
    input = document.createElement('input');
    input.setAttribute('type', 'text');
    input.setAttribute('name', 'cidade');
    input.setAttribute('required', 'required');
    input.setAttribute('class', 'input-form');

    form.append(p);
    form.append(input);
    divForm.append(form);


    p = document.createElement('p');
    p.setAttribute('class', 'p-form');
    p.innerText = 'Digite o CEP: ';
    input = document.createElement('input');
    input.setAttribute('type', 'text');
    input.setAttribute('name', 'cep');
    input.setAttribute('required', 'required');
    input.setAttribute('maxlength', '8');
    input.setAttribute('class', 'input-form');

    form.append(p);
    form.append(input);
    divForm.append(form);

    p = document.createElement('p');
    p.setAttribute('class', 'p-form');
    p.innerText = 'Digite o pais:';
    input = document.createElement('input');
    input.setAttribute('type', 'text');
    input.setAttribute('name', 'pais');
    input.setAttribute('required', 'required');
    input.setAttribute('class', 'input-form');

    form.append(p);
    form.append(input);
    divForm.append(form);

    let divB = document.createElement('div');

    let btCadastrarCliente = document.createElement('button');
    btCadastrarCliente.innerText = 'Cadastrar';
    btCadastrarCliente.setAttribute('class', 'bt-cad');
    divB.append(btCadastrarCliente);

    form.append(divB);
    divForm.append(form);

    main.append(divForm);

}

function espDesenvolvimentoProduto() {
    // console.log('ola pr');

    var main = document.querySelector('main');
    limparMain(main);

    let h2 = document.createElement('h2');
    let txt = document.createTextNode('CADASTRAR PRODUTO');
    h2.append(txt);
    main.append(h2);

    let form = document.createElement('form');
    form.setAttribute('method', 'POST');

    let divForm = document.createElement('div');
    divForm.setAttribute('class', 'div-formC');

    let p = document.createElement('p');
    p.setAttribute('class', 'p-form');
    p.innerText = 'Digite o código de barras:';
    let input = document.createElement('input');
    input.setAttribute('type', 'text');
    input.setAttribute('name', 'codigo');
    input.setAttribute('required', 'required');
    input.setAttribute('maxlength', '12');
    input.setAttribute('class', 'input-form');

    form.append(p);
    form.append(input);
    divForm.append(form);

    p = document.createElement('p');
    p.setAttribute('class', 'p-form');
    p.innerText = 'Digite o nome do produto:';
    input = document.createElement('input');
    input.setAttribute('type', 'text');
    input.setAttribute('name', 'nome_produto');
    input.setAttribute('required', 'required');
    input.setAttribute('class', 'input-form');

    form.append(p);
    form.append(input);
    divForm.append(form);

    // sombra, batom, corretivo, rimel, base, deliniador, blush, contorno, iluminador

    p = document.createElement('p');
    p.setAttribute('class', 'p-form');
    p.innerText = 'Selecione o tipo:';
    let select = document.createElement('select');
    select.setAttribute('name', 'tipo');
    let op = document.createElement('option');
    op.setAttribute('value' , '');
    op.setAttribute('selected', 'selected');
    let op1 = document.createElement('option');
    op1.setAttribute('value' , 'Sombra');
    op1.innerText = 'Sombra';
    let op2 = document.createElement('option');
    op2.setAttribute('value' , 'Batom');
    op2.innerText = 'Batom';
    let op3 = document.createElement('option');
    op3.setAttribute('value' , 'Corretivo');
    op3.innerText = 'Corretivo';
    let op4 = document.createElement('option');
    op4.setAttribute('value' , 'Rímel');
    op4.innerText = 'Rímel';
    let op5 = document.createElement('option');
    op5.setAttribute('value' , 'Base');
    op5.innerText = 'Base';
    let op6 = document.createElement('option');
    op6.setAttribute('value' , 'Deliniador');
    op6.innerText = 'Deliniador';
    let op7 = document.createElement('option');
    op7.setAttribute('value' , 'Blush');
    op7.innerText = 'Blush';
    let op8 = document.createElement('option');
    op8.setAttribute('value' , 'Contorno');
    op8.innerText = 'Contorno';
    let op9 = document.createElement('option');
    op9.setAttribute('value' , 'Iluminador');
    op9.innerText = 'Iluminador';
    select.setAttribute('required', 'required');
    select.setAttribute('class', 'input-form');
    select.append(op);
    select.append(op1);
    select.append(op2);
    select.append(op3);
    select.append(op4);
    select.append(op5);
    select.append(op6);
    select.append(op7);
    select.append(op8);
    select.append(op9);

    form.append(p);
    form.append(select);
    divForm.append(form);

    p = document.createElement('p');
    p.setAttribute('class', 'p-form');
    p.innerText = 'Digite o valor:';
    input = document.createElement('input');
    input.setAttribute('type', 'number');
    input.setAttribute('name', 'valor');
    input.setAttribute('required', 'required');
    input.setAttribute('class', 'input-form');

    form.append(p);
    form.append(input);
    divForm.append(form);

    p = document.createElement('p');
    p.setAttribute('class', 'p-form');
    p.innerText = 'Selecione a data de validade:';
    input = document.createElement('input');
    input.setAttribute('type', 'date');
    input.setAttribute('name', 'data_validade');
    input.setAttribute('required', 'required');
    input.setAttribute('class', 'input-form');

    form.append(p);
    form.append(input);
    divForm.append(form);

    p = document.createElement('p');
    p.setAttribute('class', 'p-form');
    p.innerText = 'Digite o peso líquido (em gramas):';
    input = document.createElement('input');
    input.setAttribute('type', 'number');
    input.setAttribute('name', 'peso_liquido');
    input.setAttribute('required', 'required');
    input.setAttribute('class', 'input-form');

    form.append(p);
    form.append(input);
    divForm.append(form);

    p = document.createElement('p');
    p.setAttribute('class', 'p-form');
    p.innerText = 'Selecione a tonalidade:';
    select = document.createElement('select');
    select.setAttribute('name', 'tonalidade');
    op = document.createElement('option');
    op.setAttribute('value' , '');
    op.setAttribute('selected', 'selected');
    op1 = document.createElement('option');
    op1.setAttribute('value' , 'Claro');
    op1.innerText = 'Claro';
    op2 = document.createElement('option');
    op2.setAttribute('value' , 'Médio');
    op2.innerText = 'Médio';
    op3 = document.createElement('option');
    op3.setAttribute('value' , 'Escuro');
    op3.innerText = 'Escuro';
    select.setAttribute('required', 'required');
    select.setAttribute('class', 'input-form');
    select.append(op);
    select.append(op1);
    select.append(op2);
    select.append(op3);

    form.append(p);
    form.append(select);
    divForm.append(form);

    p = document.createElement('p');
    p.setAttribute('class', 'p-form');
    p.innerText = 'Digite a quantidade no estoque:';
    input = document.createElement('input');
    input.setAttribute('type', 'number');
    input.setAttribute('name', 'numero_estoque');
    input.setAttribute('required', 'required');
    input.setAttribute('class', 'input-form');

    form.append(p);
    form.append(input);
    divForm.append(form);

    // Fenty Beauty, Makeup by Mario, Too Faced, Rare Beauty, Huda Beauty, Dior, MAC, Channel

    p = document.createElement('p');
    p.setAttribute('class', 'p-form');
    p.innerText = 'Selecione a marca:';
    select = document.createElement('select');
    select.setAttribute('name', 'marca');
    op = document.createElement('option');
    op.setAttribute('value' , '');
    op.setAttribute('selected', 'selected');
    op1 = document.createElement('option');
    op1.setAttribute('value' , 'Fenty Beauty');
    op1.innerText = 'Fenty Beauty';
    op2 = document.createElement('option');
    op2.setAttribute('value' , 'Makeup by Mario');
    op2.innerText = 'Makeup by Mario';
    op3 = document.createElement('option');
    op3.setAttribute('value' , 'Too Faced');
    op3.innerText = 'Too Faced';
    op4 = document.createElement('option');
    op4.setAttribute('value' , 'Rare Beauty');
    op4.innerText = 'Rare Beauty';
    op5 = document.createElement('option');
    op5.setAttribute('value' , 'Huda Beauty');
    op5.innerText = 'Huda Beauty';
    op6 = document.createElement('option');
    op6.setAttribute('value' , 'Dior');
    op6.innerText = 'Dior';
    op7 = document.createElement('option');
    op7.setAttribute('value' , 'MAC');
    op7.innerText = 'MAC';
    op7 = document.createElement('option');
    op7.setAttribute('value' , 'Channel');
    op7.innerText = 'Channel';
    select.setAttribute('required', 'required');
    select.setAttribute('class', 'input-form');
    select.append(op);
    select.append(op1);
    select.append(op2);
    select.append(op3);
    select.append(op4);
    select.append(op5);
    select.append(op6);
    select.append(op7);

    form.append(p);
    form.append(select);
    divForm.append(form);

    p = document.createElement('p');
    p.setAttribute('class', 'p-form');
    p.innerText = 'Selecione a pigmentação:';
    select = document.createElement('select');
    select.setAttribute('name', 'pigmentacao');
    op = document.createElement('option');
    op.setAttribute('value' , '');
    op.setAttribute('selected', 'selected');
    op1 = document.createElement('option');
    op1.setAttribute('value' , 'Baixa');
    op1.innerText = 'Baixa';
    op2 = document.createElement('option');
    op2.setAttribute('value' , 'Média');
    op2.innerText = 'Média';
    op3 = document.createElement('option');
    op3.setAttribute('value' , 'Alta');
    op3.innerText = 'Alta';
    select.setAttribute('required', 'required');
    select.setAttribute('class', 'input-form');
    select.append(op);
    select.append(op1);
    select.append(op2);
    select.append(op3);

    form.append(p);
    form.append(select);
    divForm.append(form);

    p = document.createElement('p');
    p.setAttribute('class', 'p-form');
    p.innerText = 'Selecione o tipo de embalagem:';
    select = document.createElement('select');
    select.setAttribute('name', 'tipo_embalagem');
    op = document.createElement('option');
    op.setAttribute('value' , '');
    op.setAttribute('selected', 'selected');
    op1 = document.createElement('option');
    op1.setAttribute('value' , 'Plástico');
    op1.innerText = 'Plástico';
    op2 = document.createElement('option');
    op2.setAttribute('value' , 'Vidro');
    op2.innerText = 'Vidro';
    op3 = document.createElement('option');
    op3.setAttribute('value' , 'Acrílico');
    op3.innerText = 'Acrílico';
    select.setAttribute('required', 'required');
    select.setAttribute('class', 'input-form');
    select.append(op);
    select.append(op1);
    select.append(op2);
    select.append(op3);

    form.append(p);
    form.append(select);
    divForm.append(form);

    let divB = document.createElement('div');

    let btCadastrarProduto = document.createElement('button');
    btCadastrarProduto.innerText = 'Cadastrar';
    btCadastrarProduto.setAttribute('class', 'bt-cad');
    divB.append(btCadastrarProduto);

    form.append(divB);
    divForm.append(form);

    main.append(divForm);

}

// biblioteca jquerry | essa função faz os alertas desapareceram depois de 5 segundos.
const myTimeout = setTimeout(
    remover,
    5000);


function remover() {
    $('#msg').hide();
}
