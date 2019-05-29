<?php
	
	session_start();
	if(!isset($_SESSION['usuario'])){
		header('Location: index.php?erro=1');
	}

	require_once('db_class.php');

	$obj_db = new db();
	$link = $obj_db->conecta_mysql();

	$id_usuario = $_SESSION['id_usuario'];

	$info_usuario = $_POST['info_usuario'];

	if ($info_usuario == 'n_tweets') {
		//qtd tweets
		$sql = " SELECT COUNT(*) AS qtd_tweets FROM tweet WHERE id_usuario = $id_usuario ";

		$resultado_id = mysqli_query($link, $sql);

		$qtd_tweets = 0;

		if ($resultado_id) {
			$registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
			$qtd_tweets = $registro['qtd_tweets'];
			echo $qtd_tweets;
		}else{
			echo "Erro na execução da consulta...";
		}

	}elseif($info_usuario == 'n_seguidores'){
		//qtd seguidores
		$sql = " SELECT COUNT(*) AS qtd_seguidores FROM usuario_seguidores WHERE seguindo_id_usuario = $id_usuario ";

		$resultado_id = mysqli_query($link, $sql);

		$qtd_seguidores = 0;

		if ($resultado_id) {
			$registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
			$qtd_seguidores = $registro['qtd_seguidores'];
			echo $qtd_seguidores;
		}else{
			echo "Erro na execução da consulta...";
		}
	}
	

	
?>
