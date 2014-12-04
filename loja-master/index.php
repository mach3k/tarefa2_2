<?php
	// importa o código dos scripts
	require_once 'lib/constantes.php';
	require_once 'lib/database.php';
	require_once 'lib/funcoes.php';

	$titulo_pagina = 'Loja Virtual';
	$tabela = 'departamentos';

	$consulta = "select * from $tabela order by nome";
	
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
			<a href="admin/">Área Administrativa</a>
			<a href='carrinho.php?acao=listar'>Ver Carrinho</a>
			<h1><?php echo $titulo_pagina; ?></h1>
			<table>
				<thead>
					<tr>
						<th>Código</th><th>Nome</th>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach($registros as $registro)
						{
							echo "
								<tr>
									<td>" . $registro['id'] . "</td>
									<td><a href='" . URL_BASE . 'produtos.php?depto=' . $registro['id'] . "'>" . $registro['nome'] . "</td>
								</tr>
							";
						}
					?>
				</tbody>
			</table>
		</div>
	</body>
</html>