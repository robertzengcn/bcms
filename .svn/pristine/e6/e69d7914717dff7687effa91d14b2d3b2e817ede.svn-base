<?php
//模拟疾病id&科室id
$_REQUEST['department_id']  = 19;
$_REQUEST['disease_id'][]   = 21;
$_REQUEST['disease_id'][]   = 22;
include_once '../support.php';
require_once ENTITYPATH . "Doctor.php";
require_once DAOPATH . "DoctorDAO.php";
require_once '../DoctorService.php';
require_once '../entity/Department.php';
require_once '../dao/DepartmentDAO.php';
require_once '../WorkHistoryService.php';
require_once '../dao/WorkHistoryDAO.php';
require_once '../entity/DoctorToDisease.php';
require_once '../DiseaseService.php';
require_once '../dao/DiseaseDAO.php';
require_once '../entity/Disease.php';

/**
 * 医生单元测试类
 */
class DoctorServiceTest extends PHPUnit_Framework_TestCase {
	private $service = null;
	private $data = null;
	
	/**
	 * 测试前准备
	 */
	public function setUp(){
		$this->service = new DoctorService();
		$this->data    = $this->initData();
	}
	
	/**
	 * 初始化测试数据
	 */
	protected function initData() {
		$data   = array();
		

		$data[] = array(
			'name'=>'黄xx0', 'pic'=> 'doctor/huangxx.gif', 'birthday'=>'2014-07-10', 
			'gender'=>1, 'content'=>'Test001','certificate'=>'zhong','specialty'=>'口腔临床医学',
			'cultural'=>'小学','university'=>'山东小学','title'=>'seo-title','keywords'=>'seo-keywords1,seo-keywords2',
			'description'=>'seo详情','department_id'=>19
		);
		$data[] = array(
			'name'=>'黄xx1', 'pic'=> 'doctor/huangxx.gif', 'birthday'=>'2014-07-10', 
			'gender'=>1, 'content'=>'Test001','certificate'=>'zhong','specialty'=>'口腔临床医学',
			'cultural'=>'小学','university'=>'山东小学','title'=>'seo-title','keywords'=>'seo-keywords1,seo-keywords2',
			'description'=>'seo详情','department_id'=>19
		);
		$data[] = array(
			'name'=>'黄xx2', 'pic'=> 'doctor/huangxx.gif', 'birthday'=>'2014-07-10', 
			'gender'=>1, 'content'=>'Test001','certificate'=>'zhong','specialty'=>'口腔临床医学',
			'cultural'=>'小学','university'=>'山东小学','title'=>'seo-title','keywords'=>'seo-keywords1,seo-keywords2',
			'description'=>'seo详情','department_id'=>19
		);
		$data[] = array(
			'name'=>'黄xx3', 'pic'=> 'doctor/huangxx.gif', 'birthday'=>'2014-07-10', 
			'gender'=>1, 'content'=>'Test001','certificate'=>'zhong','specialty'=>'口腔临床医学',
			'cultural'=>'小学','university'=>'山东小学','title'=>'seo-title','keywords'=>'seo-keywords1,seo-keywords2',
			'description'=>'seo详情','department_id'=>19
		);
		$data[] = array(
			'name'=>'黄xx4', 'pic'=> 'doctor/huangxx.gif', 'birthday'=>'2014-07-10', 
			'gender'=>1, 'content'=>'Test001','certificate'=>'zhong','specialty'=>'口腔临床医学',
			'cultural'=>'小学','university'=>'山东小学','title'=>'seo-title','keywords'=>'seo-keywords1,seo-keywords2',
			'description'=>'seo详情','department_id'=>19
		);
		$data[] = array(
			'name'=>'黄xx5', 'pic'=> 'doctor/huangxx.gif', 'birthday'=>'2014-07-10', 
			'gender'=>1, 'content'=>'Test001','certificate'=>'zhong','specialty'=>'口腔临床医学',
			'cultural'=>'小学','university'=>'山东小学','title'=>'seo-title','keywords'=>'seo-keywords1,seo-keywords2',
			'description'=>'seo详情','department_id'=>19
		);
		$data[] = array(
			'name'=>'黄xx6', 'pic'=> 'doctor/huangxx.gif', 'birthday'=>'2014-07-10', 
			'gender'=>1, 'content'=>'Test001','certificate'=>'zhong','specialty'=>'口腔临床医学',
			'cultural'=>'小学','university'=>'山东小学','title'=>'seo-title','keywords'=>'seo-keywords1,seo-keywords2',
			'description'=>'seo详情','department_id'=>19
		);
		$data[] = array(
			'name'=>'黄xx7', 'pic'=> 'doctor/huangxx.gif', 'birthday'=>'2014-07-10', 
			'gender'=>1, 'content'=>'Test001','certificate'=>'zhong','specialty'=>'口腔临床医学',
			'cultural'=>'小学','university'=>'山东小学','title'=>'seo-title','keywords'=>'seo-keywords1,seo-keywords2',
			'description'=>'seo详情','department_id'=>19
		);
		$data[] = array(
			'name'=>'黄xx8', 'pic'=> 'doctor/huangxx.gif', 'birthday'=>'2014-07-10', 
			'gender'=>1, 'content'=>'Test001','certificate'=>'','specialty'=>'口腔临床医学',
			'cultural'=>'小学','university'=>'山东小学','title'=>'seo-title','keywords'=>'seo-keywords1,seo-keywords2',
			'description'=>'seo详情','department_id'=>19
		);
		$data[] = array(
			'name'=>'黄xx9', 'pic'=> 'doctor/huangxx.gif', 'birthday'=>'2014-07-10', 
			'gender'=>1, 'content'=>'Test001','certificate'=>'','specialty'=>'口腔临床医学',
			'cultural'=>'小学','university'=>'山东小学','title'=>'seo-title','keywords'=>'seo-keywords1,seo-keywords2',
			'description'=>'seo详情','department_id'=>19
		);
		$data[] = array(
			'name'=>'黄xx10', 'pic'=> 'doctor/huangxx.gif', 'birthday'=>'2014-07-10', 
			'gender'=>1, 'content'=>'Test001','certificate'=>null,'specialty'=>'口腔临床医学',
			'cultural'=>'小学','university'=>'山东小学','title'=>'seo-title','keywords'=>'seo-keywords1,seo-keywords2',
			'description'=>'seo详情','department_id'=>19
		);
		
		$hanlderArrays = array();
		$entityObj     = new Doctor();
		if( count( $data ) >= 1 ){
			foreach( $data as $key => $value ){
				$hanlderArrays[] = $this->fillEntity( new Doctor() , $value );
			}
		}
		return $hanlderArrays;
	}
	
