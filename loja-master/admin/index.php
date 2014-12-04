<?php
	session_start();

	require_once('../lib/constantes.php');
	require_once('../lib/funcoes.php');
	require_once('../lib/acesso.php');

	verificar_login();
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Loja virtual - Área Administrativa - Início</title>
		<meta charset="utf-8">
		<style type="text/css">
			@import "<?php echo URL_BASE; ?>css/estilos.css";
		</style>
	</head>
	<body>
		<div class="container">
			<a href="../">Site</a>
			<h1>Menu principal</h1>
			<nav>
				<li><a href="<?php echo URL_BASE;?>admin/">Início</a></li>
				<li><a href="<?php echo URL_BASE.'admin/pedidos.php';?>">Pedidos</a></li>
				<li><a href="<?php echo URL_BASE.'admin/produtos.php';?>">Produtos</a></li>
				<li><a href="<?php echo URL_BASE.'admin/departamentos.php'?>">Departamentos</a></li>
				<li><a href="<?php echo URL_BASE.'admin/clientes.php';?>">Clientes</a></li>
				<li><a href="<?php echo URL_BASE.'admin/usuarios.php';?>">Usuários</a></li>
				<li><a href="<?php echo URL_BASE.'admin/login.php?acao=sair';?>">Sair</a></li>
			</nav>
		</div>
	</body>
</html>