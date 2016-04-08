<?php
	require_once(dirname(dirname(__FILE__)).'/model/functions.class.php');	
	
	if(sessao::expSession()){
		echo 'sessao expirada!.<br>';
	}
	else{
		echo 'A sessão ainda está aberta, aproveite!<br>';
	}
	
	
	echo 'Bem vindo ao dashboard!';
	
	header("refresh:10");
	