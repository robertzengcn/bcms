<?php
/**
 * 图片管理DAO
 *
 * @author Administrator
 *        
 */
class PicManagerDAO extends DBBaseDAO {
	
	public function __construct() {
		parent::__construct ();
		$this->tableName = TABLENAME_PICMANAGER;
	}
	
	/**
	 * 获得grid数据
	 * 
	 * @param array $where 查询条件
	 * return object $arr          	
	 */
	public function query($where) {
		DTExpression::eq('kind',$where);
		DTExpression::like( 'flag', $where );	
		DTExpression::page ( $where );
		DTOrder::$sql = isset($where['order']) ? $where['order'] : '';
		return $this->getByComposite ( ORMMap::$classes[$this->tableName], DTExpression::$sql . DTOrder::$sql . DTExpression::$limit );
	}

	/**
	 * 获得logo iocn
	 * 
	 * @param array $where 查询条件
	 * return object $arr          	
	 */
	public function getLogo($where) {
		$str = '';
		foreach($where as $vo){
			$str .= "flag='".$vo."' or ";
		}
		$where = substr($str, 0, strlen($str) - 3);	
		return $this->getByComposite ( ORMMap::$classes[$this->tableName], $where . DTExpression::$limit );
	}	
	/**
	 * 获得总数
	 * 
	 * @param array $where 查询条件
	 * return object $arr          	
	 */
	public function totalRows($where) {
		DTExpression::eq('kind',$where);
		DTExpression::like( 'flag', $where );	
		
		return $this->getRecordCount ( DTExpression::$sql, DTExpression::$params );
	}
	
	/**
	 * 根据flag获取picmanager
	 * @param unknown $flag
	 * @return PicManager
	 */
	public function getByFlag($flag){
		$picManagers = R::findAll( $this->tableName, " flag = '".$flag."' " );
		
		$picManagerArray = array();
		foreach($picManagers as $value){
			$picManager = new PicManager();
			$picManager->generateFromRedBean ( $value );
			$picManagerArray[] = $picManager;
		}
		
		return $picManagerArray;
	}

	/**
	 * 获取广告数据
	 */
	public function getAd(){
		$picManagers = R::findAll($this->tableName,'kind >= 3');

		$picManagerArray = array();
		foreach($picManagers as $value){
			$picManager = new PicManager();
			$picManager->generateFromRedBean ( $value );
			$picManagerArray[] = $picManager;
		}
		
		return $picManagerArray;
	}

	/**
	 * 获取一笔广告数据
	 */
	public function getPic(){
		$picManagerBean = R::findOne($this->tableName,'kind = '.$_REQUEST['kind']);
		
		$picManager = new PicManager();
		$picManager->generateFromRedBean($picManagerBean);

		return $picManager;
	}
	
	/**
	 * 获取特效 flag
	 *
	 * @param unknown $flag
	 * @return PicManager
	 */
	public function getEffectByFlag($flag) {
		$picManagerBean = R::findOne ( $this->tableName, " flag = '{$flag}' " );
	
		$picManager = new PicManager ();
		$picManager->generateFromRedBean ( $picManagerBean );
	
		return $picManager;
	}
	
	/**
	 * 获取特效
	 *
	 * @return multitype:PicManager
	 */
	public function getEffect() {
		$picManagers = R::findAll ( $this->tableName, " kind > '2' " );
		$picManagerArray = array ();
		foreach ( $picManagers as $key => $value ) {
			$picManager = new PicManager ();
			$picManager->generateFromRedBean ( $value );
			$picManagerArray [] = $picManager;
		}
		
		return $picManagerArray;
	}
}
