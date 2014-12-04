<?php
	session_start();

	function montaListaDeptos($id='')
	{
		// recupera departamentos
		$consulta = "
			select * from departamentos
			order by nome
		";

		consultar($consulta);

		$lista_deptos = '';

		while($registro = proximo_registro())
		{
			$lista_deptos .= '<option value="' .
				$registro['id'] .
				( $id == $registro['id'] ? ' selected="selected"' : '') .
				'">' . $registro['nome'] . '</option>';
		}

		return $lista_deptos;
	}

	$titulo_listagem = 'Listagem de produtos';
	$titulo_incluir = 'Novo produto';
	$titulo_alterar = 'Alterar produto';

	$tabela = 'produtos';

	$lista_campos = array('nome', 'id_departamento', 'detalhes', 'preco');

	$consulta_listagem = '
		select p.id, p.nome as nome_produto, d.nome as nome_departamento, p.preco
				from produtos p, departamentos d
				where d.id = p.id_departamento
				order by nome_produto
	';

	$relacionamentos = array( 0 => array('variavel_lista_options' => 'lista_deptos',
		'funcao_monta_lista' => 'montaListaDeptos', 'variavel_seleciona_option' => 'id_departamento'));

	require_once '../lib/crud.php';

	?>