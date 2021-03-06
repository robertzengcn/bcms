<?php
require_once ABSPATH . '/lib/rb.php';

class DBBaseDAO {

    protected $tableName = null;
    protected $isInnerNet = false;

    /**
     * 构造函数 初始化数据库连接
     */
    public function __construct() {
        // 判断是否时间setup
        if ($this->isInnerNet && defined('IN_DBHOST')) {
            if (isset(R::$currentDB) && R::$currentDB != 'default') {
                R::setup('mysql:host=' . IN_DBHOST . ';dbname=' . IN_DBNAME, IN_DBUSER, IN_DBPASSWORD);
            }
        } else {
            if (isset(R::$currentDB) && R::$currentDB != 'default') {
                R::setup('mysql:host=' . DBHOST . ';dbname=' . DBNAME, DBUSER, DBPASSWORD);
            }
        }
        
        // 开启freeze
        R::freeze(!DEBUG);
        // 初始化
        DTExpression::$params = array();
        DTExpression::$limit = '';
        DTExpression::$sql = ' 1=1 ';
        DTOrder::$sql = '';
    }

    /**
     * 注销 关闭数据库连接
     */
    public function __destruct() {
        R::close();
    }

    /**
     * 事物开启
     */
    public function beginTrans() {
        R::begin();
    }

    /**
     * 事物提交
     */
    public function commitTrans() {
        R::commit();
    }

    /**
     * 事物回滚
     */
    public function rollbackTrans() {
        R::rollback();
    }

    /**
     * 插入数据
     *
     * @param unknown $entity
     * @return boolean
     */
    public function save($entity) {
    	
        $bean = R::dispense($this->tableName);
        $this->remPic( 'save' , $entity , null );
        $entity->generateRedBean($bean);
        $entity->id= R::store($bean);
        return $entity;
    }

    /**
     * 获取具体内容
     *
     * @param unknown $where
     * @param unknown $field
     */
    public function findOne($where, $field) {
        if (is_array($where)) {
            foreach ($where as $key => $v) {
                 DTExpression::eq($key, $where);
            }
        }
        
        return $this->getByOne(ORMMap::$classes[$this->tableName], DTExpression::$sql);
    }

    /**
     * 按条件排序取数据
     *
     * @param string $order
     * @param string $limit
     * @param string $where
     * @param string $field
     *
     */
     public function getLimit($order = 'id desc', $limit = '10', $where, $field = "id,title") {
         if (is_array($where)) {
            foreach ($where as $key => $v) {
                if ($key != 'id') {
                    DTExpression::eq($key, $where);
                } else {
                    DTExpression::eq($key, $where);
                }
            }
        }
        
        $show_position = $this->unsetShowPosition();
        if ($show_position) {
            DTExpression::$sql .= " and " . $show_position;
        }
        DTExpression::limit(0, $limit);
        DTOrder::sort($order);

        return $this->getByComposite(ORMMap::$classes[$this->tableName], DTExpression::$sql . DTOrder::$sql . DTExpression::$limit);
    }
 
 

    /**
     * 获取指定条数 和 排序 记录 分页
     *
     * @param string $order
     *            排序条件
     * @param string $where
     *            条件
     * @param
     *            return array
     */
    
	
	 public function getPage($field = 'id,title', $where, $limit = array("page"=>"0","size"=>"2"), $order = 'id desc') {
	 
	     if (is_array($where)) {
	     	
            foreach ($where as $key => $v) {
                if ($key != 'id' && $key!='belong') {
                	
                    DTExpression::like($key, $where);
                } else {
                	
                    DTExpression::eq($key, $where);
                }
            }
        }

        $show_position = $this->unsetShowPosition();
        if ($show_position) {
            DTExpression::$sql .= " and " . $show_position;
        }
        DTExpression::limit($limit['page'] * $limit['size'], $limit['size']);
        DTOrder::sort($order);

        return $this->getByComposite(ORMMap::$classes[$this->tableName], DTExpression::$sql . DTOrder::$sql . DTExpression::$limit);
    }
    /**
     * 修改数据
     *
     * @param object $entity
     * @return boolean
     */
    public function update($entity) {
        $bean = R::load($this->tableName, $entity->id);

        if ($bean->id == 0) {
            return new Result(false, 78, ErrorMsgs::get(78), NULL);
        }
        $this->remPic('update' , $entity , $bean );
        if (isset($bean->plushtime) && $bean->plushtime != '') {
            $entity->plushtime = $bean->plushtime;
        }
// 		else{
// 			$entity->plushtime = time();
// 		}
		if (isset($bean->click_count) && $bean->click_count != '') {
            $entity->click_count = $bean->click_count;
        }
// 		else{//bug
// 			$entity->click_count = rand(30,1000);
// 		}
        $entity->generateRedBean($bean);
        $entity->id= R::store($bean);

        return new Result(true, 0, '', NULL);
    }

