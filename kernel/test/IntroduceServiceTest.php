<?php
include_once '../support.php';
require_once ENTITYPATH . "Introduce.php";
require_once DAOPATH . "IntroduceDAO.php";
require_once '../IntroduceService.php';

class IntroduceServiceTest extends PHPUnit_Framework_TestCase{
	private $service = null;
	private $data = null;
	
	/**
	 * 测试前准备
	 */
	public function setUp() {
		$this->service = new IntroduceService();
		$this->data = $this->initData();
	}
	
	/**
	 * 测试后数据还原
	 */
	public function tearDown() {
		
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
		$data6 = array('subject'=>'e','pic'=>'eee.jpg', 'content'=> 'eee');
		
		$introduce1 = $this->fillEntity(new Introduce(), $data1);
		$introduce2 = $this->fillEntity(new Introduce(), $data2);
		$introduce3 = $this->fillEntity(new Introduce(), $data3);
		$introduce4 = $this->fillEntity(new Introduce(), $data4);
		$introduce5 = $this->fillEntity(new Introduce(), $data5);
		$introduce6 = $this->fillEntity(new Introduce(), $data6);

		return array($introduce1,$introduce2,$introduce3,$introduce4,$introduce5,$introduce6);
	}
	
	/**
	 * 测试获取根据id一条...
	 */
	public function testGet(){
		try {
			$result = $this->service->get();
			$this->assertEquals(true, $result->statu);
		}catch (ValidatorException $e){
			$this->assertEquals($code, $e->getCode());
		}
	}
	
	/**
	 * 测试修改...
	 */
	public function testUpdate(){
		foreach ($this->data as $key=>$val){
			switch ($key){
				case '1':
					$val->content = '';
					$code    = 53;
					break;
				case '2':
					$val->id = '';
					$code    = 7;
					break;
				default:
					$val->id = 2;
					break;		
			}
			try{
				$result = $this->service->update( $val );
				$this->assertEquals(true, $result->statu);
			}catch (ValidatorException $e){
				$this->assertEquals($code, $e->getCode());
			}
		}
	}
	
	/**
	 * 封装数据到对象
	 */
	protected function fillEntity($introduce, $data) {
		foreach ($introduce as $key => $value) {
			if (isset($data[$key]))
			    $introduce->$key = $data[$key];
		}
		return $introduce;
	}
}