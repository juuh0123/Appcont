<?php

require_once(dirname(__FILE__).'/autoload.php'); //não chamo o funcoes.php, chamo o autoload->funcoes
protegeArquivo(basename(__FILE__));//tenho que chamar em todas minhas classes

class sessao{
	protected $id;
	protected $nvars;
	static $limiter = 60;
	static $timeSession;
	
	public function __construct($inicia = true){
		if($inicia == TRUE):
			$this->start();
		endif;		
	}//construtor
	
	public function start(){
		session_cache_limiter(30);
		@session_start();
		$this->id = session_id();
		$this->setNvars();
		$this->setTimePerSession(strtotime(date('H:i:s')));
	}//metodo start
	
	public function setTimePerSession($timeSession){
		self::$timeSession = $timeSession;
	}
	
	public function getTimeSession(){
		return self::$timeSession;
	}
	
	private function setNvars(){
		$this->nvars = sizeof($_SESSION);
	}//metodo setNvars
	
	public function getNvars(){
		return $this->nvars;
	}//metodo getNvars
	
	public function setVar($var, $valor){
		$_SESSION[$var] = $valor;
		$this->setNvars();
	}//metodo setVar
	
	public function unsetVar($var){
		unset($_SESSION[$var]);
		$this->setNvars();
	}//metodo unsetVar
	
	public function getVar($var){
		if(isset($_SESSION[$var])):
			return $_SESSION[$var];
		else:
			return NULL;
		endif;	
	}//metodo getVar
	
	public function destroy($inicia = false){
		session_unset();
		session_destroy();
		$this->setNvars();
		if($inicia == TRUE):
			$this->start();
		endif;		
	}//metodo destroy
	
	static function expSession(){
		$now =  strtotime(date('H:i:s'));
		$second =  $now - self::$timeSession;
		if($second > self::$limiter) {
			return false;
			#sessao utrapassou os 30 minutos
		}
		else{
			return true;
		}
	}
	
	public function printAll(){
		foreach($_SESSION as $k => $v):
			printf("%s = %s<br />", $k, $v);
		endforeach;	
		
	}//metodo printAll
	
}//sessao
?>