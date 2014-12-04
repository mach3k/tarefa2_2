<?php
	function verificar_login()
	{
		// se há um código de usuário logado na SESSION
		if(isset($_SESSION['id_usuario'])) {
			return TRUE;
		}
		else {
			// armazena na session a URI onde a função foi chamada para redirecionar após o login efetuado
			$_SESSION['request_uri'] = $_SERVER['REQUEST_URI'];

			/* redireciona para o script de login
				não foi usada a função header("location: ----"); porque quando usamos a função session_start()
				já são enviados cabeçalhos HTTP para o navegador e isto resultaria em erro.
			*/
			//redireciona(URL_BASE . 'login.php?acao=identificar');
				header("location:" . URL_BASE .
					'admin/login.php?acao=identificar');
		}
	}

	function get_dados_usuario_logado()
	{
		// se não há um usuário logado
		if(!isset($_SESSION['id_usuario'])) {
			return FALSE;
		}

		// monta um vetor com os dados do usuário logado que estão armazenados na SESSION
		$dados = array();
		$dados['id_usuario'] = $_SESSION['id_usuario'];
		$dados['nome_usuario'] = $_SESSION['nome_usuario'];
		$dados['email_usuario'] = $_SESSION['email_usuario'];

		return $dados;
	}