    /**
     * 获取单条数据
     *
     * @param unknown $id
     * @param unknown $entity
     */
    public function get($id, $entity) {
        $bean = R::load($this->tableName, $id);
        $entity->generateFromRedBean($bean);
        
    }

    /**
     * 获取数据数量
     *
     * @param string $where
     * @param string $para
     * @return number
     */
    public function getRecordCount($where = '', $para = '') {
        DTExpression::$sql = ' 1=1 ';
        DTExpression::$params = array();
        $count = R::count($this->tableName, $where, $para);
        

        return $count;
    }

    /**
     * 根据ID数组获取数据
     *
     * @param unknown $ids
     * @return Ambigous <multitype:, multitype:Ambigous <RedBean_OODBBean, mixed, multitype:RedBean_OODBBean > >
     */
    public function getBatch($ids = Array()) {
        $beans = R::batch($this->tableName, $ids);
        
        
        return $beans;
    }

    /**
     * 单条删除
     *
     * @param int $id
     */
    public function delete($id) {
        $bean = R::load($this->tableName, $id);
        $this->remPic( 'deleteSingle' , null , $bean );
        
        return R::trash($bean);
    }

    /**
     * 批量删除  按id集合删除
     *
     * @param array $ids
     */
    public function deleteBatch($ids) {
        $beans = $this->getBatch($ids);
        foreach ($beans as $k) {
            if ($k->id == 0) {
                return new Result(false, 78, ErrorMsgs::get(78), NULL);
            }
            if($k->id==1){
            	return new Result(false, 78, ErrorMsgs::get(78), NULL);
            }
        }
        $this->remPic( 'deleteBatch' , null , $beans );
        R::trashAll($beans);

        return new Result(true, 0, '', NULL);
    }

    /**
     * 批量删除 按beans删除
     *
     * @param object $beans REDBEAN Object
     * @return Result
     */
    public function deleteBeans($beans) {
        $this->remPic( 'deleteBeans' , null , $beans );
        R::trashAll($beans);
        
        return new Result(true, 0, '', NULL);
    }

    /**
     * 条件查询
     */
    public function getJoin($sql) {
        $arr = R::getAll($sql, DTExpression::$params);
  
        DTExpression::$params = array();
        DTExpression::$limit = '';
        DTExpression::$sql = ' 1=1 ';
        DTOrder::$sql = '';
        foreach ($arr as &$v) {
            $v = (object) $v;
        }
        return $arr;
    }
    /**
     * 条件查询
     */
    public function getRow($sql) {
        $arr =(object) R::getRow($sql);
        return $arr;
    }
    /**
     * 条件查询
     *
     * @param Entity $class
     * @param DTExpression $conditioin
     * @param DTOrder $order
     * @return array(Entity)
     */
    public function getByComposite($class, $sql, $field = NULL) { // $class=表名 disease $sql=

        $rs = R::find($this->tableName, $sql, DTExpression::$params,$field);
        
        
        DTExpression::$params = array();
        DTExpression::$limit = '';
        DTExpression::$sql = ' 1=1 ';
        DTOrder::$sql = '';
        $arr = array();
        foreach ($rs as $k => $bean) {
            $entity = new $class();
            $entity->generateFromRedBean($bean);
            $arr[] = $entity;
        }
       
        
        return $arr;
       
    }

