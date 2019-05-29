<?php
	session_start();

	if(!isset($_SESSION['usuario'])){
		header('Location: index.php?erro=1');
	}

	require_once('db_class.php');

	$id_usuario = $_SESSION['id_usuario'];
	$deletar_tweet_id = $_POST['deletar_tweet_id'];
	
	if ($deletar_tweet_id == '' || $id_usuario == '') {
		die();
	}

	$obj_db = new db();
	$link = $obj_db->conecta_mysql();

	$sql = "DELETE FROM tweet WHERE id_tweet = $deletar_tweet_id AND id_usuario = $id_usuario";

	mysqli_query($link, $sql);

?>
