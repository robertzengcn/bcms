<?php
class analyze {
	public $xml_name           = 'setting.xml';
	public $ver_name           = 'version.txt';
	public $front_stencil_url  = '';//被切换的模版路径
	public $behind_stencil_url = '';//切换后的模版路径
	public $front_stencil_xml  = '';//被切换的模版资源配置文件
	public $behind_stencil_xml = '';//切换后的模版资源配置文件
	public $front_stencil_xml_content  = null;//被切换的模版资源配置文件内容
	public $behind_stencil_xml_content = null;//切换后的模版资源配置文件内容
	public $connect_db                 = null;//数据库链接句柄
	//构造函数(参数1.2由子方法传递)
	public function __construct($front_stencil_url,$behind_stencil_url){
		require_once '../web-setting.php';//引入配置文件
		$this->front_stencil_url  = $front_stencil_url;
		$this->behind_stencil_url = $behind_stencil_url;
		$this->check_stencil_url();//模版路径检测
		$this->connect_db();//数据库链接
		$this->front_clear();//进行被切换模版工作
		$this->behind_ini();//进行切换后的模版工作
	}
	//错误输出函数
	final public function set_error_msg($msg){
		@session_start();
		if( isset( $_SESSION['is_java_install'] ) && $_SESSION['is_java_install'] == 'true' ){
			return json_encode( array('statu'=>false,'code'=>0,'msg'=>$msg,'data'=>null) );
		}
		die(json_encode( array('statu'=>false,'code'=>0,'msg'=>$msg,'data'=>null) ) );
	}
	//模版路径检测函数
	final public function check_stencil_url(){
	    //模版配置文件格式有变动，故需特殊处理，使兼容之前的配置，以防止出现无法卸载的故障
		if( $this->front_stencil_url != '' ){
			if( ! is_dir( $this->front_stencil_url ) ){
				$this->set_error_msg('被切换后的模版路径不正确.');
			}else{
				$this->front_stencil_xml = $this->front_stencil_url . '/resource/' . $this->xml_name;
				if( ! file_exists( $this->front_stencil_xml ) ){
				    $this->xml_name = 'setting.csv';
				    $this->front_stencil_xml = $this->front_stencil_url . '/resource/' . $this->xml_name;
				}
				if( ! file_exists( $this->front_stencil_xml ) ){
					$this->set_error_msg('被切换后的模版配置文件不存在.');
				}
				if( ! $this->check_version( $this->front_stencil_url . '/resource/' . $this->ver_name ) ){
					$this->set_error_msg('系统不支持此模版初始化,请下载最新的模版后重试');
				}
				if ($this->xml_name == 'setting.xml') {
				    $this->analyze_xml($this->front_stencil_xml,'front');
				} else {
				    //修改为解析csv文件
				    $this->analyze_csv($this->front_stencil_xml, 'front');
				}
			}
		}
		if( ! is_dir( $this->behind_stencil_url ) ){
			$this->set_error_msg('切换后的模版路径不正确.');
		}else{
		    $this->xml_name = 'setting.xml';
			$this->behind_stencil_xml = $this->behind_stencil_url . '/resource/' . $this->xml_name;
			if( ! file_exists( $this->behind_stencil_xml ) ){
			    $this->xml_name = 'setting.csv';
			    $this->behind_stencil_xml = $this->behind_stencil_url . '/resource/' . $this->xml_name;
			}
			if( ! file_exists( $this->behind_stencil_xml ) ){
				$this->set_error_msg('切换后的模版配置文件不存在.');
			}
			if( ! $this->check_version( $this->behind_stencil_url . '/resource/' . $this->ver_name ) ){
				$this->set_error_msg('系统不支持此模版初始化,请下载最新的模版后重试');
			}
		    if ($this->xml_name == 'setting.xml') {
			    $this->analyze_xml($this->behind_stencil_xml,'behind');
			} else {
			    //修改为解析csv文件
			    $this->analyze_csv($this->behind_stencil_xml, 'behind');
			}
		}
	}
	//版本检测
	final private function check_version( $version_file ){
		if( ! file_exists( $version_file ) ){
			return false;
		}
		$sys_version = file_exists( GENERATEPATH.'lib/sys_version.txt' ) ? file_get_contents( GENERATEPATH.'lib/sys_version.txt' ) : '1.0.0';
		$sys_version = (int)str_replace('.','', $sys_version);
		$ana_version = (int)str_replace('.','', file_get_contents( $version_file ));
		if( $ana_version < $sys_version ){
			return false;
		}
		return true;
	}
	//数据库链接
	final public function connect_db(){
		$this->connect_db = @mysql_connect( DBHOST , DBUSER , DBPASSWORD );
		@mysql_select_db( DBNAME , $this->connect_db );
		@mysql_query("SET NAMES UTF8",$this->connect_db);
	}
	//模版资源配置文件解析功能
	final public function analyze_xml($xml_url,$stencil){
		$xml_content = simplexml_load_string( file_get_contents( $xml_url ) );
		if( ! is_object( $xml_content ) ) {
			$this->set_error_msg('初始化资源配置文件读取失败.');
			return false;
		}
		switch ( $stencil ){
			case 'front' :$this->front_stencil_xml_content  = json_decode( json_encode( $xml_content ) , true );break;
			case 'behind':$this->behind_stencil_xml_content = json_decode( json_encode( $xml_content ) , true );break;
		}
		return true;
	}
	//执行文件操作[删除、移动]
	final public function file_analyze($xml_content,$operate,$resource_url){
		if( ! isset( $xml_content['File']['item'] ) ){return false;}
		$file_arrays = $xml_content['File']['item'];
		if( isset( $file_arrays[0] ) && is_array( $file_arrays[0] ) ){
			foreach ( $file_arrays as $key => $value ){
				$source_file  = $resource_url . $value['source'];
				$whither_file = ABSPATH . $value['whither'];
				switch ( $operate ){
					case 'delete':
						@unlink( $whither_file );
						break;
					case 'move':
						!file_exists($source_file) ? false : copy($source_file,$whither_file);
						break;
				}
			}
		}else{
			$source_file  = $resource_url . $file_arrays['source'];
			$whither_file = ABSPATH . $file_arrays['whither'];
			switch ( $operate ){
				case 'delete':
					@unlink( $whither_file );
					break;
				case 'move':
					!file_exists($source_file) ? false : copy($source_file,$whither_file);
					break;
			}
		}
	}
	//执行数据删除操作
	final public function delete_analyze($xml_content){
		if( isset( $xml_content['Delete']['item'] ) ){
			$delete_arrays = $xml_content['Delete']['item'];
			if( is_array( $delete_arrays ) ){
				foreach ( $delete_arrays as $key => $value ){
					$this->delete_preg_info( $value );
				}
			}else{
				$this->delete_preg_info( $delete_arrays );
			}
		}
		if( isset( $xml_content['Delete']['item_t'] ) ){
			$delete_arrays = $xml_content['Delete']['item_t'];
			if( is_array( $delete_arrays ) ){
				foreach ( $delete_arrays as $key => $value ){
					$this->mysql_query( $value );
				}
			}else{
				$this->mysql_query( $delete_arrays );
			}
		}
	}
	private function delete_preg_info( $delete_preg ){
		$delete_preg   = mb_substr($delete_preg,1,mb_strlen($delete_preg));
		$delete_preg   = mb_substr($delete_preg,0,mb_strlen($delete_preg)-1);
		$delete_arrays = explode(',', $delete_preg);
		foreach ( $delete_arrays as $k => $v ){
			$v_imp = explode(':', $v);
			if( $v_imp[0] == 't' ){$table_name = $v_imp[1];}
			if( $v_imp[0] == 'f' ){$field_name = $v_imp[1];}
			if( $v_imp[0] == 'v' ){
				preg_match_all('#[\"\'](.*)[\"\']#iUs', $v_imp[1],$v_preg_all);
				if( count( $v_preg_all[1] ) >= 1 ){
					foreach ( $v_preg_all[1] as $k1 => $v1 ){
						$sql = "DELETE FROM `".$table_name."` WHERE `".$field_name."`='".$v1."';";
						$this->mysql_query( $sql );
					}
				}
			}
		}
	}
	//执行insert数据写入语句
	final public function insert_analyze($xml_content){
		if( ! isset( $xml_content['Insert']['item'] ) ){return false;}
		$insert_arrays = $xml_content['Insert']['item'];
		if( is_array( $insert_arrays ) ){
			foreach ( $insert_arrays as $key => $value ){
				$this->mysql_query($value);
			}
		}else{
			$this->mysql_query($insert_arrays);
		}
	}
	//执行取父值，赋子值操作
	final public function parent_analyze($xml_content){
		if( ! isset( $xml_content['Parent']['item'] ) ){return false;}
		$parent_arrays = $xml_content['Parent']['item'];
		if( isset( $parent_arrays[0] ) && is_array( $parent_arrays[0] ) ){
			foreach ( $parent_arrays as $key => $value ){
				if( isset( $value['get'] ) && isset( $value['set'] ) ){
					$this->parent_preg_info( $value['get'],$value['set'] );
				}
				//是否存在新版补充赋子值语句
				if( isset( $value['get_t'] ) && isset( $value['set_t'] ) ){
					$this->parent_tins_info( $value['get_t'] , $value['set_t'] );
				}
			}
		}else{
			$this->parent_preg_info( $parent_arrays['get'],$parent_arrays['set'] );
		}
	}
	private function parent_tins_info( $get_t , $set_t ){
		#.首先解析get
		preg_match_all('#{(.*)}#iUs', $get_t,$v_preg_all);
		if( ! isset( $v_preg_all[1][0] ) ){
			return false;
		}
		$id        = $v_preg_all[1][0];
		$get_query = str_replace('{'.$id.'}',$id , $get_t);
		$get_info_id  = $this->mysql_query($get_query,true,$id);
		if( $get_info_id == '' ){return false;}
		#.然后解析set
		$set_query = str_replace('{'.$id.'}',$get_info_id , $set_t);
		$this->mysql_query( $set_query );
		return false;
	}
	private function parent_preg_info( $get,$set ){
		#.首先解析get
		$get   = mb_substr($get,1,mb_strlen($get));
		$get   = mb_substr($get,0,mb_strlen($get)-1);
		$get_arrays = explode(',', $get);
		foreach ( $get_arrays as $k => $v ){
			$v_imp = explode(':', $v);
			if( $v_imp[0] == 't' ){$table_name = $v_imp[1];}
			if( $v_imp[0] == 'f' ){$field_name = $v_imp[1];}
			if( $v_imp[0] == 'v' ){$value_name = $v_imp[1];}
			if( $v_imp[0] == 'g' ){$get_name   = $v_imp[1];}
		}
		$get_query = "SELECT `".$get_name."` FROM `".$table_name."` WHERE `".$field_name."`='".$value_name."';";
		$get_info_id  = $this->mysql_query($get_query,true,$get_name);
		if( $get_info_id == '' ){return false;}
		#.然后解析set
		$table_name = "";
		$field_name = "";
		$set_name   = "";
		$value_name = "";
		$set   = mb_substr($set,1,mb_strlen($set));
		$set   = mb_substr($set,0,mb_strlen($set)-1);
		$set_arrays = explode(',', $set);
		foreach ( $set_arrays as $k => $v ){
			$v_imp = explode(':', $v);
			if( $v_imp[0] == 't' ){$table_name = $v_imp[1];}
			if( $v_imp[0] == 'f' ){$field_name = $v_imp[1];}
			if( $v_imp[0] == 's' ){$set_name   = $v_imp[1];}
			if( $v_imp[0] == 'v' ){$value_name = $v_imp[1];}
			preg_match_all('#[\"\'](.*)[\"\']#iUs', $value_name,$v_preg_all);
			if( count( $v_preg_all[1] ) >= 1 ){
				foreach ( $v_preg_all[1] as $k1 => $v1 ){
					$sql = "UPDATE `".$table_name."` SET `".$set_name."`='".$get_info_id."' WHERE `".$field_name."`='".$v1."';";
					$this->mysql_query( $sql );
				}
			}
		}
	}
	//执行mysql_query语句
	final private function mysql_query($query,$parent = false,$get_name = ''){
		if(trim( $query ) == ''){return false;}
		$result = mysql_query(trim( $query ),$this->connect_db);
		if( ! $result ){
			$this->set_error_msg('SQL_ERROR:' . $query);
			return false;
		}
		if( ! $parent ){
			return $result;
		}else{
			$fetch  = @mysql_fetch_assoc($result);
			return $fetch[ $get_name ];
		}
	}
	
