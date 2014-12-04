<?php
	// importa o código dos scripts
	require_once '../lib/constantes.php';
	require_once '../lib/database.php';
	require_once '../lib/funcoes.php';
	require_once '../lib/acesso.php';

	function extrai_variaveis_registro($lista)
	{
		// indica que irá ler a variável externa à função
		global $registro;

		foreach($lista as $variavel) {
			global ${$variavel};
			${$variavel} = $registro[$variavel];
		}
	}

	function captura_dados_formulario($lista)
	{
		foreach($lista as $variavel) {
			global ${$variavel};
			${$variavel} = $_POST[$variavel];
		}
	}

	function monta_consulta_insert($tabela, $lista)
	{
		$consulta = 'insert into ' . $tabela . ' (';

		$values = '';

		foreach($lista as $variavel) {
			global ${$variavel};

			$consulta .= $variavel .',';
			$values .= "'${$variavel}',";
		}

		// remove o último ',' adicionado às strings
		$consulta = substr($consulta, 0, strlen($consulta) - 1);
		$values = substr($values, 0, strlen($values) - 1);

		$consulta .= ') values (' . $values . ')';

		return $consulta;
	}

	function monta_consulta_update($tabela, $lista)
	{
		$consulta = 'update ' . $tabela . ' set ';

		foreach($lista as $variavel) {
			global ${$variavel};

			$consulta .= $variavel . ' = ' . "'${$variavel}',";
		}

		// remove o último ',' adicionado à string
		$consulta = substr($consulta, 0, strlen($consulta) - 1);

		$consulta .= ' where id = ' . $_POST['id'];

		return $consulta;
	}

	verificar_login();

	capturar_acao();

	switch($acao)
	{
		case 'listar':
			if(isset($consulta_listagem)) {
				$consulta = $consulta_listagem;
			}
			else {
				$consulta = "select * from $tabela order by nome";
			}

			// executa a consulta sql
			consultar($consulta);
			// declara um vetor de registros para passar para a view (gui)
			$registros = array();
			// percorre o resultset retornado pela consulta extraindo um a um os registros retornados
			while ($registro = proximo_registro())
			{
				// acrescenta o registro ao vetor
				array_push($registros, $registro);
			}
			// define o título da página
			$titulo_pagina = $titulo_listagem;

			// carrega o arquivo com a listagem de usuários (gui)
			eval(carregar_gui("lista_$tabela"));
			break;
		case 'incluir':
			$titulo_pagina = $titulo_incluir;

			if(isset($relacionamentos))
				foreach($relacionamentos as $relacionamento) {
					${$relacionamento['variavel_lista_options']} = call_user_func($relacionamento['funcao_monta_lista']);
				}

			// carrega arquivo com o formulário para incluir novo usuário
			eval(carregar_gui("form_$tabela"));
			// interrompe o switch...case
			break;
		case 'alterar':
			// se não informou id na URL
			if (!isset($_GET['id']))
			{
				// encerra (mata) o script com mensagem de erro
				die('Erro: O código do registro a alterar não foi
				 informado.');
			}

			// captura o id passado na URL
			$id = $_GET['id'];
			// monta consulta SQL para recuperar os dados do usuário a ser alterado
			$consulta = "select * from $tabela where id = $id";
			// executa a consulta
			consultar($consulta);
			// captura o registro retornado pela consulta
			$registro = proximo_registro();

			extrai_variaveis_registro($lista_campos);

			if(isset($relacionamentos))
				foreach($relacionamentos as $relacionamento) {
					${$relacionamento['variavel_lista_options']} = call_user_func($relacionamento['funcao_monta_lista'], ${$relacionamento['variavel_seleciona_option']});
				}

			// define o título da página
			$titulo_pagina = $titulo_alterar;
			// carrega o formulário para alterar o usuário
			eval(carregar_gui("form_$tabela"));
			break;
		case 'gravar':
			//capturar dados do formulário
			captura_dados_formulario($lista_campos);

			if (!isset($_POST['id']))
			{
			// monta consulta sql para realização a inserção
				$consulta = monta_consulta_insert($tabela, $lista_campos);

				$msg_erro = 'Não foi possível inserir.';
			}
			else
			{
				$consulta = monta_consulta_update($tabela, $lista_campos);

				$msg_erro = 'Não foi possível alterar.';
			}
			// executa a consulta
			consultar($consulta);
			// verifica se a operação foi bem sucedida
			if(linhas_afetadas() > 0)
			{
				// redireciona para a listagem de usuários
				header('location:' . URL_BASE .
					"$tabela.php?acao=listar");
				// finaliza a execução do script
				exit;
			}
			else {
				// exibe mensagem de erro
				echo 'Erro: ' . $msg_erro;
				// finaliza a execução do script
				exit;
			}
			break;
		case 'excluir':
			// se não informou id na URL
			if (!isset($_GET['id']))
			{
				// encerra (mata) o script com mensagem de erro
				die('Erro: O código do registro a excluir não foi
					informado.');
			}

			// captura o id passado na URL
			$id = $_GET['id'];
			// monta consulta SQL para excluir usuário
			$consulta = "delete from $tabela where id = $id";
			// executa a consulta
			consultar($consulta);
			// verifica se a exclusão foi bem sucedida
			if(linhas_afetadas() > 0)
			{
				// redireciona para a listagem de usuários
				header('location:' . URL_BASE .
					"$tabela.php?acao=listar");
				// encerra a execução do script
				exit;
			}
			else {
				// exibe mensagem de erro
				echo "Erro: Não foi possível excluir.";
				exit;
			}
			break;
		default:
			// encerra (mata) o script exibindo mensagem de erro
			die('Erro: Ação inexistente!');
	} // fim do switch...case

?>