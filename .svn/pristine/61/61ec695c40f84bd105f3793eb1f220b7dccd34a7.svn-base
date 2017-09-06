<?php
include_once '../support.php';
require_once ENTITYPATH . "Contact.php";
require_once DAOPATH . "ContactDAO.php";
require_once '../ContactService.php';

class ContactServiceTest extends PHPUnit_Framework_TestCase{
	private $service = null;
	private $data = null;
	
	/**
	 * 测试前准备
	 */
	public function setUp() {
		$this->service = new ContactService();
		$this->data = $this->initData();
	}
	
	/**
	 * 测试后数据还原
	 */
	public function tearDown() {
		$ids = array();
		foreach ($this->data as $value) {
			$rs = R::getAll("select id from Contact where name='" . $value->name . "'");
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
					$code = 19;
					break;
				case '2':
					$value->name = '电子邮箱';
					$value->val = '';//没有邮箱
					$code = 130;
					break;
				case '3':
					$value->name = '电子邮箱';
					$value->val = '2311223265qq.com';//非正常邮箱
					$code = 54;
					break;
				case '4':
					$value->name = 'ICP备案号';//ICP备案号也可以是QQ
					$value->val = '';
					$code = 20;
					break;
				case '5':
					$value->name = 'QQ';//ICP备案号也可以是QQ
					$value->val = 'text';
					$code = 119;
					break;
				case '6':
					$value->name = '医院网址';//网址类型
					$value->val = '';
					$code = 20;
					break;
				case '7':
					$value->name = '医院网址';//网址类型
					$value->val = 'wwwbaiducom';
					$code = 120;
					break;
				case '8':
					$value->name = 'QQ';//正确
					$value->val = '651423116';
					break;
				case '9':
					$value->name = '医院网址';//正确
					$value->val  = 'http://www.qq.com';
					break;
				case '10':
					$value->name = '电子邮箱';//正确
					$value->val  = '2311223265@qq.com';
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
		unset($value);
		foreach ($this->data as $key=>$value){
			switch ($key){
				case '0':
					break;
				case '1':
					$value->id = '';
					$code = 7;
					break;
			}
			try {
				$result = $this->service->update($value);
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
		$contact     = new Contact();
		$contact->id = 1;
		try{
			$result = $this->service->get($contact);
			$this->assertEquals(true, $result->statu);
		}catch (ValidatorException $e){
			$this->assertEquals(false, $e->getCode());
		}
		$contact->id = null;
		try{
			$result = $this->service->get($contact);
			$this->assertEquals(true, $result->statu);
		}catch (ValidatorException $e){
			$this->assertEquals(0, $e->getCode());
		}
	}
	
	/**
	 * 通过flag获取数据
	 */
	public function testgetContact(){
		$flag = 'name';
		$this->service->getContact( $flag );
	}
	
	/**
	 * 测试删除
	 */
	public function testdelete(){
		$contact     = new Contact();
		for ( $i = 0 ; $i <= 3 ; $i ++ ) {
			$code = '';
			switch($i){
				case 0:$contact->id = 2;break;//允许执行delete
				case 2:$contact->id = null;$code=7;break;
				case 1:$contact->id = 1;break;//无法执行delete
				case 3:$contact->id = 0;$code=16;break;
			}
			try{
				$result = $this->service->delete($contact);
				$this->assertEquals(true, $result->statu);
			}catch (ValidatorException $e){
				$this->assertEquals($code, $e->getCode());
			}
		}

	}
	
	/**
	 * 初始化测试数据
	 */
	protected function initData() {
		$data1 = array('name'=>'a','val'=>'aaa', 'is_retain'=> 0 , 'flag'=>'00a');
		$data2 = array('name'=>'b','val'=>'bbb', 'is_retain'=> 0 , 'flag'=>'00b');
		$data3 = array('name'=>'c','val'=>'ccc', 'is_retain'=> 1 , 'flag'=>'00c');
		$data4 = array('name'=>'d','val'=>'ddd', 'is_retain'=> 1 , 'flag'=>'00d');
		$data5 = array('name'=>'e','val'=>'eee', 'is_retain'=> 1 , 'flag'=>'00e');
		$data6 = array('name'=>'f','val'=>'fff', 'is_retain'=> 0 , 'flag'=>'00f');
		$data7 = array('name'=>'g','val'=>'ggg', 'is_retain'=> 1 , 'flag'=>'00g');
		$data8 = array('name'=>'h','val'=>'hhh', 'is_retain'=> 1 , 'flag'=>'00h');
		$data9 = array('name'=>'o','val'=>'ooo', 'is_retain'=> 1 , 'flag'=>'00o');
		$data10= array('name'=>'p','val'=>'ppp', 'is_retain'=> 0 , 'flag'=>'00p');
		$data11= array('name'=>'v','val'=>'vvv', 'is_retain'=> 0 , 'flag'=>'00v');

		
		$contact1 = $this->fillEntity(new Contact(), $data1);
		$contact2 = $this->fillEntity(new Contact(), $data2);
		$contact3 = $this->fillEntity(new Contact(), $data3);
		$contact4 = $this->fillEntity(new Contact(), $data4);
		$contact5 = $this->fillEntity(new Contact(), $data5);
		$contact6 = $this->fillEntity(new Contact(), $data6);
		$contact7 = $this->fillEntity(new Contact(), $data7);
		$contact8 = $this->fillEntity(new Contact(), $data8);
		$contact9  = $this->fillEntity(new Contact(), $data9);
		$contact10 = $this->fillEntity(new Contact(), $data10);
		$contact11 = $this->fillEntity(new Contact(), $data11);

		return array($contact1,$contact2,$contact3,$contact4,$contact5,$contact6,$contact7,$contact8,$contact9,$contact10,$contact11);
	}
	
	/**
	 * 封装数据到对象
	 */
	protected function fillEntity($contact, $data) {
		foreach ($contact as $key => $value) {
			if (isset($data[$key]))
			    $contact->$key = $data[$key];
		}
		return $contact;
	}
	
}