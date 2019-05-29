$(document).ready( function(){

	$('#btn_login').click(function(){

		var campo_vazio = false;

		if($('#campo_usuario').val() == ''){
			$('#campo_usuario').css({'border-color' : '#A94442'});
			campo_vazio = true;
		} else {
			$('#campo_usuario').css({'border-color' : '#CCC'});
		}
		if($('#campo_senha').val() == ''){
			alert('Campo senha está vazio');
			$('#campo_senha').css({'border-color' : '#A94442'});
			campo_vazio = true;
		}else {
			$('#campo_senha').css({'border-color' : '#CCC'});
		}
		if (campo_vazio) return false;
	});

	/*$('#btn_tweet').click(function(){

					if($('#texto_tweet').val().length > 0){

						$.ajax({

							url: 'incluir_tweet.php',

							success: function(data){
								
								alert(data);

							}

						});

					}

				});
	*/

	//função para quando já existirem usuario e(ou) email cadastrados
	/* $('#btn_inscrevase').click(function(){

		var info_existe = false;

		if($('#usuario_cadastro').val() == ''){
			$('#usuario').css({'border-color' : '#A94442'});
			info_existe = true;
		} else {
			$('#usuario').css({'border-color' : '#CCC'});
		}
		if($('#email').val() == ''){
			$('#email').css({'border-color' : '#A94442'});
			info_existe = true;
		}else {
			$('#email').css({'border-color' : '#CCC'});
		}
		if (info_existe) return false;

	});
	*/
});