	//读取并解析csv文件
	final private function analyze_csv($csv_url,$stencil = '') {
	    $csvData = array('File'=>array('item'=>array()), 'Insert'=>array('item'=>array()),'Delete'=>array('item'=>array()),'Parent'=>array('item'=>array()));
	    $index = 0;
	    if (($handle = @fopen($csv_url, "r")) === FALSE) {
	        $this->set_error_msg('初始化资源配置文件读取失败！');
	        return false;
	    } else {
	        while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
	            if (empty(array_filter($data))) continue;
	            foreach ($data as $k=>$v) {
	                if (!empty($v)) {
	                    $data[$k] = mb_convert_encoding($v, 'utf8', 'gb2312');
	                }
	            }
	
	            $title = array_shift($data);
	            if (!empty($title) && strpos('操作', $title) !== false) continue;
	
	            if (!empty($title)) {
	                $key = $table = '';
	                $keys = $values = array();
	
	                $op = explode(':', $title);
	                if (isset($op[1]) && !empty($op[1])) {
	                    $table = trim($op[1]);
	                }
	
	                $key = ucfirst(trim($op[0]));
	                $data = array_filter($data);
	                if (in_array($key, array('File', 'Insert', 'Delete', 'Parent'))) {
	                    if ($key == 'File') {
	                        $keys = array_filter($data);
	                        if (strpos('source', $data[0]) === false) {
	                            $keys = array('source', 'whither');
	                            $csvData[$key]['item'][] = array_combine ( $keys , array_filter($data) );
	                        }
	                    } elseif ($key == 'Insert') {
	                        $insertDefault = array();
	                        foreach ($data as $k=>$v) {
	                            $arr = explode(':', $v);
	                            if (count($arr) > 1) {
	                                $insertDefault[$arr[0]] = $arr[1];
	                            } else {
	                                $insertDefault[$arr[0]] = '';
	                            }
	                            $keys[$k] = $arr[0]; //保持键名一致，防止因空值导致字段值错位
	                        }
	                        $insertPre = "INSERT INTO `{$table}` (`" . implode('`,`', $keys) . "`)";
	                    } else{
	                        $this->formatCsvData($key, $data, $csvData, $table);
	                    }
	
	                }
	            } else {
	                if ($key == 'File') {
	                    $csvData[$key]['item'][] = array_combine ( $keys , array_filter($data) );
	                } elseif ($key == 'Insert') {
	                    foreach ($keys as $k=>$v) {
	                        $values[$index][] = ($data[$k] == '') ? $insertDefault[$v] : $data[$k];
	                    }
	                    $index++;
	
	                    $sql_values = array();
	                    foreach ($values as $v) {
	                        $sql_values[] = " ('" . implode('\',\'', $v) . "')";
	                    }
	
	                    $sql[$table] = $insertPre . " VALUES " . implode(',', $sql_values) . ";";
	                    $csvData[$key]['item'] = $sql;
	                } elseif ($key == 'Parent') {
	                    $this->formatCsvData($key, $data, $csvData);
	                }
	
	            }
	        }
	        fclose($handle);
	
	        switch ( $stencil ){
	            case 'front' :$this->front_stencil_xml_content  = $csvData;break;
	            case 'behind':$this->behind_stencil_xml_content = $csvData;break;
	        }
	        return true;
	
	    }
	}
	
	//格式化csv文件
	final private function formatCsvData($key, $data, &$csvData, $table = '') {
	    switch ($key) {
	    	case 'Delete':
	    	    $field = array_shift($data);
	    	    $str = '{t:'.$table.',f:'.$field.',v:{"'.implode('"|"', $data).'"}}';
	    	    $csvData[$key]['item'][] = $str;
	    	    break;
	    	case 'Parent':
	    	    $get = explode(":", $data[0]);
	    	    $set = explode(":", $data[1]);
	
	    	    $g = '{t:'.$get[1].',f:'.$get[3].',g:'.$get[2].',v:'.$get[4].'}';
	    	    $s = '{t:'.$set[1].',f:'.$set[3].',s:'.$set[2].',v:'.$set[4].'}';
	
	    	    $csvData[$key]['item'][] = array('get'=>$g, 'set'=>$s);
	    	    break;
	    }
	}
}
class analyze_stencil extends analyze {
	
	public function __construct($front_stencil_url = '',$behind_stencil_url = ''){
		parent::__construct($front_stencil_url,$behind_stencil_url);
	}
	
	//执行被切换的模版操作
	public function front_clear(){
		if( $this->front_stencil_url == '' ){return false;}
		$this->file_analyze($this->front_stencil_xml_content,'delete',$this->front_stencil_url . '/resource');
		$this->delete_analyze($this->front_stencil_xml_content);
	}
	//进行切换后的模版操作
	public function behind_ini(){
		if( $this->behind_stencil_url == '' ){return false;}
		$this->file_analyze($this->behind_stencil_xml_content,'move',$this->behind_stencil_url . '/resource');
		$this->insert_analyze($this->behind_stencil_xml_content);
		$this->parent_analyze($this->behind_stencil_xml_content);
	}
}