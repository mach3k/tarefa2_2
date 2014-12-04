<?php
	session_start();

	$titulo_listagem = 'Listagem de clientes';
	$titulo_incluir = 'Novo cliente';
	$titulo_alterar = 'Alterar cliente';

	$tabela = 'clientes';

	$lista_campos = array('nome', 'email', 'senha');

	require_once '../lib/crud.php';
?>