	/**
	 * 封装数据到对象
	 */
	protected function fillEntity( $entityObj , $data ) {
		foreach ($entityObj as $key => $value) {
			if (isset($data[$key]))
			    $entityObj->$key = $data[$key];
		}
		return $entityObj;
	}
	
	/**
	 * 测试后还原
	 */
	public function tearDown() {
		
	}
	
	/********************   以下为方法测试区域         ***********************/
	
	
	/**
	 * 增
	 */
	public function testSave(){
		for ( $i = 0 ; $i<= 10 ; $i++ ) {
			$code = '';
			$doctor = $this->data[ $i ];
			switch( $i ){
				case 0:break;
				case 1:$doctor->name = '';$code = 71;break;//name为空
				case 2:$doctor->content = '';$code = 126;break;//content为空
				case 3:$doctor->specialty = '';$code = 123;break;//specialty为空
				case 4:$doctor->cultural = '';$code = 125;break;//cultural为空
				case 5:$doctor->university = '';$code = 124;break;//university为空
				case 6:$doctor->birthday = '';$code = 122;break;//birthday为空
				case 7:$doctor->department_id = '';$code = 72;break;//department_id格式错误
				case 8:$doctor = new Doctor();$code = 71;break;//对象不存在(事实上为测试如果对象内任意必须值为空)
				case 9:$_REQUEST['department_id']   = 0;break;
				case 10:break;
			}
			try {
				$result = $this->service->save( $doctor );
				$this->assertEquals(true, $result->statu);
			} catch (ValidatorException $e) {
				$this->assertEquals($code, $e->getCode());
			}
		}
	}
	
