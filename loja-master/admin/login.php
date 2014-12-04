<?php
	// inicia a seção (SESSION) para ler ou gravar dados
	session_start();

	// importa o código dos scripts
	require_once '../lib/constantes.php';
	require_once '../lib/database.php';
	require_once '../lib/funcoes.php';

	capturar_acao();

	switch($acao) {
		case 'identificar':
			$titulo_pagina = 'Identificação do usuário';

			eval(carregar_gui('form_login'));

			break;
		case 'autenticar':
			$login = $_POST['login'];
			$senha = $_POST['senha'];

			$consulta = "
				select * from usuarios where login = '$login'
			";

			consultar($consulta);

			$usuario = proximo_registro();

			if ($usuario) {
				if($senha == $usuario['senha']) {
					$_SESSION['id_usuario'] = $usuario['id'];
					$_SESSION['nome_usuario'] = $usuario['nome'];
					$_SESSION['email_usuario'] = $usuario['email'];

					redirecionar($_SESSION['request_uri']);
				}
				else {
					$erro = 'A senha informanda não confere.';

					eval(carregar_gui('form_login'));
				}
			}
			else {
				die('O login informado não foi encontrado.');
			}

			break;
		case 'sair':
			session_destroy();

			redirecionar(URL_BASE);

			break;
		default:
			// encerra (mata) o script exibindo mensagem de erro
			die('Erro: Ação inexistente!');
	}