    /**
     * 单条数据
     *
     * @param Entity $class
     * @param DTExpression $conditioin
     * @param DTOrder $order
     * @return array(Entity)
     */
    public function getByOne($class, $sql) {
        $result = R::findOne($this->tableName, $sql, DTExpression::$params);
        DTExpression::$params = array();
        DTExpression::$limit = '';
        DTExpression::$sql = ' 1=1 ';
        DTOrder::$sql = '';
       
        return $result;
    }

    /**
     * 查询所有
     *
     * @return Ambigous <multitype:, Device>
     */
    public function getListAll() {
        $result = R::findAll($this->tableName);
        $array = array();
        $class = ORMMap::$classes[$this->tableName];
        foreach ($result as $k => $bean) {
            $entity = new $class();
            $entity->generateFromRedBean($bean);
            $array[] = $entity;
        }
        
        return $array;
    }

    /**
     * 根据id获取上条记录
     *
     * @param
     *            int id
     * @return object
     */
    public function getLastOne($id) {
        DTExpression::lt('id', $id);
        DTExpression::limit(0, 1);
        DTOrder::sort('id desc');
        $rs = R::find($this->tableName, DTExpression::$sql . DTOrder::$sql . DTExpression::$limit, DTExpression::$params);
        DTExpression::$params = array();
        DTExpression::$limit = '';
        DTExpression::$sql = ' 1=1 ';
        DTOrder::$sql = '';
        $arr = array();
        $class = ORMMap::$classes[$this->tableName];
        foreach ($rs as $k => $bean) {
            $entity = new $class();
            $entity->generateFromRedBean($bean);
            $arr[] = $entity;
        }
        
        if (isset($arr[0])) {
            return $arr[0];
        }
        
        return null;
    }

    /**
     * 根据id获取上条记录
     *
     * @param
     *            int id
     * @return object
     */
    public function getPreOne($id) {
        DTExpression::gt('id', $id);
        DTExpression::limit(0, 1);
        DTOrder::sort('id asc');
        $rs = R::find($this->tableName, DTExpression::$sql . DTOrder::$sql . DTExpression::$limit, DTExpression::$params);
        DTExpression::$params = array();
        DTExpression::$limit = '';
        DTExpression::$sql = ' 1=1 ';
        DTOrder::$sql = '';
        $arr = array();
        $class = ORMMap::$classes[$this->tableName];
        foreach ($rs as $k => $bean) {
            $entity = new $class();
            $entity->generateFromRedBean($bean);
            $arr[] = $entity;
        }
        
        if (isset($arr[0])) {
            return $arr[0];
        }
        
        return null;
    }

    /**
     *
     *
     * 根据id集合或者name集合取出多条信息
     *
     * @param
     *            $where
     * @return array
     *
     */
    public function in($where, $entity) {
        $Beans = R::find($this->tableName, $where);
        $BeansArray = array();
        foreach ($Beans as $key => $value) {
            $entity = new $entity();
            $entity->generateFromRedBean($value);
            $BeansArray[] = $entity;
        }
        
        return $BeansArray;
    }
    
    /**
     * 图片删除方法
     * @param string $filename 图片路径
     */
    public function delPic($filename) {
        $lowerFile = strtolower($filename);
        //如果即将处理的图片为云图,则不允许被删除
        if (substr($filename, 0, 6) == 'select') {
            return true;
        }
        $file_name = ABSPATH . '/upload/' . $filename;
        if (file_exists($file_name) && is_file( $file_name ) ) {
			return unlink($file_name) ? true : false;
        }
        return false;
    }

