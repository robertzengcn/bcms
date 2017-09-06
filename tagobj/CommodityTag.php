<?php
/**
 * 
 * 导航tag标签
 * @author Administrator
 *
 */
class CommodityTag extends CommonTag {
	
	#.定义固定cate值(导航)
	private $cateArray = array(
		'top' => 1,//头部
		'disease' => 2,//疾病
		'foot' => 3,//尾部
	);
	
	/**
	 * 
	 * 构造函数
	 */
	function __construct() {
		
		$this->service = new CommodityService ();
		parent::__construct( get_class() );
	}
	
	/**
	 * 
	 * 获取自定义导航组
	 * @return array&object 数组对象
	 */
	public function getNavgroup($flag = '') {
		if( $flag == '' ){
			return null;
		}
		switch($flag){
			case 'catelogue':
				
				return $this->getcat();
				break;
			default:
				return $this->getcat();
		}

	}
	/*
	 * 获取目录列表返回数组对象
	 * */
	
	public function getcat(){
		$commoditycatlogue=new CommodityCategoriesService();
		
		$list = $commoditycatlogue->getcat();
		return $list;
	}
	
	/*
	 *获取目录信息 
	 *param catelogue id 
	 * */
	
	public function getcatbyid($id){
		return $this->service->getcatbyid($id);
	}
	
	/*
	 * 根据flag获取导航组的名称
	 * 
	 * */
	
	public function getNavgroupName($flag = ''){
		if( $flag == '' ){
			return null;
		}
		$navGroupService = new NavgroupService();
		$result=$navGroupService->getName($flag);
		return $result[0];
	}
	
	/**
	 * 
	 * 根据唯一id获取该id的详细信息
	 * {{$news = $tagOb->get($id)}}
	 * @param int $id 唯一id
	 */
	public function getById($value) {
		$id = (int)$value <= 0 ? 0 : (int)$value;
		$where = array( "id" => $id );
		$navGroupService = new NavgroupService();
		$result = $navGroupService->findOne( $where , '*' );
		$navgroup = new Navgroup();
		$navgroup->generateFromRedBean($result);
		return $navgroup;
	}
	
	/**
	 * 根据手机导航组flag获取导航成员信息
	 * @param string $flag
	 * @param string $cate
	 * @return NULL
	 */
	public function getMobileGroup($flag = '',$cate = 'mobile'){
		if( $flag == '' || is_null($flag) ){
			return null;
		}
		$where = array();
		$where['flag'] = $flag;
		switch($cate){
			case 'mobile':$where['cate']=1;break;
			case 'app':$where['cate']=2;break;
			case 'wechat':$where['cate']=3;break;
			default:$where['cate']=1;break;
		}
		$this->service = new MobileNavigationService();
		$result = $this->service->queryGroup($where);
		if( count($result->data) >= 1 ){
			$group_id = $result->data[0]->id;
			$_REQUEST['group_id'] = $group_id;
			unset($where['flag']);
			$result2 = $this->service->getGroup($where);
			if( count($result2->data) >= 1 ){
				return $result2->data;
			}else{
				return null;
			}
		}
		return null;
	}
	/**
	 * 根据手机导航组flag获取导航名称
	 * @param string $flag
	 * @param string $cate
	 * @return NULL
	 */
	public function getMobileGropname($flag = '',$cate = 'mobile'){
		if( $flag == '' || is_null($flag) ){
			return null;
		}
		$where = array();
		$where['flag'] = $flag;
		switch($cate){
			case 'mobile':$where['cate']=1;break;
			case 'app':$where['cate']=2;break;
			case 'wechat':$where['cate']=3;break;
			default:$where['cate']=1;break;
		}
		$this->service = new MobileNavigationService();
		$result = $this->service->queryGroup($where);
		if( count($result->data) >= 1 ){
		return $result->data[0];
		unset($where['flag']);
		}
		return null;
	}
	
	
	/**
	 * 
	 * 获取全局头部导航
	 * @return array&object 数组对象
	 */
	public function getTop() {
		return $this->get('top');	
	}
	
	/**
	 * 
	 * 获取全局疾病导航
	 * @return array&object 数组对象
	 */
	public function getDisease() {
		return $this->get('disease');	
	}
	
	/**
	 * 
	 * 获取全局尾部导航
	 * @return array&object 数组对象
	 */
	public function getFoot() {
		return $this->get('foot');	
	}
	
	/**
	 * 
	 * 通过对应的cate值获取对应区域的导航对象数组
	 * @param string $cate cate值
	 * @return array&object 数组对象
	 */
	public function get($cate = '') {
		if( $cate == '' ) {
			return null;
		}
		$where  = array( "1" => 1);
		$result = array();
		foreach( $this->service->query($where)->data as $key => $value ) {
			if( (int)$value->is_display == 1 && ( (int)$value->cate == (int)$this->cateArray[$cate] ) ) {
				$result[] = $value;
			}
		}
		return $result;
	}
	 /*
	  * 获取目录详情
	  * */
	
	public function getcatinfo($id){
		$commoditycatlogueservice=new CommodityCategoriesService();
		$commoditycatlogue=new CommodityCategories();
		$commoditycatlogue->id=$id;
		return $commoditycatlogueservice->get($commoditycatlogue);
	}
}
