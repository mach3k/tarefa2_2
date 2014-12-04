<?php
	session_start();

	$titulo_listagem = 'Listagem de departamentos';
	$titulo_incluir = 'Novo departamento';
	$titulo_alterar = 'Alterar departamento';

	$tabela = 'departamentos';

	$lista_campos = array('nome');

	require_once '../lib/crud.php';
?>