    /**
     * 
     * 图片处理方法
     * @info 涵盖save、update、delete中的图片处理
     * @param string flag    处理模式
     * @param object entity  提交数据
     * @param obejct bean    表中取出数据
     */
    public function remPic( $flag , $entity = null , $bean = null ) {
        // 定义数据表中图片字段名称
        $picArrays = array('img','pic','pic1','pic2','pic3','certificate');
        $pic = array();
        switch ($flag) {
            case 'update':
                // 数据修改模式
                if (! is_null($bean)) {
                    foreach ($bean as $key => $value) {
                        if (in_array($key, $picArrays)) {
                            if (isset($entity->$key) && $entity->$key != '') {
                                $pic[] = $entity->$key;
                            }
                            if (isset($bean->$key) && $bean->$key != '') {
                                if (trim($entity->$key) == '' || ($entity->$key != $bean->$key)) {
                                    $this->delPic($bean->$key);
                                }
                            }
                        }
                    }
                }
                break;
            case 'save':
                // 数据添加模式
                if (! is_null($entity)) {
                    foreach ($entity as $key => $value) {
                        if (in_array($key, $picArrays)) {
                            if (isset($entity->$key) && $entity->$key != '') {
                                $pic[] = $entity->$key;
                            }
                        }
                    }
                }
                break;
            case 'deleteBatch':
            	// 数据删除模式[多条]
            	if (! is_null($bean)) {
            		foreach ($bean as $key => $value) {
						foreach( $value as $key2 => $value2 ) {
							if (in_array($key2, $picArrays)) {
								$this->delPic($value->$key2);
							}
						}
            		}
            	}
            	break;
            case 'deleteBeans':
            	// 数据删除模式[多条]
            	if (! is_null($bean)) {
            		foreach ($bean as $key => $value) {
						foreach( $value as $key2 => $value2 ) {
							if (in_array($key2, $picArrays)) {
								$this->delPic($value->$key2);
							}
						}
            		}
            	}
            	break;
            case 'deleteSingle':
            	// 数据删除模式[单条]
            	if (! is_null($bean)) {
            		foreach ($bean as $key => $value) {
            			if (in_array($key, $picArrays)) {
							$this->delPic($value->$key);
						}
            		}
            	}
        }
        // 进行图片移动处理
        if (count($pic) <= 0) {return true;}
        foreach ($pic as $key => $value) {
            if ($value != '') {
                $fileUrl = COMPILEDIR . 'temporaryPic/' . $value;
                if (file_exists($fileUrl)) {
                    $moveUrl = ABSPATH . '/upload/' . $value;
                    if (@copy($fileUrl, $moveUrl)) {
                        @unlink($fileUrl);
                    }
                }
            }
        }
        return true;
    }
    
    //为了区分mobile,app,wechat的查询显示，标签查询时添加了show_position参数
    public function unsetShowPosition() {
        $show_position = '';
    	$tables = array('article','ask','news','mediareport','technology','topic','doctor','channelarticle','success');
    	if (in_array($this->tableName, $tables)) {
    	    $show_position = $this->getShowPositionStr(PROJECT_NAME);
    	}
    	return $show_position;
    }
    
    /**
     * 通过cate获取显示位字符串
     *
     * 显示位置：1(pc), 2(手机网页), 3(app), 4(微站)
     * */
    public function getShowPositionStr($cate) {
        $show_position = "";
        switch ($cate) {
        	case 'mobile':
        	    $show_position = "(" . $this->tableName . ".show_position='0' or " . $this->tableName . ".show_position like '%2%')";
        	    break;
        	case 'app':
        	    $show_position = "(" . $this->tableName . ".show_position='0' or " . $this->tableName . ".show_position like '%3%')";
        	    break;
        	case 'wechat':
        	    $show_position = "(" . $this->tableName . ".show_position='0' or " . $this->tableName . ".show_position like '%4%')";
        	    break;
        	default:
        		//$show_position = "(" . $this->tableName . ".show_position='0' or " . $this->tableName . ".show_position like '%1%')";
        	    break;
        }
         
        return $show_position;
    }
   /**
     * 获取表字段
	 * @param boolean $abb 
	 * @param array $delfield 
	 * @param boolean $as	 
     * @return string
     */
    public function getFields($as=false, $abb=true, $delfield = array('content')){
		$table = strtolower($this->tableName);
		if($abb==true) {
			if(in_array($table,array('channelarticle'))){
			  $abb = substr($table,0,4);
			}else{
			  $abb = substr($table,0,3);			
			}
		}
        $class = ORMMap::$classes[$this->tableName];
         $entity = new $class();
		 $str_field = '';
		 foreach($entity as $key=>$val){
			if(!in_array($key,$delfield)){
				if($as==false){
					$str_field .= $abb . '.'. $key . ',';
				}else{
					$str_field .= $abb . '.'. $key . ' as ' . $table .'_' . $key. ',';					
				}
			}
		 }
		   $str_field = substr($str_field, 0, strlen($str_field) - 1);
		   
		return 	$str_field;	
    }
}
