<?php
	require_once 'constantes.php';
	/**
	* Funções para manipulação de banco de dados MySQL
	* Obs: as funções usadas neste exemplo, são consideradas depreciadas.
	* Para desenvolvimento de aplicação real, deveriam ser usadas outras
	* opções de manipulação de banco de dados do PHP (extensão MySQLi ou PDO,
	* por exemplo).
	* O objetivo do uso das funções desatualizadas é manter a simplicidade
	* do código, sem envolver conceitos de Orientação a Objetos.
	*/


	// variável para manter o resultado de consultas realizadas
	$result = null;

	// extabelece a conexão com o servidor MySQL e mantém o ponteiro da conexão na variável $conn
	$conn = mysql_connect(HOST, USER, PASSWORD);

	// se $conn = FALSE, significa que não foi possível conectar
	if (!$conn)
	{
		// encerra (mata) o script com a mensagem de erro
		die('Erro: Não foi possível conectar ao servidor MySQL.');
	}

	// se não for possível selecionar a base de dados
	if(!mysql_select_db(DB))
	{
		// encerra (mata) o script com a mensagem de erro
		die('Erro: Não foi possível selecionar a base de dados ' . DB);
	}

	// função para executar uma consulta SQL
	function consultar($sql)
	{
		global $conn, $result;
		// mantém o resultado da consulta na variável $result
		$result = mysql_query($sql,$conn);

		if (!$result)
		{
			die('Erro: Problema ao executar a consulta:<br><p><code>' . $sql . '</code></p><br>'.mysql_error());
		}
	}

	// função para extrair um registro do resultado retornado pela consulta
	function proximo_registro()
	{
		global $result;
		// retorna um array associativo, com o índice do elemento sendo o nome do campo e o valor do elemento, o valor do campo retornado
		return mysql_fetch_assoc($result);
	}

	// função para retornar o número de linhas afetadas por uma consulta SQL (INSERT, UPDATE ou DELETE)
	function linhas_afetadas()
	{
		global $conn;

		return mysql_affected_rows($conn);
	}