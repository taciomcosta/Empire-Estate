// Funções de validação de formulário

// Valida Usuário Comum (cadastroUsuario, pcUsuario)
function validaUsuarioComum(form) {

    // Se for o formulário de alterar cadastro de usuários
    if(form == 'A')
    {
        if (document.getElementById('senha_I').value == document.getElementById('confirmesenha_I').value) {

            return true;
        }
        else {
            alert('Senhas não conferem!');
            return false;
        }
    }
    // Se for algum dos formulários de cadastro
    else
    {
        if (document.getElementById('senha').value == document.getElementById('confirmesenha').value) {

            return true;
        }
        else {
            alert('Senhas não conferem!');
            return false;
        }
    }

}

// Valida Pesquisa de Imóvel
function validaPesquisaImovel()
{
    if(document.getElementById('pesquisaImovel').value == ''){
        alert('Por favor, preencha todos os campos corretamente');
        return false;
    }
    else
    {
        return true;
    }
}

// As funções abaixo validam os campos do formulário de cadastro de imóvel e de alterar imóvel
function validaImovel1(modal)
{
    if(modal == 'A')
    {
        if( document.getElementById('emailUsuario_I').value == '' ||  document.getElementById('nomeUsuario_I').value == '' )
        {
            alert('Por favor, preencha todos os campos corretamente');
            return false
        }
        else
            return true;
    }
    else
    {
        if( document.getElementById('emailUsuario').value == '' ||  document.getElementById('nomeUsuario').value == '' )
        {
            alert('Por favor, preencha todos os campos corretamente');
            return false
        }
        else
            return true;
        
    }
        
}

function validaImovel2(modal)
{
    if(modal == 'A')
    {    
        if( document.getElementById('tituloImovel_I').value == '' || document.getElementById('valorImovel_I').value == '')
        {
            alert('Por favor, preencha todos os campos corretamente');
            return false;
        }
        else if( document.getElementById('valorImovel_I').value.length > 7 )
        {
            alert("Preço Máximo: R$ 9.999.999,99");
            return false;
        }
        else
            return true;
    }
    else
    {
        if( document.getElementById('tituloImovel').value == '' || document.getElementById('valorImovel').value == '')
        {
            alert('Por favor, preencha todos os campos corretamente');
            return false;
        }
        else if( document.getElementById('valorImovel').value.length > 7 )
        {
            alert("Preço Máximo: R$ 9.999.999,99");
            return false;
        }
        else
            return true;
    }
        
}

function validaImovel3(modal)
{
    if(modal == 'A')
    {
        if( document.getElementById('cidadeImovel_I').value == '' || document.getElementById('enderecoImovel_I').value == '' || document.getElementById('numeroImovel_I').value == '' || document.getElementById('bairroImovel_I').value == '')
        {
            alert('Por favor, preencha todos os campos corretamente');
            return false;
        }
        else
            return true;
    }
    else
    {
        if( document.getElementById('cidadeImovel').value == '' || document.getElementById('enderecoImovel').value == '' || document.getElementById('numeroImovel').value == '' ||  document.getElementById('bairroImovel').value == '')
        {
            alert('Por favor, preencha todos os campos corretamente');
            return false;
        }
        else
            return true;
    }
        
}

function validaImovel4(modal)
{
    if(modal == 'A')
    {    
        if( document.getElementById('areaTotalImovel_I').value == '' || document.getElementById('areaUtilImovel_I').value == '' || document.getElementById('dormitoriosImovel_I').value == '' || document.getElementById('banheirosImovel_I').value == '' || document.getElementById('garagemImovel_I').value == '' || document.getElementById('descricaoImovel_I').value == '')
        {
            alert('Por favor, preencha todos os campos corretamente');
            return false;
        }
        else
            return true;
    }
    else
    {
        if( document.getElementById('areaTotalImovel').value == '' || document.getElementById('areaUtilImovel').value == '' || document.getElementById('dormitoriosImovel').value == '' || document.getElementById('banheirosImovel').value == '' || document.getElementById('garagemImovel').value == '' || document.getElementById('descricaoImovel').value == '')
        {
            alert('Por favor, preencha todos os campos corretamente');
            return false;
        }
        else
            return true;
    }

}

// Valida Cadastro de tipo de imóvel
function validaTipoImovel()
{
    if(document.getElementById('subcategoria').value == '')
    {
        alert('Por favor, preencha todos os campos corretamente');
        return false;
    }
    else
        return true;
}

