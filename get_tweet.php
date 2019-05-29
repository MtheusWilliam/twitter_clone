<?php
	
	session_start();
	if(!isset($_SESSION['usuario'])){
		header('Location: index.php?erro=1');
	}

	require_once('db_class.php');

	$id_usuario = $_SESSION['id_usuario'];

	$obj_db = new db();
	$link = $obj_db->conecta_mysql();

	$sql = "SELECT DATE_FORMAT(t.data_inclusao, '%d %b %Y %T') AS data_inclusao_formatada, t.id_tweet, t.id_usuario, t.tweet, u.usuario ";
	$sql.= "FROM tweet AS t JOIN usuario AS u ON(t.id_usuario = u.id) ";
	$sql.= "WHERE id_usuario = $id_usuario ";
	$sql.= "OR id_usuario IN (SELECT seguindo_id_usuario from usuario_seguidores where id_usuario = $id_usuario) ";
	$sql.= "ORDER BY data_inclusao DESC";

	$resultado_id = mysqli_query($link, $sql);

	if ($resultado_id) {
		
		while ($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)) {
			echo '<a href="#" class="list-group-item"';
				echo '<h4 class="list-group-item-heading"><strong>' . $registro['usuario'] . '</strong> <small> - ' . $registro['data_inclusao_formatada'] . '</small> </h4>';

				if ($registro['id_usuario'] == $id_usuario) {
					$deletar_tweet = 'sim';
					$deletar_tweet_id = $registro['id_tweet'];
				}else{
					$deletar_tweet = 'nao';
					$deletar_tweet_id = '';
				}

				if ($deletar_tweet == 'sim') {
					$btn_deletar_tweet_display = 'block';
				}else{
					$btn_deletar_tweet_display = 'none';
				}

				echo '<p class="list-group-item-text pull-right">';
					echo '<button type="button" style="display: ' . $btn_deletar_tweet_display . '" id="btn_deletar_tweet_' . $deletar_tweet_id . '" class="btn btn-danger btn_deletar_tweet" data-deletar_tweet_id="' . $deletar_tweet_id . '"> Deletar tweet </button>';
				echo '</p>';
				echo '<div class="clearfix"></div>';

				echo '<p class="list-group-item-text">' . $registro['tweet'] . '</p>';

			echo '</a>';
		}

	}else {
		echo "Erro na consulta de tweets no BD";
	}
?>