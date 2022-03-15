function closeFlash() {
    let el = document.querySelector('.flash');

    el.style.display = 'none';
}


/*
$(function(){
	
   $('#cep').keyup(function(){
           let cep = $(this).val();
           if(cep.length == 8){
                $.ajax({
                    //url : BASE_URL+'ajax/consultar_cep',  
                    url : `https://viacep.com.br/ws/${cep}/json/`, 
                    type : 'GET', 
                    dataType: JSON,
                    data: {cep}, 
                    dataType: 'json', 
                    success: function(data){
                        if(data.erro != true){
                            $('#rua').val(data.logradouro);
                            $('#bairro').val(data.bairro);
                            $('#cidade').val(data.localidade);
                            $('#estado').val(data.uf);
                            $('#numero').focus();
                        }
                    }
            });
           }    
   return false;    
   });
*/
   //Chamada para carregando ao clicar em concluir
   /*
   $('form').submit((e)=>{
       
       $('.load').attr('style','display:flex');
   });
   
   $('#cpf').keyup(function(){
       
       let cpf = $(this).val();
       if(cpf.length == 14){
           verificarCPF(cpf);
       }
   });
   function verificarCPF(cpf){
       $.ajax({
           url:`${BASE_URL}ajax/verificarcpf`,
           type: 'GET',
           data: {cpf:cpf},
           success:function(r){
               //Quando o cpf está disponível para cadastro
                if(r.status == 1){
                    $('#cpf').removeClass('validado');
                    $('#cpf').addClass('naovalidado');
                    $('.avisoTexto').attr('style','display:block');
                    $('.avisoTexto').text('CPF já cadastrado!');
                    $('.btCadastrar').attr('style','display:none');
                }else{
                    //Quando o CPF não está disponível para cadastro
                    let sp = cpf.replace('.',"");
                    let sempontos = sp.replace('.',""); 
                    let novocpf = sempontos.replace('-',"");

                    if(validarCPF(novocpf) == true) {
                        //Quando CPF validado
                        $('#cpf').removeClass('naovalidado');
                        $('#cpf').addClass('validado');
                        $('.avisoTexto').attr('style','display:block; background-color:green;padding: 10px; margin-bottom:10px;');
                        $('.avisoTexto').text('OK!');
                        $('.btCadastrar').attr('style','display:block');
                    }else{
                        //Quando CPF não válido
                        $('#cpf').removeClass('validado');
                        $('#cpf').addClass('naovalidado');
                        $('.avisoTexto').attr('style','display:block');
                        $('.avisoTexto').text('CPF inválido!');
                        $('.btCadastrar').attr('style','display:none');
                    }

                }
           }
       });
   }
   */
  /*
    function validarCPF(inputCPF){
        let soma = 0;
        let resto;

        if(inputCPF == '00000000000') return false;
        for(i=1; i<=9; i++) soma = soma + parseInt(inputCPF.substring(i-1, i)) * (11 - i);
        resto = (soma * 10) % 11;

        if((resto == 10) || (resto == 11)) resto = 0;
        if(resto != parseInt(inputCPF.substring(9, 10))) return false;

        soma = 0;
        for(i = 1; i <= 10; i++) soma = soma + parseInt(inputCPF.substring(i-1, i))*(12-i);
        resto = (soma * 10) % 11;

        if((resto == 10) || (resto == 11)) resto = 0;
        if(resto != parseInt(inputCPF.substring(10, 11))) return false;
        return true;
    }
*/
/*
   $('#senha').keyup(function(){
       let = senha = $(this).val();
       if(senha.length >= 6){
            $(this).removeClass('naovalidado');
            $(this).addClass('validado');
       }else{
            $(this).removeClass('validado');
            $(this).addClass('naovalidado');
       }
   });
   $('#confirmar_senha').keyup(function(){
       let confirmar = $(this).val();
       if(confirmar == $('#senha').val()){
            $(this).removeClass('naovalidado');
            $(this).addClass('validado');
       }else{
            $(this).removeClass('validado');
            $(this).addClass('naovalidado');
       }
   });
   */

   
  