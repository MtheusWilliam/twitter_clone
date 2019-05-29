<?php

	/* DESCOMENTAR PARA DEBUG
	echo '<pre>';
		print_r($_FILES);
	echo '<pre>';
	*/
	
	//verifica quantos arquivos estão sendo recebidos na superglobal $)FILES
	$total_arquivos = count($_FILES['arquivos']['name']);
	
	//diretório de upload
	$diretorio_upload = './uploads/';

	//percorre cada arquivo
	for ($i=0; $i < $total_arquivos; $i++) {
				
		/* DESCOMENTAR PARA DEBUG
		echo $_FILES['arquivos']['name'][$i].' - ';
		echo $_FILES['arquivos']['type'][$i].' - ';
		echo $_FILES['arquivos']['tmp_name'][$i].' - ';
		echo $_FILES['arquivos']['error'][$i].' - ';
		echo $_FILES['arquivos']['size'][$i];
		echo '<hr />';
		*/
		
		
		//move o arquivo temporario para o destino
		$arquivo_upload = $diretorio_upload . basename($_FILES['arquivos']['name'][$i]);
		if (move_uploaded_file($_FILES['arquivos']['tmp_name'][$i], $arquivo_upload)) {
			echo "Sucesso<br />";
		} else {
			echo "Erro<br />";
		}
        
	}

	

?>