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
			<h1><?php echo $titulo_pagina; ?></h1>
			<form method="post" action="<?php echo URL_BASE; ?>admin/clientes.php?acao=gravar">
				<?php
					// se há um id definido (se é uma alteração)
					if (isset($id))
					{
						echo '<input type="hidden" name="id" value="'. $id . '">';
					}
				?>
				<fieldset>
					<legend>Dados do cliente</legend>
					<div class="form-group">
						<label for="nome">Nome:</label>
						<input type="text" name="nome" id="nome" value="<?=isset($nome) ? $nome : ''; ?>">
					</div>
					<div class="form-group">
						<label for="email">e-mail:</label>
						<input type="text" name="email" id="email" value="<?=isset($email) ? $email : ''; ?>">
					</div>
					<div class="form-group">
						<label for="senha">Senha:</label>
						<input type="password" name="senha" id="senha">
					</div>
					<div class="form-group">
						<label for="confirma_senha">Confirmação da senha:</label>
						<input type="password" name="confirma_senha" id="confirma_senha">
					</div>
				</fieldset>
				<div class="form-group">
					<button type="submit">Gravar</button><button type="button" onclick="document.location='<?=URL_BASE;?>admin/clientes.php';">Voltar</button>
				</div>
			</form>
		</div>
	</body>
</html>