<?php
	session_start();
	if(!isset($_SESSION['usuario'])){
		header('Location: index.php?erro=1');
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

				atualizaInfoUsuario();
				atualizaTweet();

				$('#btn_tweet').click(function(){
					if($('#texto_tweet').val().length > 0){
						$.ajax({

							url: 'incluir_tweet.php',

							method: 'POST',

							data: $('#form_tweet').serialize(),

							success: function(data){
								$('#texto_tweet').val('');
								atualizaInfoUsuario();
								atualizaTweet();
							}

						});

					}

				});


				function atualizaTweet(){
					//carregar os tweets

					$.ajax({
						url: 'get_tweet.php',
						success: function(data){
							$('#tweets').html(data);

							$('.btn_deletar_tweet').click( function(){
								var id_tweet = $(this).data('deletar_tweet_id');
								if(!(id_tweet == 0 || id_tweet == '')){
									$.ajax({
										url: 'deletar_tweet.php',

										method : 'POST',

										data: { deletar_tweet_id: id_tweet},

										success: function(data){
											atualizaInfoUsuario();
											atualizaTweet();
										}
									});
								}
								

							});

						}
					});
				}

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
						<form id="form_tweet" class="input-group">
							<input type="text" id="texto_tweet" name="texto_tweet" class="form-control" placeholder="O que está acontecendo agora?" maxlength="140" />
							<span class="input-group-btn">
								<button class="btn btn-default" id="btn_tweet" type="button">Tweet</button>
							</span>
						</form>
					</div>
				</div>

				<div id="tweets" class="list-group">
					
				</div>
			</div>

			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-body">
						<h4><a href="procurar_pessoas.php">Procurar por pessoas</a></h4>
					</div>
				</div>
			</div>
		</div>

		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

	</body>
</html>