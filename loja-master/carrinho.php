<?php
	
	session_start();

	if (!isset($_SESSION['carrinho'])){
		$_SESSION['carrinho'] = array();
	}

	if (!isset($_GET['acao'])){
		$acao = 'comprar';
		$id = intval($_POST['id']);
		$quant = intval($_POST['qtde']);

		if (!isset($_SESSION['carrinho'][$id])){
			$_SESSION['carrinho'][$id]  = $quant;
		}else{
			$_SESSION['carrinho'][$id] += $quant;
		}
	}elseif ($_GET['acao'] == 'remover') {
		$id = $_GET['id'];
		unset($_SESSION['carrinho'][$id]);
	}elseif ($_GET['acao'] == 'listar') {
		
	}

	// importa o código dos scripts
	require_once 'lib/constantes.php';
	require_once 'lib/database.php';
	require_once 'lib/funcoes.php';

	$titulo_pagina = 'Carrinho de Compras';
	$tabela = 'produtos';
	
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
			<a href="<?php echo URL_BASE; ?>">Continuar Comprando</a>
			<h1><?php echo $titulo_pagina; ?></h1>
			<table>
				<thead>
					<tr>
						<th>Nome</th><th>Detalhes</th><th>Preço</th><th>Quantidade</th><th>Subtotal</th><th>&nbsp;</th>
					</tr>
				</thead>

				<tbody>


					<?php

						if(count($_SESSION['carrinho']) == 0){
							echo '<td colspan="6">Seu carrinho está vazio</td>';
						}
						else{
							foreach ($_SESSION['carrinho'] as $id => $quant) {
								$consulta = "select * from produtos where id = $id";
								consultar($consulta);
								// declara um vetor de registros para passar para a view (gui)
								$registro = mysql_fetch_assoc($result);
								
								echo "
									<tr>
										<td><a href='" . URL_BASE . 'detalheproduto.php?produto=' . $registro['id'] . "'>" . $registro['nome'] . "</a></td>
										<td>" . $registro['detalhes'] . "</td>
										<td> R$ " . number_format($registro['preco'],2,',','.') . "</td>
										<td>" . $quant . "</td>
										<td> R$ " . number_format($registro['preco'] * $quant,2,',','.') . "</td>
										<td><a href='?acao=remover&id=". $id. "'>Remover</a></td>
									</tr>
								";
								$total += $registro['preco'] * $quant;
							}
							echo "<td colspan='6'>Total de suas compras: R$ " . number_format($total,2,',','.') . "</td>";
						}
					?>
					
					
				</tbody>
				<form method="post" action="<?php echo URL_BASE; ?>finalizarpedido.php">
					<tfoot>
						<?php
							if(count($_SESSION['carrinho']) > 0){
								echo '<tr><td colspan="6"><button type="submit">Finalizar Compra</button></td></tr>';
							}
						?>
					</tfoot>
				</form>
			</table>
		</div>
	</body>
</html>