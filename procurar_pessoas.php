<?php
	
	session_start();
	if(!isset($_SESSION['usuario'])){
		header('Location: index.php?erro=1');
	}

	require_once('db_class.php');

	$obj_db = new db();
	$link = $obj_db->conecta_mysql();

	$id_usuario = $_SESSION['id_usuario'];

	//qtd tweets
	$sql = " SELECT COUNT(*) AS qtd_tweets FROM tweet WHERE id_usuario = $id_usuario ";

	$resultado_id = mysqli_query($link, $sql);

	$qtd_tweets = 0;

	if ($resultado_id) {
		$registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
		$qtd_tweets = $registro['qtd_tweets'];
	}else{
		echo "Erro na execução da consulta...";
	}

	//qtd seguidores
	$sql = " SELECT COUNT(*) AS qtd_seguidores FROM usuario_seguidores WHERE seguindo_id_usuario = $id_usuario ";

	$resultado_id = mysqli_query($link, $sql);

	$qtd_seguidores = 0;

	if ($resultado_id) {
		$registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
		$qtd_seguidores = $registro['qtd_seguidores'];
	}else{
		echo "Erro na execução da consulta...";
	}
?>

<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">

		<title>Twitter clone</title>

		<!-- jquery - link cdn -->
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

		<!-- bootstrap - link cdn -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

		<script type="text/javascript">

			$(document).ready(function(){

				$('#btn_procurar_pessoas').click(function(){

					if($('#nome_pessoa').val().length > 0){

						$.ajax({

							url: 'get_pessoas.php',

							method: 'POST',

							data: $('#form_procurar_pessoas').serialize(),

							success: function(data){
								$('#pessoas').html(data);

								$('.btn_seguir').click( function(){
									var id_usuario = $(this).data('id_usuario');
									$('#btn_seguir_'+id_usuario).hide();
									$('#btn_deixar_seguir_'+id_usuario).show();

									$.ajax({
										url: 'seguir.php',

										method : 'POST',

										data: { seguir_id_usuario: id_usuario},

										success: function(data){
											atualizaInfoUsuario();
										}
									});
								});
								
								$('.btn_deixar_seguir').click( function(){
									var id_usuario = $(this).data('id_usuario');
									$('#btn_seguir_'+id_usuario).show();
									$('#btn_deixar_seguir_'+id_usuario).hide();

									$.ajax({
										url: 'deixar_seguir.php',

										method : 'POST',

										data: { deixar_seguir_id_usuario: id_usuario},

										success: function(data){
											atualizaInfoUsuario();
										}
									});
								});
							}

						});

					}

				});

				function atualizaInfoUsuario(){
					$.ajax({
						url: 'get_n_seguidores_tweets.php',
						method: 'POST',
						data: { info_usuario: 'n_tweets'},
						success: function(data){
							$('#n_tweets').html(data);
						}
					});
					$.ajax({
						url: 'get_n_seguidores_tweets.php',
						method: 'POST',
						data: { info_usuario: 'n_seguidores'},
						success: function(data){
							$('#n_seguidores').html(data);
						}
					});
				}
				atualizaInfoUsuario();

			});

		</script>

	</head>

	<body>

		<!-- Static navbar -->
		<nav class="navbar navbar-default navbar-static-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="#" class="btn"><img src="imagens/icone_twitter.png"/></a>
				</div>

				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="home.php">Home</a></li>
						<li><a href="sair.php">Sair</a></li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</nav>


		<div class="container">
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-body">
						<h4 style="text-align: center"><?= $_SESSION['usuario'] ?></h4>
						<hr />
						<div class="col-md-6">
							<strong> TWEETS </strong><br/>
							<div id="n_tweets" style="text-align: center"></div>
						</div>
						<div class="col-md-6">
							<strong>SEGUIDORES</strong><br/>
							<div id="n_seguidores" style="text-align: center"></div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-body">
						<form id="form_procurar_pessoas" class="input-group">
							<input type="text" id="nome_pessoa" name="nome_pessoa" class="form-control" placeholder="Quem você está procurando?" maxlength="140" />
							<span class="input-group-btn">
								<button class="btn btn-default" id="btn_procurar_pessoas" type="button"><span class="glyphicon glyphicon-search"></span></button>
							</span>
						</form>
					</div>
				</div>

				<div id="pessoas" class="list-group">
					
				</div>
			</div>

			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-body">
					</div>
				</div>
			</div>
		</div>

		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

	</body>
</html>