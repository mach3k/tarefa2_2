<?php
	// importa o código dos scripts
	require_once 'lib/constantes.php';
	require_once 'lib/database.php';
	require_once 'lib/funcoes.php';

	$titulo_pagina = 'Selecione um produto';
	$tabela = 'produtos';
	
	if (isset($_GET['produto'])) {
		$produto = $_GET['produto'];
	}
	else {
		die("<script type='text/javascript'>
			document.location='URL_BASE';</script>");
	}

	$consulta = "select * from $tabela where id = $produto";
	
	consultar($consulta);
	// declara um vetor de registros para passar para a view (gui)
	$registros = array();
	// percorre o resultset retornado pela consulta extraindo um a um os registros retornados
	while ($registro = proximo_registro())
	{
		// acrescenta o registro ao vetor
		array_push($registros, $registro);
	}
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
			<a href="<?php echo URL_BASE;?>">Início</a>
			<a href='carrinho.php?acao=listar'>Ver Carrinho</a>
			<h1><?php echo $titulo_pagina; ?></h1>
			<table>
				<thead>
					<tr>
						<th>Código</th><th>Nome</th><th>Detalhes</th><th>Preço</th>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach($registros as $registro)
						{
							echo "
								<tr>
									<td>" . $registro['id'] . "</td>
									<td>" . $registro['nome'] . "</td>
									<td>" . $registro['detalhes'] . "</td>
									<td>" . $registro['preco'] . "</td>
								</tr>
							";
						}
					?>
					
				</tbody>
			</table>
			<form method="post" action="<?php echo URL_BASE; ?>carrinho.php">
				<?php echo '<input type="hidden" name="id" value="'. $registro['id'] . '">'; ?>
				<input type="number" min="1" value="1" name="qtde">
				<button type="submit">Comprar</button>
				<button type="button" onclick="javascript:history.go(-1)">Voltar</button>
			</form>		
		</div>
	</body>
</html>