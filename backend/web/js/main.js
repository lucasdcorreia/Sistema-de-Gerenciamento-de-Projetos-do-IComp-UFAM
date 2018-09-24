
$(document).ready( function() {
	$('input[name="Edital[mestrado]"]').on('switchChange.bootstrapSwitch', function(data, state) { 
        if(state){
            $('#divVagasMestrado').css('display', 'block');
            $('#form_mestrado').val('1');
        }else{
            $('#divVagasMestrado').css('display', 'none');
            $('#form_mestrado').val('');
        }
    });

    $('input[name="Edital[doutorado]"]').on('switchChange.bootstrapSwitch', function(data, state) { 
        if(state){
            $('#divVagasDoutorado').css('display', 'block');
            $('#form_doutorado').val('1');
        }else{
            $('#divVagasDoutorado').css('display', 'none');
            $('#form_doutorado').val('');
        }
    });

    $('input[name="Edital[editalUpload]"]').on('switchChange.bootstrapSwitch', function (data, state) {
    	if (state)
    		$('#divDocumentoFile').css('display', 'block');
    	else
    		$('#divDocumentoFile').css('display', 'none');
    });

    $('input[name="Aluno[bolsista]"]').on('switchChange.bootstrapSwitch', function (data, state) {
        if (state)
            $('#divAgencia').css('display', 'block');
        else
            $('#divAgencia').css('display', 'none');
    });

    $('#aluno-nacionalidade').click(function(){
        if($( "input[name='Aluno[nacionalidade]']:checked" ).val() == 1){
            $('#divBrasileiro').css('display', 'block');
            $('#divEstrangeiro').css('display', 'none');

        }else{
            $('#divEstrangeiro').css('display', 'block');
            $('#divBrasileiro').css('display', 'none');
        }
   });
   
   $('input[name="User[secretaria]"]').on('switchChange.bootstrapSwitch', function (data, state) {
        if (state)
            $('#divSecretaria').css('display', 'block');
        else
            $('#divSecretaria').css('display', 'none');
    });
	
	$('input[name="User[professor]"]').on('switchChange.bootstrapSwitch', function (data, state) {
        if (state)
            $('#divProfessor').css('display', 'block');
        else
            $('#divProfessor').css('display', 'none');
    });
	
	$('input[name="SignupForm[secretaria]"]').on('switchChange.bootstrapSwitch', function (data, state) {
        if (state)
            $('#divSecretaria').css('display', 'block');
        else
            $('#divSecretaria').css('display', 'none');
    });
	
	$('input[name="SignupForm[professor]"]').on('switchChange.bootstrapSwitch', function (data, state) {
        if (state)
            $('#divProfessor').css('display', 'block');
        else
            $('#divProfessor').css('display', 'none');
    });
});



$( window ).on('load',function(){

/*Inicio das exibições das vagas e cotas do Edital*/
	if($('#form_mestrado').val() == 1){
		$('#divVagasMestrado').css('display', 'block');
	}
	if($('#form_doutorado').val() == 1)
		$('#divVagasDoutorado').css('display', 'block');
/*Fim das exibições das vagas e cotas do Edital*/
    
    if($("input[name='Aluno[nacionalidade]']:checked" ).val() == 1){
        $('#divBrasileiro').css('display', 'block');
        $('#divEstrangeiro').css('display', 'none');

    }else if($( "input[name='Aluno[nacionalidade]']:checked" ).val() == 2){
        $('#divEstrangeiro').css('display', 'block');
        $('#divBrasileiro').css('display', 'none');
    }

    if ($("#form_bolsista").val() == '1') {
        $('#divAgencia').css('display', 'block');
    }
});
