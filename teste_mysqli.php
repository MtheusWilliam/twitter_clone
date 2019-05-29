<?php

	require_once('db_class.php');


	 $sql = " SELECT * FROM usuarios";

	 $obj_db = new db();
	 $link = $obj_db->conecta_mysql();

	 $resultado_id =  mysqli_query($link, $sql);

	 if($resultado_id){
	 	$dados_usuario = array();

	 	while ($linha = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)) {
	 		$dados_usuario[] = $linha;
	 	}

	 	foreach ($dados_usuario as $usuario) {
	 		var_dump($usuario);
	 		echo('<br><br>');
	 	}
	 
	 } else{
	 	echo('Erro na execução da consulta, notifique o administrador do site.');
	 }

?>