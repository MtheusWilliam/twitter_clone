<?php
	session_start();

	if(!isset($_SESSION['usuario'])){
		header('Location: index.php?erro=1');
	}

	require_once('db_class.php');

	$id_usuario = $_SESSION['id_usuario'];
	$deixar_seguir_id_usuario = $_POST['deixar_seguir_id_usuario'];
	
	if ($deixar_seguir_id_usuario == '' || $id_usuario == '') {
		die();
	}

	$obj_db = new db();
	$link = $obj_db->conecta_mysql();

	$sql = "DELETE FROM usuario_seguidores WHERE id_usuario = $id_usuario AND seguindo_id_usuario = $deixar_seguir_id_usuario";

	mysqli_query($link, $sql);

?>
