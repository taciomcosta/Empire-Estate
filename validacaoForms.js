// Funções de validação de formulário

// Valida Usuário Comum (cadastroUsuario, pcUsuario)
    function validaUsuarioComum() {

        if (document.getElementById('senha').value == document.getElementById('confirmesenha').value) {

            return true;
        }
        else {
            alert('Senhas não conferem!');
            return false;
        }

    }

// valida Pesquisa de Imóvel
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

// As funções abaixo validam as telas de cadastro de imóvel
function validaImovel1()
{
    if( document.getElementById('emailUsuario').value == '' ||  document.getElementById('nomeUsuario').value == '' )
    {
        alert('Por favor, preencha todos os campos corretamente');
        return false
    }
    else
        return true;
        
}

function validaImovel2()
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

function validaImovel3()
{
    if( document.getElementById('cidadeImovel').value == '' || document.getElementById('enderecoImovel').value == '' || document.getElementById('numeroImovel').value == '' || document.getElementById('complementoImovel').value == '' || document.getElementById('bairroImovel').value == '')
    {
        alert('Por favor, preencha todos os campos corretamente');
        return false;
    }
    else
        return true;
        
}

function validaImovel4()
{
    if( document.getElementById('areaTotalImovel').value == '' || document.getElementById('areaUtilImovel').value == '' || document.getElementById('dormitoriosImovel').value == '' || document.getElementById('banheirosImovel').value == '' || document.getElementById('garagemImovel').value == '' || document.getElementById('descricaoImovel').value == '')
    {
        alert('Por favor, preencha todos os campos corretamente');
        return false;
    }
    else
        return true;
        
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
    if (display1 != "none" && validaImovel1()) 
    {
        document.getElementById(e1).style.display = "none";
        document.getElementById(e2).style.display = "block";
    }
    else if (display2 != "none" && validaImovel2()) 
    {
        document.getElementById(e2).style.display = "none";
        document.getElementById(e3).style.display = "block";
    }
    else if (display3 != "none" && validaImovel3()) 
    {
        document.getElementById(e3).style.display = "none";
        document.getElementById(e4).style.display = "block";
        
    }
    else if (display4 != "none" && validaImovel4()) 
    {
        document.getElementById(e4).style.display = "none";
        document.getElementById(e5).style.display = "block";
        document.formImovel.btCadastrar.className = "btn btn-primary";
        document.getElementById(col).className = "col-md-6";
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


// Funções de carregar e excluir imagens das divs
function carregaImg(img, div, botao) {

    if (document.getElementById(img).value != '') {
        document.getElementById(div).innerText = "OK!";
        document.getElementById(botao).style.display = "block";
        document.getElementById(img).readOnly = true;


    }
}

function apaga(img, div, botao) {
    document.getElementById(img).value = '';
    document.getElementById(div).innerText = "+";
    document.getElementById(botao).style.display = "none";
    document.getElementById(img).readOnly = false;


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

    location.href='pcImovel.php?alteraImovel=' + cod;
}

// Funções para abrir e fechar os modals
function fecharModal() {

    document.getElementById("modalDeletar").style.display = "none";

}


function abrirModal(codigoImovel) {

        document.getElementById("modalDeletar").style.display = "block";
        //Define o link do botão de Confirmar do delete 
        document.getElementById("confirmaDeletar").href = 'deletaImovel.php?codigo=' + codigoImovel;

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

        pagina *= 5;

        //Oculta todos os registros
        for(var i=1; i<=nRegistros; i++)
            document.getElementById('registro' + i).style.display="none";

        //Mostra os registros referentes a página
        for(var i=0; i<=4; i++)
            //Se o registro existir
            if( pagina - i <= nRegistros )
                document.getElementById('registro' + (pagina - i)).style.display="table-row";

        
        // //Se o click for em Anterior
        // else if (pagina != nRegistros*5)
        // {
        //     //Determinando a página que está sendo exibida
        //     i = nRegistros;
        //     while(pagina == 0)
        //     {
        //         if (document.getElementById('registro' + i).style.display != "none")
        //             pagina = i;
        //         else
        //             i--;
        //     }
        //     pagina -= 5;
            
        //     if(pagina > 0)
        //     {
        //     //Oculta todos os registros
        //     for(var i=1; i<=nRegistros; i++)
        //         document.getElementById('registro' + i).style.display="none";
        //     //Mostra os registros referentes a página
        //     for(var i=0; i<=4; i++)
        //         //Se o registro existir
        //         if( pagina - i <= nRegistros )
        //             document.getElementById('registro' + (pagina - i)).style.display="table-row";
        //     }

        // }
        // //Se o click for em Próxima
        // else
        // {

        // }


    

}