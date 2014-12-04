<?php
	function redirecionar($url)
	{
		die("<script type='text/javascript'>
			document.location='$url';</script>");
	}

	function capturar_acao()
	{
		global $acao;

		// se uma ação foi informada na URL
		if (isset($_GET['acao']))
		{
			// captura a ação informada do array superglobal $_GET[]
			$acao = $_GET['acao'];
		}

		// se não foi informada ação
		if(!isset($acao))
		{
			// assume ação padrão (listar)
			$acao = 'listar';
		}
	}

	function carregar_gui($arquivo)
	{
		return "
			require_once(BASE_PATH . 'gui/cabecalho.php');
			require_once(BASE_PATH . 'gui/$arquivo.php');
			require_once(BASE_PATH . 'gui/rodape.php');
		";
	}
?>