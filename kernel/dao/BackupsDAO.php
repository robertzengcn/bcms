<?php

/**
 * 文件恢复备份
 *
 * @author Administrator
 *
 */
class BackupsDAO extends DBBaseDAO {

    public function __construct() {
      //  parent::__construct();
    	$con = @mysql_connect( DBHOST , DBUSER , DBPASSWORD );
    	if( ! $con ) {
    		$this->Install_Msg(false,'数据库链接失败,请检查你填写的数据库信息配置');
    	}
    	if( ! @mysql_select_db( DBNAME  ) ) {
    		$this->Install_Msg(false,'数据库链接失败,请检查你的数据库"'.DBNAME.'"是否已创建.');
    	}
    	@mysql_query('SET NAMES UTF8');
    }
    
    public function __destruct(){
    	mysql_close();
    }
    		
   
    /*
     * 备份
     */
    public function backups(){
    	$q1 = mysql_query("show tables");
    	$mysql = '';
    	$mysql .= "CREATE DATABASE /*!32312 IF NOT EXISTS*/ `".DBNAME."` /*!40100 DEFAULT CHARACTER SET utf8 */;-\r\n";
        $mysql .= "use `".DBNAME."`;-\r\n";
        $mysql .= "SET FOREIGN_KEY_CHECKS=0;-\r\n";
	    while ($t = mysql_fetch_array($q1)){   
		    $table = $t[0];
		    $q2 = mysql_query("show create table `$table`");
		    $sql = mysql_fetch_array($q2);
		    $mysql .= "DROP TABLE IF EXISTS `$table`;-\r\n";
		    $mysql .= $sql['Create Table'] . ";-\r\n";
		    $q3 = mysql_query("select * from `$table`");
		    while ($data = mysql_fetch_assoc($q3)){
		        $keys = array_keys($data);
		        $keys = array_map('addslashes', $keys);
		        $keys = join('`,`', $keys);
		        $keys = "`" . $keys . "`";
		        $vals = array_values($data);
		        $vals = array_map('addslashes', $vals);
		        $vals = join("','", $vals);
		        $vals = "'" . $vals . "'";
		        $mysql .= "insert into `$table`($keys) values($vals);-\r\n\r\n";
		    } 
		} 
    	return $mysql;
    }
    
    /*
     * 还原
     */
    public function restore($sql,$times){
    	//$sql = file_get_contents($file);
    	$str = explode(";-\r\n",$sql);
    	$meg = array();
    	//print_r($str) ;exit();
    	$length = count($str) - 1;
    	if(empty($times)){
    		if($length < 500){
    			for($i=0; $i<$length; $i++){
    				if(mysql_query($str[$i])){
    					$meg['times'] = "success";
    				}else{
    					$meg['error'] = mysql_error();
    					break;
    				}
    			}
    		}else{
    			for($i=0; $i<500; $i++){
    				if(mysql_query($str[$i])){
    					$meg['times'] = $i + 1;
    				}else{
    					$meg['error'] = mysql_error();
    					break;
    				}
    			}
    		}
    	}else{
    		mysql_query("SET FOREIGN_KEY_CHECKS=0");
    		mysql_query("use `".DBNAME."`");
    		$i = $times + 500;
    		if($length < $i){
    			for($times; $times<$length; $times++){
    				if(mysql_query($str[$times])){
    					$meg['times'] = "success";
    				}else{
    					$meg['error'] .= mysql_error();
    					break;
    				}
    			}
    		}else{
    			for($times; $times<$i; $times++){
    				if(mysql_query($str[$times])){
    					$meg['times'] = $times + 1;
    				}else{
    					$meg['error'] .= mysql_error();
    					break;
    				}
    			}
    		}
    	}
    	fclose($file);
    	return $meg;
    }
}










