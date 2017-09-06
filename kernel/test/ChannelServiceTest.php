<?php
include_once '../support.php';
require_once ENTITYPATH . "Channel.php";
require_once DAOPATH . "ChannelDAO.php";
require_once '../ChannelService.php';
require_once '../dao/UserVarDAO.php';
require_once '../UserVarService.php';
require_once '../entity/UserVar.php';

class ChannelServiceTest extends PHPUnit_Framework_TestCase{
	private $service = null;
	private $data = null;
	
	/**
	 * 测试前准备
	 */
	public function setUp() {
		$this->service = new ChannelService();
		$this->data = $this->initData();
	}
	
	/**
	 * 测试后数据还原
	 */
	public function tearDown() {
		$ids = array();
		foreach ($this->data as $value) {
			$rs = R::getAll("select id from Channel where name='" . $value->name . "'");
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
					$value->name = '';
					$code = 64;
					break;
				case '2':
					$value->shortname = '';
					$code = 65;
					break;
				case '3':
					$value->shortname  = '508';
					$code = 141;
					break;
				case '4':
					$value->is_use_tpl = 'test';
					$code = 66;
					break;
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
					break;
				case '1':
					$val->name = '';
					$code = 64;
					break;
				case '2':
					$val->shortname = '';
					$code = 65;
					break;
				case '3':
					$val->shortname  = '508';
					$code = 141;
					break;
				case '4':
					$val->is_use_tpl = 'test';
					$code = 66;
					break;
				case '5':
					$val->id = null;
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
	 * 查询
	 */
	public function testquery(){
		$where = array();
		$this->service->query( $where );
	}
	
	/**
	 * 单条查询
	 */
	public function testGet(){
		$channel     = new Channel();
		$channel->id = 17;
		try{
			$result = $this->service->get($channel);
			$this->assertEquals(true, $result->statu);
		}catch (ValidatorException $e){
			$this->assertEquals(false, $e->getCode());
		}
		$channel->id = null;
		try{
			$result = $this->service->get($channel);
			$this->assertEquals(true, $result->statu);
		}catch (ValidatorException $e){
			$this->assertEquals(0, $e->getCode());
		}
	}
	
	/**
	 * 获取自定义字段
	 */
	public function testgetUserVar(){
		$_REQUEST['kind'] = 2;
		$_REQUEST['pid']  = 17;
		$this->service->getUserVar();
	}
	
	/**
	 * 修改自定义字段
	 */
	public function testupdateUserVar(){
		$_REQUEST['kind']  = 2;
		$_REQUEST['pid']   = 17;
		$_REQUEST ['name'] = array();
		$this->service->updateUserVar();
	}
	
	/**
	 * 测试删除
	 */
	public function testdelete(){
		$channel     = new Channel();
		$channel->id = 17;
		try{
			$result = $this->service->delete($channel);
			$this->assertEquals(true, $result->statu);
		}catch (ValidatorException $e){
			$this->assertEquals(0, $e->getCode());
		}
		$channel->id = null;
		try{
			$result = $this->service->delete($channel);
			$this->assertEquals(true, $result->statu);
		}catch (ValidatorException $e){
			$this->assertEquals(7, $e->getCode());
		}
	}
	
	/**
	 * 初始化测试数据
	 */
	protected function initData() {
		$data1 = array('name'=>'a','shortname'=>'aaa', 'is_use_tpl'=> 0);
		$data2 = array('name'=>'b','shortname'=>'bbb', 'is_use_tpl'=> 0);
		$data3 = array('name'=>'c','shortname'=>'ccc', 'is_use_tpl'=> 1);
		$data4 = array('name'=>'d','shortname'=>'ddd', 'is_use_tpl'=> 0);
		$data5 = array('name'=>'e','shortname'=>'eee', 'is_use_tpl'=> 1);
		$data6 = array('name'=>'f','shortname'=>'fff', 'is_use_tpl'=> 1);
		
		$channel1 = $this->fillEntity(new Channel(), $data1);
		$channel2 = $this->fillEntity(new Channel(), $data2);
		$channel3 = $this->fillEntity(new Channel(), $data3);
		$channel4 = $this->fillEntity(new Channel(), $data4);
		$channel5 = $this->fillEntity(new Channel(), $data5);
		$channel6 = $this->fillEntity(new Channel(), $data6);

		return array($channel1,$channel2,$channel3,$channel4,$channel5,$channel6);
	}
	
	/**
	 * 封装数据到对象
	 */
	protected function fillEntity($channel, $data) {
		foreach ($channel as $key => $value) {
			if (isset($data[$key]))
			    $channel->$key = $data[$key];
		}
		return $channel;
	}
}