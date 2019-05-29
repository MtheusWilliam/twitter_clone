<?php
	
	session_start();
	if(!isset($_SESSION['usuario'])){
		header('Location: index.php?erro=1');
	}

	require_once('db_class.php');

	$nome_pessoa = $_POST['nome_pessoa'];
	$id_usuario = $_SESSION['id_usuario'];

	$obj_db = new db();
	$link = $obj_db->conecta_mysql();

	$sql = "SELECT u.*, us.* "; 
	$sql.= "FROM usuario AS u "; 
	$sql.= "LEFT JOIN usuario_seguidores AS us ";
	$sql.= "ON (us.id_usuario = $id_usuario AND u.id = us.seguindo_id_usuario)
	WHERE u.usuario like '%$nome_pessoa%' AND u.id <> $id_usuario";

	$resultado_id = mysqli_query($link, $sql);

	if ($resultado_id) {
		
		while ($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)) {
			echo '<a href="#" class="list-group-item"';
				echo '<strong>' . $registro['usuario'] . '</strong> <small> - ' . $registro['email'] . ' </small>';
					echo '<p class="list-group-item-text pull-right">';

					$esta_seguindo_usuario_sn = isset($registro['id_usuario_seguidor']) && !empty($registro['id_usuario_seguidor']) ? 'S' : 'N';
					$btn_seguir_display= 'block';
					$btn_deixar_seguir_display= 'block';

					if($esta_seguindo_usuario_sn == 'N') {
						$btn_deixar_seguir_display = 'none';
					}else{
						$btn_seguir_display = 'none';
					}

					echo '<button type="button" id="btn_seguir_' . $registro['id'] . '" style="display: ' . $btn_seguir_display . '" class="btn btn-primary btn_seguir" data-id_usuario="' . $registro['id'] . '"> Seguir </button>';

					echo '<button type="button" id="btn_deixar_seguir_'. $registro['id'] . '" style="display: ' . $btn_deixar_seguir_display . '"  class="btn btn-default btn_deixar_seguir" data-id_usuario="' . $registro['id'] . '"> Deixar de seguir </button>';

				echo '</p>';
				echo '<div class="clearfix"></div>';

			echo '</a>';
		}

	}else {
		echo "Erro na consulta de usuários no BD";
	}
?>