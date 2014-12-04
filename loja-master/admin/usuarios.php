<?php
	session_start();

	$titulo_listagem = 'Listagem de usuários';
	$titulo_incluir = 'Novo usuário';
	$titulo_alterar = 'Alterar usuário';

	$tabela = 'usuarios';

	$lista_campos = array('nome', 'email', 'login', 'senha');

	require_once '../lib/crud.php';
?>