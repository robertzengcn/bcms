<?php
include_once '../support.php';
require_once ENTITYPATH . "Pic.php";
require_once DAOPATH . "PicDAO.php";
require_once '../PicService.php';

/**
 * 图片测试类
 */
class PicServiceTest extends PHPUnit_Framework_TestCase {
	private $service = null;
	private $data = null;

	/**
	 * 测试前准备
	 */
	public function setUp() {
		$this->service = new PicService();
		$this->data = $this->initData();
	}

	/**
	 * 测试后数据还原
	 */
	public function tearDown() {
		$ids = array();
		foreach ($this->data as $pic) {
			$rs = R::getAll("select id from pic where text='" . $pic->text . "'");
			if (!empty($rs)) {
			    $ids[] = $rs[0]['id'];
			}
		}

		$this->service->deleteBatch($ids);
	}

	/**
	 * 测试添加
	 */
	public function testSave() {
		foreach ($this->data as $key => $pic) {
			$code = '';
		switch ($key) {
				case '0': //正常
					break;
				case '1': //url为空，预期会throw异常code=94，返回false
					$pic->url = '';
					$code = 94;
					break;
				case '2': //sort为空，预期会throw异常code=84，返回false
					$pic->sort = '';
					$code = 84;
					break;
				case '3'://pic为空，预期会throw异常code=98，返回false
					$pic->pic = '';
					$code = 98;
					break;
				case '4'://对象不存在，预期会throw异常code=94，返回false
					$pic = new Pic();
					$code = 94;
					break;
				default:
					//异常会直接抛出code=1
					$code = 1;
					throw new ValidatorException($code, '有异常抛出');
					break;
			}
			
			try {
				$result = $this->service->save($pic);
				$this->assertEquals(true, $result->statu);
			} catch (ValidatorException $e) {
				$this->assertEquals($code, $e->getCode());
			}
		}
	}
	
	/**
	 * 测试修改
	 * */
	public function testUpdate() {
		//添加初始数据
		foreach ($this->data as $pic) {
			$result = $this->service->save($pic);
		}
		
		//开始修改
		foreach ($this->data as $key => $pic) {
			$code = '';
			//初始化修改数据
			switch ($key) {
				case '0': //正常修改
					$pic->sort = 2;
					$pic->pid = 2;
					$pic->url = 'http://www.test.com/newtest1.php';
					break;
				case '1': //url为空，预期会throw异常code=94;，返回false
					$pic->url = '';
					$code = 94;
					break;
				case '2': //sort为空，预期会throw异常code=84;，返回false
					$pic->sort = '';
					$code = 84;
					break;
				case '3'://pic为空，预期会throw异常code=98;，返回false
					$pic->pic = '';
					$code = 98;
					break;
				case '4'://对象不存在，预期会throw异常code=94;，返回false
					$pic = new Pic();
					$code = 94;
					break;
				default:
					//异常会直接抛出
					$code = 1;
					throw new ValidatorException($code, '有异常抛出');
					break;
			}
			
			try {
				$result = $this->service->update($pic);
				$this->assertEquals(true, $result->statu);
			} catch (Exception $e) {
				$this->assertEquals($code, $e->getCode());
			}
		}
	}
	
	/**
	 * 测试删除
	 * */
	public function testDeleteBatch() {
		//添加初始数据
		foreach ($this->data as $pic) {
			$result = $this->service->save($pic);
		}
	
		//开始删除
		$ids = array();
		foreach ($this->data as $pic) {
			$rs = R::getAll("select id from pic where text='" . $pic->text . "'");
			$ids[] = $rs[0]['id'];
		}

		for ($i=0; $i<6; $i++) {
			$code = '';
			try{
				switch ($i) {
					case '0'://不是数组，抛异常:code=130
						$id = '123';
						$code = 130;
						$result = $this->service->deleteBatch($id);
						break;
					case '1':
						//数组内id为空抛异常:code=7
						$id = array('');
						$code = 7;
						break;
					case '2'://id不合法，不是数字，抛异常:code=131
						$id = array('aaaaa');
						$code = 131;
						break;
					case '3'://部分id不合法，抛异常:code=131
						$id = $ids;
						$id[0] = 'www';
						$code = 131;
						break;
					case '4'://部分id值为0，抛异常:code=131
						$id = $ids;
						$id[0] = '0';
						$code = 131;
						break;
					case '5'://正常可删除
						$id = $ids;
						break;
					default:
						break;
				}
				$result = $this->service->deleteBatch($id);
				$this->assertEquals(true, $result->statu);
			}catch (Exception $e) {
				$this->assertEquals($code, $e->getCode());
			}
		} 
	}
	
	/**
	 * 测试查询
	 * */
	public function testQuery() {
		//添加初始数据
		foreach ($this->data as $pic) {
			$result = $this->service->save($pic);
		}
		
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
	 * 测试get
	 */
	public function testget(){
		//添加初始数据
		foreach ($this->data as $pic) {
			$result = $this->service->save($pic);
		}
		$pic = new Pic();
		for ($i=0; $i<2; $i++) {
			if ($i==0) {//id为空串
				$pic->id  = '';
			} elseif ($i==1) {
				$pic->id  = 1;
				$pic->pic = 'aa.jpg';			
			}
			try {
				$result = $this->service->get($pic);
				$this->assertEquals(true, $result->statu);
			} catch (Exception $e) {
				$this->assertFalse(false);
			}
		}
	}

	/**
	 * 初始化测试数据
	 */
	protected function initData() {
		$data1 = array('pid'=>'1', 'sort'=> '1', 'url'=>'http://www.test.com/test1.php', 'pic'=>'1.jpg', 'text'=>'a');
        $data2 = array('pid'=>'1', 'sort'=> '1', 'url'=>'http://www.test.com/test2.php', 'pic'=>'2.jpg', 'text'=>'b');
		$data3 = array('pid'=>'1', 'sort'=> '1', 'url'=>'http://www.test.com/test3.php', 'pic'=>'3.jpg', 'text'=>'c');
		$data4 = array('pid'=>'1', 'sort'=> '1', 'url'=>'http://www.test.com/test4.php', 'pic'=>'4.jpg', 'text'=>'d');
		$data5 = array('pid'=>'1', 'sort'=> '1', 'url'=>'http://www.test.com/test5.php', 'pic'=>'5.jpg', 'text'=>'e');

		$pic1 = $this->fillEntity(new Pic(), $data1);
		$pic2 = $this->fillEntity(new Pic(), $data2);
		$pic3 = $this->fillEntity(new Pic(), $data3);
		$pic4 = $this->fillEntity(new Pic(), $data4);
		$pic5 = $this->fillEntity(new Pic(), $data5);

		return array($pic1, $pic2, $pic3, $pic4, $pic5);
	}

	/**
	 * 封装数据到对象
	 */
	protected function fillEntity($pic, $data) {
		foreach ($pic as $key => $value) {
			if (isset($data[$key]))
			    $pic->$key = $data[$key];
		}
		return $pic;
	}
}
