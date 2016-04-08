<?php	require_once '../model/config.php';

class Core{
	/*
	 * app cont
	 * initial behavior
	 * load all class
	 * construct up de functions and cores
	 */
	public function __construct(){
		spl_autoload_register(array($this, 'loader'));
		$this->loadController();
		$this->loader();
	}
	
	public function loadController($controller = NULL){
		if($controller){
			require_once $controller.'.php';
		}
		else{
			require_once(dirname(__FILE__).'\login.php');
		}
	}
	
	public function loadView($view){
		if(isset($view)){
			require_once '../view/'.$view.'.php';
		}			
	}
	
	public function loadModel($model){
		if(isset($model)){
			require_once '../model/'.$model.'.class.php';
		}
	}
	
	function my_autoload($pClassName) {
        require_once str_replace( '\\', DIRECTORY_SEPARATOR, '../model/'.$class) . '.php';
    }
    public function loader() {
   		spl_autoload_register(function($class_name) {

       	 // Define an array of directories in the order of their priority to iterate through.
        $dirs = array(
           // 'project/', // Project specific classes (+Core Overrides)
            '../model/' // Core classes example
            // Unit test classes, if using PHP-Unit
        );

        // Looping through each directory to load all the class files. It will only require a file once.
        // If it finds the same class in a directory later on, IT WILL IGNORE IT! Because of that require once!
	        foreach( $dirs as $dir ) {
	        	require_once('../model/'.strtolower($class_name).'.class.php');
	            return;
           		
       		}
    	});
    }
	
}

$app = new Core();
?>