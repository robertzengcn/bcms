<?php
include_once '../support.php';
require_once ENTITYPATH . "Environment.php";
require_once DAOPATH . "EnvironmentDAO.php";
require_once '../EnvironmentService.php';

class EnvironmentServiceTest extends PHPUnit_Framework_TestCase{
	private $service = null;
	private $data = null;
	
	/**
	 * 测试前准备
	 */
	public function setUp() {
		$this->service = new EnvironmentService();
		$this->data = $this->initData();
	}
	
	/**
	 * 测试后数据还原
	 */
	public function tearDown() {
		$ids = array();
		foreach ($this->data as $value) {
			$rs = R::getAll("select id from enviorment where subject='" . $value->subject . "'");
			if (!empty($rs)) {
			    $ids[] = $rs[0]['id'];
			}
		}
		$this->service->deleteBatch($ids);
	}
	
	/**
	 *测试添加...
	 */
	public function testSave(){
		foreach ($this->data as $key=>$value){
			switch ($key){
				case '0':
					break;
				case '1':
					$value->content = '';
					$code = 5;
					break;
				case '2':
					$value->subject = '';
					$code = 6;
					break;
				case '3':
					$value->pic = '';
					$code = 12;			
			}
			try {
				$result = $this->service->save($value);
				$this->assertEquals(true, $result->statu);
			}catch (ValidatorException $e){
				$this->assertEquals($code, $e->getCode());
			}
		}
	}
	
	/**
	 * 测试修改...
	 */
	public function testUpdate(){
		foreach ($this->data as $value){
			$result = $this->service->save($value);
		}
		
		foreach ($this->data as $key=>$val){
			switch ($key){
				case '0':
					$val->subject = '啊啊啊';
					$val->content = '1111';
					break;
				case '1':
					$val->content = '';
					$code = 5;
					break;
				case '2':
					$val->subject = '';
					$code = 6;
					break;
				case '3':
					$val->pic = '';
					$code = 12;
					break;
				case '4':
					$val->id = '';
					$code = 7;
					break;				
			}
			try{
				$result = $this->service->update($val);
				$this->assertEquals(true, $result->statu);
			}catch (ValidatorException $e){
				$this->assertEquals($code, $e->getCode());
			}
		}
	}
	
	/**
	 * 测试查询...
	 */
	public function testQuery(){
		foreach ($this->data as $value){
			$result = $this->service->save($value);
		}
		for ($i = 0; $i < 4; $i++) {
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
	 * 测试获取根据id一条...
	 */
	public function testGet(){
		for ($i=0;$i<=2;$i++){
			$environment = new Environment();
			switch ($i){
				case '0':
					$environment->id = 2;
					break;
				case '1':
					$environment->id = 99999;
					break;
				case '2':
					$environment->id = '';
					$code = 7;
					break;		
			}
			try {
				$result = $this->service->get( $environment );
				$this->assertEquals(true, $result->statu);
			}catch (ValidatorException $e){
				$this->assertEquals($code, $e->getCode());
			}
		}
	}
	
	public function testDeleteBatch(){
		foreach ($this->data as $value){
			$result = $this->service->save($value);
		}
		$ids = array();
		foreach ($this->data as $value) {
			$rs = R::getAll("select id from enviorment where subject='" . $value->subject . "'");
			if (!empty($rs)) {
			    $ids[] = $rs[0]['id'];
			}
		}
		for ($i = 0; $i <= 6; $i++) {
			switch ($i){
				case '0':
					$id = '123';
					$code = 130;
					break;
				case '1':
					$id = array('');
					$code = 7;
					break;
				case '2':
					$id = array('aaa');
					$code = 131;
					break;
				default:
					$id = $ids;
					break;					
			}
			try {
				$result = $this->service->deleteBatch( $id );
				$this->assertEquals(true, $result->statu);
			}catch (Exception $e){
				$this->assertEquals($code, $e->getCode());
			}
		}
	}
	
	/**
	 * 初始化测试数据
	 */
	protected function initData() {
		$data1 = array('subject'=>'a','pic'=>'aaa.jpg', 'content'=> 'aaa');
		$data2 = array('subject'=>'b','pic'=>'bbb.jpg', 'content'=> 'bbb');
		$data3 = array('subject'=>'c','pic'=>'ccc.jpg', 'content'=> 'ccc');
		$data4 = array('subject'=>'d','pic'=>'ddd.jpg', 'content'=> 'ddd');
		$data5 = array('subject'=>'e','pic'=>'eee.jpg', 'content'=> 'eee');
		
		$environment1 = $this->fillEntity(new Environment(), $data1);
		$environment2 = $this->fillEntity(new Environment(), $data2);
		$environment3 = $this->fillEntity(new Environment(), $data3);
		$environment4 = $this->fillEntity(new Environment(), $data4);
		$environment5 = $this->fillEntity(new Environment(), $data5);

		return array($environment1,$environment2,$environment3,$environment4,$environment5);
	}
	
	/**
	 * 封装数据到对象
	 */
	protected function fillEntity($environment, $data) {
		foreach ($environment as $key => $value) {
			if (isset($data[$key]))
			    $environment->$key = $data[$key];
		}
		return $environment;
	}
	
}