<?php

class db {

	//host
	private $host = 'localhost';
	
	//usuario
	private $usuario = 'root';
	
	//senha
	private $senha = '';
	
	//banco de dados
	private $database = 'twitter_clone';

	public function conecta_mysql(){

		//criar conexao
		$conn = mysqli_connect($this->host, $this->usuario, $this->senha, $this->database);

		//ajustar o charset de comunicação entra a aplicação e o bd
		mysqli_set_charset($conn, 'utf8');

		//verificar erro de conexao
		if(mysqli_connect_errno()){
			echo 'Erro ao tentar se conectar ao Banco de Dados mysql' . mysqli_connect_error();
		}
		return $conn;
	}
}

?>