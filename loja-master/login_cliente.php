<?php
	
	// importa o código dos scripts
	require_once 'lib/constantes.php';
	require_once 'lib/database.php';
	require_once 'lib/funcoes.php';

	capturar_acao();

	if ($acao == 'autenticar') {

		$email = $_POST['login'];
		$senha = $_POST['senha'];
		
		echo 'Email: ' . $email;
		echo 'Senha: ' . $senha;

		$consulta = "
			select * from clientes where email = '$email'
		";

		consultar($consulta);

		$cliente = proximo_registro();

		if ($cliente) {
			if($senha == $cliente['senha']) {
				$_SESSION['idcliente'] = $cliente['id'];
				$_SESSION['nomecliente'] = $cliente['nome'];

				redirecionar($_SESSION['request_uri']);
			}
			else {
				$erro = 'A senha informanda não confere.';

				require_once(BASE_PATH . 'login_cliente.php');
			}
		}
		else {
			die('O login informado não foi encontrado.');
		}
	}
	
	$titulo_pagina = 'Login de Cliente';
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title><?php echo $titulo_pagina; ?></title>
		<meta charset="utf-8">
		<style type="text/css">
			@import "<?php echo URL_BASE; ?>css/estilos.css";
		</style>
		
	</head>
	<body>
		<div class="container">
			<a href="<?php echo URL_BASE; ?>">Nova Compra</a>
			<h1><?php echo $titulo_pagina; ?></h1>

			<span style="color: red;">
				<?php if(isset($erro)) {
					echo $erro;
				} ?>
			</span>
			<form method="post" action="<?php echo URL_BASE . 'login_cliente.php?acao=autenticar';?>">
				<fieldset>
					<legend>Dados do usuário</legend>
					<div class="form-group">
						<label for="login">E-mail:</label>
						<input type="text" name="login" id="login"
						value="<?php echo isset($login) ? $login : ''; ?>">
					</div>
					<div class="form-group">
						<label for="senha">Senha:</label>
						<input type="password" name="senha" id="senha">
					</div>
					<div class="form-group">
						<button type="submit">Enviar</button>
					</div>
				</fieldset>
			</form>
				
		</div>
	</body>
</html>