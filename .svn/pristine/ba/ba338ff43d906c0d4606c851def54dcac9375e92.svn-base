<?php
/**
 * 
 * 接收微信第三方返回接口基类文件
 * @author Administrator
 *
 */
ob_start();
#.装载必须
require_once $_SERVER['DOCUMENT_ROOT'] . '/web-setting.php';
require_once DAOPATH . '/ORMMap.php';
require_once KERNELPATH . '/Result.php';
require_once KERNELPATH . '/ErrorMsgs.php';
require_once KERNELPATH . '/LogMsgs.php';
require_once KERNELPATH . '/FilterService.php';
require_once DAOPATH . '/DTExpression.php';
require_once DAOPATH . '/DTOrder.php';
require_once ABSPATH . '/controller/Controller.php';
class common {
	private $logo = 'hwibs';
	
	#.构造函数
	public function __construct() {
	    session_start();
	    
	    if (DEBUG)  {
	        require_once ABSPATH . '/lib/FirePHPCore/fb.php';
	        require_once ABSPATH . '/lib/FirePHPCore/FirePHP.class.php';
	        $firephp = FirePHP::getInstance(true);
	        $firephp->setEnabled(true); // firephp调试状
	    }
	    
		//if( $this->filter() === false ) {
		//	$this->msgPut(2,'参数提交未通过安全验证.', null);
		//}
        spl_autoload_register(array(
            'common',
            'load'
        ));
	}
	
	#.执行sign检查
	public function signCheck(){
		$sign = $this->posts['sign'];
		$md5  = md5( $this->logo . $this->posts['time'] . $this->posts['domain'] );
		if( $sign != $md5 ) {
			$this->msgPut(1,'加密字符串无法通过验证.', null);
		}
	}
	
	#.自动加载
	public function load($class) {
        if (strpos($class, 'Service') !== false) {
            $file_path = KERNELPATH . $class . '.php';
        } elseif (strpos($class, 'DAO') !== false) {
            $file_path = DAOPATH . $class . '.php';
        } elseif (strpos($class, 'Model_') !== false) {
            $file_path = false;
        } elseif (strpos($class, 'Smarty') !== false) {
            $file_path = strtolower(ABSPATH . '/lib/smarty/sysplugins/' . $class . '.php');
        } elseif (strpos($class, 'Tag') !== false && $class == 'Tag') {
            $file_path = ENTITYPATH . $class . '.php';
        } elseif (strpos($class, 'Tag') !== false) {
            $file_path = ABSPATH . '/tagobj/' . $class . '.php';
        } elseif (strpos($class, 'Exception')) {
            $file_path = KERNELPATH . '/exception/' . $class . '.php';
        } else {
            $file_path = ENTITYPATH . $class . '.php';
        }
        if ($file_path) {
            if (file_exists($file_path)) {
                require_once $file_path;
            } else {
                exit($file_path . '文件不存在!');
            }
        }
	} 
	
	#.绑定实体参数
	public function bind($entity) {
	    foreach ($entity as $key => $value) {
            if (isset($_REQUEST[$key])) {
                $entity->$key = $_REQUEST[$key];
            }
        }
	}
	
	#.执行信息输出
	public function msgPut($status,$msg,$data){
		die( json_encode( array('status'=>$status,'msg'=>$msg,'data'=>$data) ) );
	}
	
	#.执行参数提交安全检查
    public function filter() {
        $getfilter    = "'|<[^>]*?>|^\\+\/v(8|9)|\\b(and|or)\\b.+?(>|<|=|\\bin\\b|\\blike\\b)|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
        $postfilter   = "^\\+\/v(8|9)|\\b(and|or)\\b.{1,6}?(=|>|<|\\bin\\b|\\blike\\b)|\\/\\*.+?\\*\\/|<\\s*script\\b|<\\s*img\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
        $cookiefilter = "\\b(and|or)\\b.{1,6}?(=|>|<|\\bin\\b|\\blike\\b)|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
        foreach ($_GET as $key => $value) {
            if (! $this->stopAttack($key, $value, $getfilter)) {
                return false;
            }
        }
        foreach ($_POST as $key => $value) {
            if (! $this->stopAttack($key, $value, $postfilter)) {
                return false;
            }
        }
        foreach ($_COOKIE as $key => $value) {
            if (! $this->stopAttack($key, $value, $cookiefilter)) {
                return false;
            }
        }
        return true;
    }
    private function stopAttack($StrFiltKey, $StrFiltValue, $ArrFiltReq) {
        $StrFiltValue = $this->arrForeach($StrFiltValue);
        if (preg_match("/" . $ArrFiltReq . "/is", $StrFiltValue) == 1) {
            return false;
        }
        if (preg_match("/" . $ArrFiltReq . "/is", $StrFiltKey) == 1) {
            return false;
        }
        return true;
    }
    private function arrForeach($arr) {
        static $str;
        if (! is_array($arr)) {
            return $arr;
        }
        foreach ($arr as $key => $val) {
            if (is_array($val)) {
                $this->arr_foreach($val);
            } else {
                $str[] = $val;
            }
        }
        return implode($str);
    }
}