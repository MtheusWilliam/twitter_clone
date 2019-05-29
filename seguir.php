<?php
	session_start();

	if(!isset($_SESSION['usuario'])){
		header('Location: index.php?erro=1');
	}

	require_once('db_class.php');

	$id_usuario = $_SESSION['id_usuario'];
	$seguir_id_usuario = $_POST['seguir_id_usuario'];
	
	if ($seguir_id_usuario == '' || $id_usuario == '') {
		die();
	}

	$obj_db = new db();
	$link = $obj_db->conecta_mysql();

	$sql = "insert into usuario_seguidores(id_usuario, seguindo_id_usuario)values($id_usuario, $seguir_id_usuario)";

	mysqli_query($link, $sql);

?>
