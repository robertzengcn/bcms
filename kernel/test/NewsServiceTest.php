<?php
include_once '../support.php';
require_once ENTITYPATH . "News.php";
require_once DAOPATH . "NewsDAO.php";
require_once '../NewsService.php';
require_once '../TagService.php';
require_once '../entity/Tag.php';
require_once '../dao/TagDAO.php';
$_REQUEST['tags'] = 111;



class NewsServiceTest extends PHPUnit_Framework_TestCase {
	private $service = null;
	private $data = null;

	/**
	 * 测试前准备
	 */
	public function setUp() {
		$this->service = new NewsService();
		$this->data = $this->initData();
	}
	
	/**
	 * 测试后数据还原
	 */
	public function tearDown() {
		$ids = array();
		foreach ($this->data as $news) {
			$rs = R::getAll("select id from news where title= '" . $news->title . "'");
			if (!empty($rs)) {
				$ids[] = $rs[0]['id'];
			}
		}
		$this->service->deleteBatch($ids);
	}

	/**
	 * 初始化 测试数据
	 */
	protected function initData() {
		$data1 = array('id'=>'1', 'subject'=> 'aaa', 'pic'=>'aa.jpg','source'=>'中正','content'=>'蛀牙','click_count'=>11,'title'=>'儿童蛀牙','keywords'=>'小心','description'=>'11','plushtime'=>'1410510435','isbidding'=>'0','plushtime'=>'1410510435',);
		$data2 = array('id'=>'2', 'subject'=> 'aaa', 'pic'=>'aa.jpg','source'=>'中正','content'=>'蛀牙','click_count'=>11,'title'=>'儿童蛀牙','keywords'=>'小心','description'=>'11','plushtime'=>'1410510435','isbidding'=>'0','plushtime'=>'1410510435',);
		$data3 = array('id'=>'3', 'subject'=> 'aaa', 'pic'=>'aa.jpg','source'=>'中正','content'=>'蛀牙','click_count'=>11,'title'=>'儿童蛀牙','keywords'=>'小心','description'=>'11','plushtime'=>'1410510435','isbidding'=>'0','plushtime'=>'1410510435',);
		$data4 = array('id'=>'4', 'subject'=> 'aaa', 'pic'=>'aa.jpg','source'=>'中正','content'=>'蛀牙','click_count'=>11,'title'=>'儿童蛀牙','keywords'=>'小心','description'=>'11','plushtime'=>'1410510435','isbidding'=>'0','plushtime'=>'1410510435',);
		$data5 = array('id'=>'5', 'subject'=> 'aaa', 'pic'=>'aa.jpg','source'=>'中正','content'=>'蛀牙','click_count'=>11,'title'=>'儿童蛀牙','keywords'=>'小心','description'=>'11','plushtime'=>'1410510435','isbidding'=>'0','plushtime'=>'1410510435',);
		$data6 = array('id'=>'6', 'subject'=> 'aaa', 'pic'=>'aa.jpg','source'=>'中正','content'=>'蛀牙','click_count'=>11,'title'=>'儿童蛀牙','keywords'=>'小心','description'=>'11','plushtime'=>'1410510435','isbidding'=>'0','plushtime'=>'1410510435',);
		
		$news1 = $this->fillEntity(new News(), $data1);
		$news2 = $this->fillEntity(new News(), $data2);
		$news3 = $this->fillEntity(new News(), $data3);
		$news4 = $this->fillEntity(new News(), $data4);
		$news5 = $this->fillEntity(new News(), $data5);
		$news6 = $this->fillEntity(new News(), $data6);
	
		return array($news1,$news2,$news3,$news4,$news5,$news6);
	}
	
	/**
	 * 封装数据到对象
	 */
	protected function fillEntity($news, $data) {
		foreach ($news as $key => $value) {
			if (isset($data[$key]))
				$news->$key = $data[$key];
		}
		return $news;
	}

	
	
	/**
	 * 测试添加
	 */
 	public function testSave() {
		foreach ($this->data as $key => $news) {
			$code = '';
			switch ($key) {
				case '0': //正常
					$tagsService = new TagService ();
					$tagsService->tagsSave ( $news->plushtime );
					break;
				case '1': 
					$news->subject = '';
					$code = 6;
					break;
				case '2': 
					$news->content = '';
					$code = 5;
					break;
				case '3':
					$news->isbidding = '';
					$code = 8;
					break;
				case '4':
					$news->plushtime = '';
					$news->plushtime = time();
					break;
				case '5':
					$news->updatetime = '';
					$news->updatetime = time();
					break;
				default:
					//异常会直接抛出code=1
					$code = 1;
					throw new ValidatorException($code, '有异常抛出');
					break;
			}
				
			try {
				$result = $this->service->save($news);
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
		foreach ($this->data as $news) {
			$result = $this->service->save($news);
		}
		for ($i=0; $i<3; $i++) {
			if ($i==0) {//正常修改
				$news->subject = 'aa';
			} elseif ($i==1) {
				$news->subject = '';
				$code = 6;
			}elseif ($i==2) {
				$news->content = '';
				$code = 5;
			}
			
			try {
				$result = $this->service->update($news);
				$this->assertEquals(true, $result->statu);
			} catch (Exception $e) {
				$this->assertFalse(false);
			}
		}
	}
	
	
	
	
	

	/**
	 * 测试获取单条数据
	 * */
	public function testGet() {
		//添加初始数据
		foreach ($this->data as $news) {
			$result = $this->service->save($news);
		}
		$news=new News();
		for ($i=0; $i<2; $i++) {
			if ($i==0) {//id为空串
				$news->id  = '';
			} elseif ($i==1) {
				$news->id  = 1;
				$news->pic = 'aa.jpg';			
			}
			try {
				$result = $this->service->get($news);
				$this->assertEquals(true, $result->statu);
			} catch (Exception $e) {
				$this->assertFalse(false);
			}
		}
	}
	
	
	
	
	
	/**
	 * 测试查询
	 * */
	public function testQuery() {
		//添加初始数据
		foreach ($this->data as $news) {
			$result = $this->service->save($news);
		}
		//遍历条件 $where
		for ($i=0; $i<3; $i++) {
			if ($i==0) {
				$where = array('isbidding'=>0);
			} elseif($i==1){   	//where为空数组，返回所有
				$where = array();
			}elseif($i==2){		//where为空串，返回所有
				$where = '';
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
	 * 测试删除
	 * */
	public function testDeleteBatch() {
		//添加初始数据
		foreach ($this->data as $news) {
			$result = $this->service->save($news);
		}	
		$ids = array();
		foreach ($this->data as $news) {
			$rs = R::getAll("select id from news where title= '" . $news->title . "'");
			if (!empty($rs)) {
				$ids[] = $rs[0]['id'];
			}
		}		
		//添加测试文件
		if( count( $ids ) >= 1 ){
			foreach($ids as $key=>$value)	{
				if(!is_dir(GENERATEPATH . 'news/' )){	//创建目录
					mkdir(GENERATEPATH . 'news/' );
				}
				$filename = GENERATEPATH . 'news/' . $ids[$key] . '.html';			
				file_put_contents($filename, 'test');
			}
		}			
		for ($i=0; $i<3; $i++) {
			if ($i==0) {//正常修改
				$id = $ids;
			} elseif ($i==1) {
				$id = '123';
				$code = 130;	
			}				
			try {
				$result = $this->service->update($news);
				$this->assertEquals(true, $result->statu);
			} catch (Exception $e) {
				$this->assertFalse(false);
			}
		}			
	}
	
	
	
	
	
	
	
}