//Funções dos botões VOLTAR E PRÓXIMO do Cadastro de Imóvel
function proximo(e1, e2, e3, e4, e5, col) {

    var display1 = document.getElementById(e1).style.display;
    var display2 = document.getElementById(e2).style.display;
    var display3 = document.getElementById(e3).style.display;
    var display4 = document.getElementById(e4).style.display;
    
    // Display da tela1 é undefined :/
    if (display1 != "none" && validaImovel1() ) 
    {
        document.getElementById(e1).style.display = "none";
        document.getElementById(e2).style.display = "block";
    }
    else if (display2 != "none" && validaImovel2() ) 
    {
        document.getElementById(e2).style.display = "none";
        document.getElementById(e3).style.display = "block";
    }
    else if (display3 != "none" && validaImovel3() ) 
    {
        document.getElementById(e3).style.display = "none";
        document.getElementById(e4).style.display = "block";
        
    }
    else if (display4 != "none" && validaImovel4() ) 
    {
        document.getElementById(e4).style.display = "none";
        document.getElementById(e5).style.display = "block";
        document.formImovel.btCadastrar.className = "btn btn-primary";
        document.getElementById(col).className = "col-md-12";
    }



}


function voltar(e1, e2, e3, e4, e5, col) {

    var display1 = document.getElementById(e1).style.display;
    var display2 = document.getElementById(e2).style.display;
    var display3 = document.getElementById(e3).style.display;
    var display4 = document.getElementById(e4).style.display;
    var display5 = document.getElementById(e5).style.display;


    
    if (display1 != "none") 
    {
        document.getElementById(e5).style.display = "none";
        document.getElementById(e4).style.display = "none";
        document.getElementById(e3).style.display = "none";
        document.getElementById(e2).style.display = "none";
        document.getElementById(e1).style.display = "block";
    }
    else if (display5 != "none") 
    {
        document.getElementById(col).className = "col-md-4";
        document.getElementById(e5).style.display = "none";
        document.getElementById(e4).style.display = "block";
        document.getElementById(e3).style.display = "none";
        document.getElementById(e2).style.display = "none";
        document.getElementById(e1).style.display = "none";
        document.formImovel.btCadastrar.className = "btn btn-primary disabled";
        
    }
    else if (display4 != "none") 
    {
        document.getElementById(e5).style.display = "none";
        document.getElementById(e4).style.display = "none";
        document.getElementById(e3).style.display = "block";
        document.getElementById(e2).style.display = "none";
        document.getElementById(e1).style.display = "none";      
    }
    else if (display3 != "none") 
    {
        document.getElementById(e5).style.display = "none";
        document.getElementById(e4).style.display = "none";
        document.getElementById(e3).style.display = "none";
        document.getElementById(e2).style.display = "block";
        document.getElementById(e1).style.display = "none";
                
    }
    else if (display2 != "none") 
    {
        document.getElementById(e5).style.display = "none";
        document.getElementById(e4).style.display = "none";
        document.getElementById(e3).style.display = "none";
        document.getElementById(e2).style.display = "none";
        document.getElementById(e1).style.display = "block";
    }

}


// Funções de carregar e excluir imagens das divs de cadastro
function carregaImg(img, div, botao) {

    if (document.getElementById(img).value != '') {
        document.getElementById(div).innerText = "OK!";
        document.getElementById(botao).style.display = "block";
        document.getElementById(img).readOnly = true;
        document.getElementById(div).setAttribute("onblur", "");
        document.getElementById(div).setAttribute("onmouseout", "");


    }
}

function apaga(img, div, botao) {
    document.getElementById(img).value = '';
    document.getElementById(div).innerText = "+";
    document.getElementById(botao).style.display = "none";
    document.getElementById(img).readOnly = false;
    // Redefine a função do Botão de Cancelar
    document.getElementById(botao).setAttribute("onclick", "apaga('"+img+"', '"+div+"','"+botao+"')");
    // Redefine as funções de carregar da div
    document.getElementById(div).setAttribute("onblur", "carregaImg('"+img+"', '"+div+"','"+botao+"')");
    document.getElementById(div).setAttribute("onmouseout", "carregaImg('"+img+"', '"+div+"','"+botao+"')");
    
}

// Função para apagar imagem da div no modal de Alterar Imóvel
function apaga_a(img, div, botao, imgNome) {
    
    if( confirm(" Deseja realmente deletar esta imagem? ") )
    {
        document.getElementById(div).innerText = "+";
        document.getElementById(div).style.fontSize = "40px";
        document.getElementById(botao).style.display = "none";
        document.getElementById(img).disabled = false;
        document.getElementById(img).value = '';
        document.getElementById(imgNome).style.display = "none";
        // Redefine a função do Botão de Cancelar
        document.getElementById(botao).setAttribute("onclick", "apaga('"+img+"', '"+div+"','"+botao+"')");
        // Redefine as funções de carregar da div
        document.getElementById(div).setAttribute("onblur", "carregaImg('"+img+"', '"+div+"','"+botao+"')");
        document.getElementById(div).setAttribute("onmouseout", "carregaImg('"+img+"', '"+div+"','"+botao+"')");
    }


}

