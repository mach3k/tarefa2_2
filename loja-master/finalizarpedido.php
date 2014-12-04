<?php

	/*session_start()*/

	echo 'iniciou sessao';

	if (!isset($_SESSION['idcliente'])) {
		$_SESSION['request_uri'] = $_SERVER['REQUEST_URI'];

		header("location:login_cliente.php");
		/*$idcliente = 1;*/
	}
	else{
		$idcliente = $_SESSION['idcliente'];
	}
	
	// importa o código dos scripts
	require_once 'lib/constantes.php';
	require_once 'lib/database.php';
	require_once 'lib/funcoes.php';

	$titulo_pagina = 'Compra Finalizada';

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

			<?php

				if(count($_SESSION['carrinho']) > 0){
					echo '<td colspan="6">Seu carrinho está vazio</td>';
				}
				else{
					/*$data = date('d/m/y');*/
					$data = date('d/m/y H:i:s');
					
					echo 'definiu data <br/>';
					echo 'data: ' . $data;

					$consulta = "insert into pedidos ('registrado_em','situacao','id_cliente','valor_desconto') 
								values (" . $data . ",1," . $idcliente . ",0)";
					consultar($consulta);

					echo 'inseriu pedido';

					$consulta = "select id from pedidos where registrado_em = " . $data;
					consultar($consulta);
					foreach ($_SESSION['carrinho'] as $id => $quant) {
						$consulta = "select * from produtos where id = $id";
						consultar($consulta);
						// declara um vetor de registros para passar para a view (gui)
						$registro = mysql_fetch_assoc($result);

					$registro = mysql_fetch_assoc($result);
					$idpedido = $registro['id'];

						$consulta = "insert into itens_pedido ('id_pedido','id_produto','quantidade','preco') 
								values (" . $idpedido . "," . $id . "," . $quant . "," . $registro['preco'] . ")";
						consultar($consulta);
					}
						
						echo 'Pedido recebido com sucesso';

				}
			?>
				
		</div>
	</body>
</html>