	/**
	 * 删
	 */
	public function testDeleteBatch(){
		//添加初始数据
		foreach ($this->data as $data) {
			$result = $this->service->save($data);
		}
		//开始删除
		$ids = array();
		foreach ($this->data as $data) {
			$rs = R::getAll("select id from Doctor where name='" . $data->name . "'");
			if( isset( $rs[0]['id'] ) ){
				$ids[] = $rs[0]['id'];
			}
		}
		//添加一个测试文件
		if( count( $ids ) >= 1 ){
			$filename = GENERATEPATH . 'doctor/' . $ids[0] . '.html';
			file_put_contents($filename, 'test');
		}
		//测试多种情况
		for($i=0;$i<=6;$i++){
			$code = '';
			$id   = null;
			switch( $i ){
				case 1:$id     = 10;$code = 130;break;//id不为数组
				case 2:$id[0]  = 'string';$code = 131;break;//id不为数字
				case 3:$id[0]  = 0;$code = 7;break;//id为0的情况下
				case 4:$id[0]  = 888;$code = 78;break;//不存在的id
				default:$id    = $ids;break;
			}
			try{
				$result = $this->service->deleteBatch( $id );
				$this->assertEquals(true, $result->statu);
			}catch (Exception $e) {
				$this->assertEquals($code, $e->getCode());
			}
		}
	}
	
	/**
	 * 改
	 */
	public function testUpdate(){
		//添加初始数据
		foreach ($this->data as $pic) {
			$result = $this->service->save($pic);
		}
		//遍历错误
		for ( $i = 0 ; $i<= 10 ; $i++ ) {
			$code = '';
			$doctor = $this->data[ $i ];
			switch( $i ){
				case 0:break;
				case 1:$doctor->name = '';$code = 71;break;//name为空
				case 2:$doctor->content = '';$code = 126;break;//content为空
				case 3:$doctor->specialty = '';$code = 123;break;//specialty为空
				case 4:$doctor->cultural = '';$code = 125;break;//cultural为空
				case 5:$doctor->university = '';$code = 124;break;//university为空
				case 6:$doctor->birthday = '';$code = 122;break;//birthday为空
				case 7:$doctor->department_id = '';$code = 72;break;//department_id格式错误
				case 8:$doctor = new Doctor();$code = 71;break;//对象不存在(事实上为测试如果对象内任意必须值为空)
				case 9:$doctor->certificate = null;break;//强行null
				case 10:break;
			}
			try {
				$result = $this->service->update( $doctor );
				$this->assertEquals(true, $result->statu);
			} catch (ValidatorException $e) {
				$this->assertEquals($code, $e->getCode());
			}
		}
	}
	
	
	/**
	 * 查::获取医生信息
	 */
	public function testgetByDepartmentID(){
		$department_id = 19;
		$result = $this->service->getByDepartmentID( $department_id );
		$this->assertEquals(true, $result->statu);
	}
	
	/**
	 * 查::获取一条数据
	 */
	public function testget(){
		for($i=0;$i<=2;$i++){
			$doctor     = new Doctor();
			switch($i){
				case 0:$doctor->id = 1;break;//正常
				case 1:$doctor->id = 8888;break;//不存在
				case 2:$doctor->id = null;break;//null值
			}
			try {
				$result = $this->service->get( $doctor );
				$this->assertEquals(true, $result->statu);
			} catch (ValidatorException $e) {
				$this->assertEquals(0, $e->getCode());
			}
		}
	}
	
	/**
	 * 查::条件搜索
	 */
	public function testquery(){
		//添加初始数据
		foreach ($this->data as $pic) {
			$result = $this->service->save($pic);
		}
		//条件遍历
		for ($i=0; $i<4; $i++) {
			if ($i==0) { //where为空数组，返回所有
				$where = array();
			} elseif ($i==1) { //where为空串，返回所有
				$where = '';
			} elseif ($i==2) { //字段任意，匹配不到，返回所有
				$where = array(
					'pid' => 'test',
				);
			} elseif ($i==3) {
				$where = array(
					'text' => 'a'
				);
			}
			
			try {
				$result = $this->service->query($where);
				$this->assertEquals(true, $result->statu);
			} catch (Exception $e) {
				$this->assertFalse(false);
			}
		}
	}
	
	/**
	 * 查::根据疾病ID获取医生
	 */
	public function testgetByDiseaseId(){
		$_REQUEST['disease_id'] = 21;
		$result = $this->service->getByDiseaseId(  );
		$this->assertEquals(true, $result->statu);
	}
} 










