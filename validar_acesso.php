<?php

	session_start();

	require_once('db_class.php');

	 $usuario = $_POST['usuario'];
	 $senha = md5($_POST['senha']);

	 $sql = " SELECT id, usuario, email FROM usuario where usuario = '$usuario' AND senha = '$senha' ";

	 $obj_db = new db();
	 $link = $obj_db->conecta_mysql();

	 $resultado_id =  mysqli_query($link, $sql);

	 if($resultado_id){
	 	$dados_usuario = mysqli_fetch_array($resultado_id);
	 	
	 	if (isset($dados_usuario['usuario'])) {

			$_SESSION['id_usuario'] = $dados_usuario['id'];
	 		$_SESSION['usuario'] = $dados_usuario['usuario'];
	 		$_SESSION['email'] = $dados_usuario['email'];

	 		header('Location: home.php');

	 	} else{
	 		header('Location: index.php?erro=1');
	 	}

	 } else{
	 	echo('Erro na execução da consulta, notifique o administrador do site.');
	 }

	 
	 //update
	 //insert
	 //select
	 //delete

?>