function enviar()
{
   
}

// Função para checar aba de pesquisa da pcImovel.php, trabalha junto com o PHP da própria página
function checaAba()
{
    // Essa linha indica que foi feito uma pesquisa
    document.getElementById('funcaoPesquisa').value = 1;
}

//Função para mandar o codigo do imóvel pela URL para a página deletaImovel.php
function altera(cod)
{

    document.style.display = "none";
    document.getElementById('oForm').style.display = "block";
}

// Funções para abrir e fechar os modals
function fecharModal(modal) {

        document.getElementById("modalDeletar").style.display = "none";
        document.getElementById("modalAlterar").style.display = "none";
}


function abrirModal(modal,codigoImovel) {

        // Se for o modal de deletar imóvel
        if(modal == 'D')
        {
            document.getElementById("modalDeletar").style.display = "block";
            //Define o link do botão de Confirmar do delete 
            document.getElementById("confirmaDeletar").href = 'deletaImovel.php?codigo=' + codigoImovel;
        }
        // Se for o modal de deletar o tipo de imóvel
        else if(modal == 'DTI')
        {
            document.getElementById("modalDeletarTipoImovel").style.display = "block";
            document.getElementById("confirmaDeletarTipoImovel").href = 'deletaTipoImovel.php?codigo=' + codigoImovel;

        }
        // Se for o modal de alterar usuário, do Painel de Usuários
        else if(modal == 'AU')
        {
            document.getElementById("modalAlterarUsuario").style.display = "block";
        }
        else if(modal == 'DU')
        {
            document.getElementById("modalDeletar").style.display = "block";
            //Define o link do botão de Confirmar do delete 
            document.getElementById("confirmaDeletar").href = 'deletaUsuario.php?codigo=' + codigoImovel;
        }
        else
        {
            document.getElementById("modalAlterar").style.display = "block";
        }

}

// Função que troca os valores do formulário de cadastro, para que um tipo de imóvel seja alterado
function alterarTipoImovel(codigoTI, categoriaTI, subcategoriaTI, situacaoTI)
{

    document.getElementById('btCadastrarTipoImovel').innerHTML='Alterar';
    // Mostrando o botão de cancelar
    document.getElementById('btCancelarTipoImovel').style.display = "inline-block";

    // Checando o tipo de categoria do imóvel a ser alterado
    if(categoriaTI == 'Comercial')
        document.getElementById('comercial').checked = true;
    if(categoriaTI == 'Residencial')
        document.getElementById('residencial').checked = true;
    if(categoriaTI == 'Rural')
        document.getElementById('rural').checked = true;

    //Marcando o Checkbox de ativo
    if(situacaoTI == 1)
        document.getElementById('situacaoTICheckbox').checked = true;
    else
        document.getElementById('situacaoTICheckbox').checked = false;

    // Inserindo a subcategoria no input text
    document.getElementById('subcategoria').value = subcategoriaTI;
    // Mostrando a opção Ativo do tipo de imóvel
    document.getElementById('situacaoTipoImovel').style.display = "block";
    // Inserindo o código do tipo de imóvel no campo oculto da linha 779 do pcImovel.php
    document.getElementById('codigoTIAlterar').value = codigoTI;
    //Alterando o action do formulário
    document.getElementById('formTipoImovel').action = 'alteraTipoImovel.php';

}

// Função oposta da função acima
function cancelaTipoImovel()
{
    document.getElementById('btCadastrarTipoImovel').innerHTML='Cadastrar';

    // Mostrando o botão de cancelar
    document.getElementById('btCancelarTipoImovel').style.display = "none";

    document.getElementById('residencial').checked = true;

    // Inserindo a subcategoria no input text
    document.getElementById('subcategoria').value = '';
    // Mostrando a opção Ativo do tipo de imóvel
    document.getElementById('situacaoTipoImovel').style.display = "none";
    // Inserindo o código do tipo de imóvel no campo oculto da linha 779 do pcImovel.php
    document.getElementById('codigoTIAlterar').value = '';
    //Alterando o action do formulário
    document.getElementById('formTipoImovel').action = 'gravaTipoImovel.php';


}

