$(function () {
    /* Executa a requisição quando o campo CEP perder o foco */
    $('#cep').blur(function () {

        $.ajax({
            url: BASE_URL + 'ajax/consultar_cep',
            type: 'POST',
            data: 'cep=' + $('#cep').val(),
            dataType: 'json',
            success: function (data) {
                if (data.sucesso == 1) {
                    $('#rua').val(data.rua);
                    $('#bairro').val(data.bairro);
                    $('#cidade').val(data.cidade);
                    $('#estado').val(data.estado);

                    $('#numero').focus();
                }
            }
        });
        return false;
    })

    if ($('#cadastrolist')[0]) {
        cadastroList();
    }

    $("#serachCadastro").keyup(function () {
        let p = $(this).val();
        if (p.length > 0) {
            cadastroList('', p);
        } else {
            cadastroList();
        }
    });

    function cadastroList(pagina = 1, pesquisa = '') {
        $.ajax({
            url: `${BASE_URL}ajax/cadastroList`,
            type: 'GET',
            data: {
                pagina,
                pesquisa
            },
            success: function (r) {
                $('#cadastrolist').html(r);
            },
            complete: function () {
                $('.paginationLink').click(function () {
                    let pagina = $(this).attr('data-p');
                    cadastroList(pagina);
                });
            }
        });
    }
    function cadastroListDependente(id_cliente, pagina = 1) {
        $.ajax({
            url: `${BASE_URL}ajax/cadastroListDepententes`,
            type: 'GET',
            data: {
                pagina,
                id_cliente
            },
            success: function (r) {
                $('#cadastroDependenteList').html(r);
            },
            complete: function () {
                $('.paginationLink').click(function () {
                    let pagina = $(this).attr('data-p');
                    cadastroListDependente(pagina);
                });
            }
        });
    }
    if ($("#cadastroDependenteList")[0]) {
        let id_cliente = document.querySelector('#cadastroDependenteList').getAttribute('data-idcliente');
        cadastroListDependente(id_cliente, 1);
    }
    if ($('#cadastrolistIndicadors')[0]) {
        let idCliente = $('#cadastrolistIndicadors').attr("data-idindicado");
        let idNegocio = $('#cadastrolistIndicadors').attr('data-idnegcio');
        console.log(idCliente + ' ' + idNegocio);
        cadastroListIndicators(idCliente, idNegocio);
    }
    /*$("#cadastrolistIndicadors").keyup(function(){
        let p = $(this).val();
        if(p.length > 0)
        {
            cadastroListIndicators('',p);
        }else{
            cadastroListIndicators();
        }
    });*/
    function cadastroListIndicators(id_cliente, id_negocio) {
        $.ajax({
            url: `${BASE_URL}ajax/cadastroListIndicators`,
            type: 'GET',
            data: {
                id_cliente,
                id_negocio
            },
            success: function (r) {
                $('#cadastrolistIndicadors').html(r);
            },
            complete: function () {

            }
        });
    }

    if (document.getElementById('lista_rede_credenciada')) {
        carregarList();
    }

    function carregarList(pagina = 1) {
        $.ajax({
            url: BASE_URL + 'ajax/listarRedeCredenciada',
            type: 'GET',
            data: { p: pagina },
            success: function (r) {
                $('#lista_rede_credenciada').html(r);
                $('.linkP').click(function () {
                    let pagina = $(this).attr('data-p');
                    carregarList(pagina);
                });
            }
        });
    }
})

/**
 * @param string
 * @return void
 */
async function sendEmailTerm(elem) {

    elem.innerHTML = 'Enviando...';
    let elemUrl = elem.getAttribute('data-url');
    let url = `${elemUrl}`;
    let req = await fetch(url);
    let json = await req.json();
    
    if(json.email) {
        elem.innerHTML = 'Enviado!';
    } else {
        elem.innerHTML = 'Ops! Email não encontrado!';
    }

}