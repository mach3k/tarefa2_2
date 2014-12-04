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
			<form method="post"
			action="<?php echo URL_BASE; ?>admin/produtos.php?acao=gravar">
				<?php
					// se há um id definido (se é uma alteração)
					if (isset($id))
					{
						echo '<input type="hidden" name="id" value="'. $id . '">';
					}
				?>
				<fieldset>
					<legend>Dados do produto</legend>
					<div class="form-group">
						<label for="nome">Nome:</label>
						<input type="text" name="nome" id="nome" value="<?=isset($nome) ? $nome : ''; ?>">
					</div>
					<div class="form-group">
						<label for="id_departamento">Departamento:</label>
						<select name="id_departamento"
						 id="id_departamento">
							<?php
								echo $lista_deptos;
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="detalhes">Detalhes:</label>
						<textarea name="detalhes" id="detalhes"
							rows="4" cols="40"><?php if(isset($detalhes)) {echo $detalhes;} ?></textarea>
					</div>
					<div class="form-group">
						<label for="preco">Preço:</label>
						<input type="text" name="preco"
						id="preco" value="<?=isset($preco) ? $preco : ''; ?>">
					</div>
				</fieldset>
				<div class="form-group">
					<button type="submit">Gravar</button>
					<button type="button"
					onclick="document.location='<?=URL_BASE;?>admin/produtos.php';">Voltar</button>
				</div>
			</form>
		</div>
	</body>
</html>