//Função do pagination, para exibir/esconder os registros conforme clicar em cada botão
function paginacao (pagina, nRegistros, nPaginas){
        //Define a página anterior
        if( pagina != 1 )
        {  
            pg = "paginacao(" + (pagina-1) + ", " + nRegistros + ", " + nPaginas + ")";
            document.getElementById("pgAnterior").setAttribute("onclick", pg);
        }
        else
        {
            pg = "paginacao(" + pagina + ", " + nRegistros + ", " + nPaginas + ")";
            document.getElementById("pgAnterior").setAttribute("onclick", pg);
        }
        //Fim

        //Define a próxima página
        //Se não for a última página
        if(pagina != nPaginas)
        {  
            //pg = paginacao(proxima pagina, número de registros, número de páginas)
            pg = "paginacao(" + (pagina+1) + ", " + nRegistros + ", " + nPaginas + ")";
            document.getElementById("pgProxima").setAttribute("onclick", pg);
        }
        else
        {
            pg = "paginacao(" + pagina + ", " + nRegistros + ", " + nPaginas + " )";
            document.getElementById("pgProxima").setAttribute("onclick", pg);
        }
        //Fim

        //pagina recebrá o número do último registro que ficará visível
        pagina *= 5;

        //Oculta todos os registros
        for(var i=1; i<=nRegistros; i++)
            document.getElementById('registro' + i).style.display="none";

        //Mostra os registros referentes a página
        for(var i=0; i<=4; i++)
            //Se o registro existir
            if( pagina - i <= nRegistros )
                document.getElementById('registro' + (pagina - i)).style.display="table-row"; 

}

//As funções abaixo configuram o Modal de Alterar Imóveis
function alterarImovel(codImovel)
{
    location.href="pcImovel.php?alterarImovel="+codImovel;
}

function proximo_a(e1, e2, e3, e4, e5, col) {

    
    var display1 = document.getElementById(e1).style.display;
    var display2 = document.getElementById(e2).style.display;
    var display3 = document.getElementById(e3).style.display;
    var display4 = document.getElementById(e4).style.display;
    
    // Display da tela1 é undefined :/
    if (display1 != "none" && validaImovel1('A') ) 
    {
        document.getElementById(e1).style.display = "none";
        document.getElementById(e2).style.display = "block";
    }
    else if (display2 != "none" && validaImovel2('A') ) 
    {
        document.getElementById(e2).style.display = "none";
        document.getElementById(e3).style.display = "block";
    }
    else if (display3 != "none" && validaImovel3('A') ) 
    {
        document.getElementById(e3).style.display = "none";
        document.getElementById(e4).style.display = "block";
        
    }
    else if (display4 != "none" && validaImovel4('A')) 
    {
        document.getElementById(e4).style.display = "none";
        document.getElementById(e5).style.display = "block";
        document.getElementById(col).style.width = "1100px";


        
    }
    



}

function voltar_a(e1, e2, e3, e4, e5, col) {

    var display1 = document.getElementById(e1).style.display;
    var display2 = document.getElementById(e2).style.display;
    var display3 = document.getElementById(e3).style.display;
    var display4 = document.getElementById(e4).style.display;
    var display5 = document.getElementById(e5).style.display;
    

    if (display1 != "none") 
    {
        document.getElementById(e4).style.display = "none";
        document.getElementById(e3).style.display = "none";
        document.getElementById(e2).style.display = "none";
        document.getElementById(e1).style.display = "block";
    }
    else if (display5 != "none") 
    {
        document.getElementById(e5).style.display = "none";
        document.getElementById(e4).style.display = "block";
        document.getElementById(e3).style.display = "none";
        document.getElementById(e2).style.display = "none";
        document.getElementById(e1).style.display = "none";
        document.getElementById(col).style.width = "598px";
       
    }
   
    else if (display4 != "none") 
    {
        document.getElementById(e4).style.display = "none";
        document.getElementById(e3).style.display = "block";
        document.getElementById(e2).style.display = "none";
        document.getElementById(e1).style.display = "none";      
    }
    else if (display3 != "none") 
    {
        document.getElementById(e4).style.display = "none";
        document.getElementById(e3).style.display = "none";
        document.getElementById(e2).style.display = "block";
        document.getElementById(e1).style.display = "none";
                
    }
    else if (display2 != "none") 
    {
        document.getElementById(e4).style.display = "none";
        document.getElementById(e3).style.display = "none";
        document.getElementById(e2).style.display = "none";
        document.getElementById(e1).style.display = "block";
    }

}

// Funções do Painel de Usuários

//A função abaixo configura o Modal de Alterar Usuários
function alterarUsuario(codUsuario)
{
    location.href="pcUsuario.php?alteraUsuario="+codUsuario;    
}
