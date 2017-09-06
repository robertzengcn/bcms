<?php
include_once '../support.php';
require_once ENTITYPATH . "Disease.php";
require_once DAOPATH . "DiseaseDAO.php";
require_once '../DiseaseService.php';
require_once '../DepartmentService.php';
require_once '../entity/Department.php';
require_once '../dao/DepartmentDAO.php';
require_once '../StatisticsLogService.php';
require_once '../dao/StatisticsLogDAO.php';
require_once '../entity/StatisticsLog.php';



class DiseaseServiceTest extends PHPUnit_Framework_TestCase {
	private $service = null;
	private $data = null;

	/**
	 * 测试前准备
	 */
	public function setUp() {
		$this->service = new DiseaseService();
		$this->data = $this->initData();
	}
	
	/**
	 * 测试后数据还原
	 */
	public function tearDown() {
		$ids = array();
		foreach ($this->data as $disease) {
			$rs = R::getAll("select id from disease where title= '" . $disease->title . "'");
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
		foreach ($this->data as $key => $disease) {
			$code = '';
			$departmentID=$disease->department_id;
			switch ($key) {
				case '0':  //正常添加
					break;
				case '1': //name 为空串
					$disease->name = '';
					$code = 69;
					break;
				case '2'://url为空串
					$disease->url = ''; 
					$code = 70;
					break;
				case '3':					
					$departmentID = 1;				
					$code = 27;
					break;	
				case '4'://url格式不合法
					$disease->url = '11';
					$code = 141;
					break;
				case '5':  //正常添加
					break;				
				default:
					$code = 1;
					throw new ValidatorException($code, '有异常抛出');
					break;
			}				
			try {
				$result = $this->service->save($disease,$departmentID);
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
		foreach ($this->data as $disease) {
			$departmentID=$disease->department_id;
			$result = $this->service->save($disease,$departmentID);		
		}		
		//开始修改
		foreach ($this->data as $key => $disease) {
			$code = '';		
			//初始化修改数据		
			switch ($key) {
				case '0': //正常修改
					$disease->name = 'aaa';
					$disease->url = 'yyy';
					$disease->department_id =11; 					
					break;
				case '1': //name为空串
					$disease->name = '';
					$code = 69;
					break;
				case '2'://url为空串
					$disease->url = '';
					$code = 70;
					break;
				case '3':
					$disease->department_id = 11;
					$code = 27;
					break;
				case '4'://url格式不合法
					$disease->url = '11';
					$code = 141;
					break;
				case '5'://对象不存在
					$disease->id = '';
					$code = 7;
					break;
				default:
					$code = 1;
					throw new ValidatorException($code, '有异常抛出');
					break;
			}		
			try {
				$result = $this->service->update($disease);
				$this->assertEquals(true, $result->statu);
			} catch (ValidatorException $e) {
				$this->assertEquals($code, $e->getCode());
			}		
		}
	}

	
	
	/**
	 * 测试获取单条数据
	 * */
	public function testGet() {
		//添加初始数据
		foreach ($this->data as $disease) {
			$departmentID=$disease->department_id;
			$result = $this->service->save($disease,$departmentID);
		}
		
		$disease=new Disease();
		for ($i=0; $i<2; $i++) {
			if ($i==0) {//id为空串
				$disease->id  = '';
			} elseif ($i==1) {
				$disease->id  = 13;
				$disease->pic = '';
			} 
			try {
				$result = $this->service->get($disease);
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
	foreach ($this->data as $disease) {
			$departmentID=$disease->department_id;
			$result = $this->service->save($disease,$departmentID);
		}		
		//开始删除
		$ids = array();	
		$urls = array();
		foreach ($this->data as $disease) {
			$rs = R::getAll("select id,url from disease where title= '" . $disease->title . "'");
			if (!empty($rs)) {
				$ids[] = $rs[0]['id'];
				$urls[] = $rs[0]['url'];
			}
		}
		//添加测试文件
		if( count( $ids ) >= 1 ){	
			foreach($ids as $key=>$value)	{
			if(!is_dir(GENERATEPATH . 'disease/' )){	//创建目录
				mkdir(GENERATEPATH . 'disease/' );		
			}
			if(!is_dir(GENERATEPATH . 'disease/'.$urls[$key] )){
				mkdir(GENERATEPATH . 'disease/'.$urls[$key]);
			}
			$filename = GENERATEPATH . 'disease/' . $urls[$key] . '/' . $ids[$key] . '.html';					
 			$myfile = fopen($filename,'w');	  //创建文件		
 			fclose($myfile);	 //关闭文件
			}			
		}
		for ($i=0; $i<6; $i++) {
			$code = '';
			try{
				switch ($i) {
					case '0': //id不为数组
						$id = '123';
						$code = 130;
						break;
					case '1'://id为空数组
						$id = array('');
						$code = 7;
						break;
					case '2': //id不为数字
						$id = array('aaaaa');
						$code = 131;
						break;
 					case '3':
						$id = $ids;//id 部分为0
						$id[] = 0;
						$code = 131;
 						break;
					case '4':
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
				echo $e->getMessage();
				$this->assertEquals($code, $e->getCode());
			}
		}
	}
	
	
 	/**
 	 * 测试根据多条疾病数据获取疾病
 	 */
	public function testGetNames(){
		//添加初始数据
		foreach ($this->data as $disease) {
			$departmentID=$disease->department_id;
			$result = $this->service->save($disease,$departmentID);
		}
		for ($i=0; $i<1; $i++) {
			if ($i==0) {
				$id = array(12,13,14);
			} 
			try {
				$result = $this->service->getNames($id);
				$this->assertEquals(true, $result->statu);
			} catch (Exception $e) {
				$this->assertFalse(false);
			}
		}
		
	}
	
	/**
	 * 测试根据疾病名字获取数据
	 */
	public function testGetByName(){
		//添加初始数据
		foreach ($this->data as $disease) {
			$departmentID=$disease->department_id;
			$result = $this->service->save($disease,$departmentID);
		}
		for ($i=0; $i<3; $i++) {
			if ($i==0) {
				$where=array();
			} elseif ($i==1) {
				$where = '';
			} elseif ($i==2) {
				$where = array(
						'name' => 'aaa',
				);
			}
			try {
				$result = $this->service->getByName($where);
				$this->assertEquals(true, $result->statu);
			} catch (Exception $e) {
				$this->assertFalse(false);
			}
		}
		
	}
	
	
	
	
	/**
	 * 测试根据科室id获取对应的疾病信息
	 */
	public function testGetByDepartmentID(){
		//添加初始数据
		foreach ($this->data as $disease) {
			$departmentID=$disease->department_id;
			$result = $this->service->save($disease,$departmentID);
		}
		for ($i=0; $i<3; $i++) {
			if ($i==0) {
				$departmentId=10; //department_id 正常
			}elseif($i==1){  
				$departmentId='';  //department_id为空
			}elseif($i==2){  
				$departmentId='aa';  //department_id不是数字
			}			
		try {
			$result = $this->service->getByDepartmentID($departmentId);
			$this->assertEquals(true, $result->statu);		
		} catch (Exception $e) {
			$this->assertFalse(false);
		}
		}
	}
	
	/**
	 * 测试根据科室id获取对应的疾病信息
	 */
		public function testGetByDepartment(){
			//添加初始数据
			foreach ($this->data as $disease) {
				$departmentID=$disease->department_id;
				$result = $this->service->save($disease,$departmentID);
			}
			for ($i=0; $i<3; $i++) {
				if ($i==0) { 		//department_id为空数组
					$departmentID = array();
				} elseif ($i==1) { 	//department_id为空串
					$departmentID = '';
				} elseif ($i==2) { 	//department_id正常
					$departmentID = array('department_id' => '11');
				} 
				try {					
					$result = $this->service->getByDepartment($departmentID);
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
		foreach ($this->data as $disease) {
			$departmentID=$disease->department_id;
			$result = $this->service->save($disease,$departmentID);
		}	
		//遍历条件 $where
		 for ($i=0; $i<3; $i++) {
			if ($i==0) { 
				$where = array('department_id'=>11);
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
	 * 初始化 测试数据
	 */
	protected function initData() {
		$data1 = array('id'=>'1', 'name'=> 'aaa', 'url'=>'www', 'title'=>'a','keywords'=>'1','description'=>'11','department_id'=>11,'pic'=>'1.jpg','tplurl'=>'wwwq');
		$data2 = array('id'=>'2', 'name'=> 'bbb', 'url'=>'www', 'title'=>'a','keywords'=>'1','description'=>'11','department_id'=>11,'pic'=>'1.jpg','tplurl'=>'wwwh');
		$data3 = array('id'=>'3', 'name'=> 'ccc', 'url'=>'www', 'title'=>'a','keywords'=>'1','description'=>'11','department_id'=>11,'pic'=>'1.jpg','tplurl'=>'wwwy');
		$data4 = array('id'=>'4', 'name'=> 'ddd', 'url'=>'www', 'title'=>'d','keywords'=>'1','description'=>'11','department_id'=>19,'pic'=>'1.jpg','tplurl'=>'wwwe');
		$data5 = array('id'=>'5', 'name'=> 'eee', 'url'=>'www', 'title'=>'e','keywords'=>'1','description'=>'11','department_id'=>19,'pic'=>'1.jpg','tplurl'=>'wwwt');
		$data6 = array('id'=>'6', 'name'=> 'eee', 'url'=>'www', 'title'=>'e','keywords'=>'1','description'=>'11','department_id'=>19,'pic'=>'1.jpg','tplurl'=>'wwwt');
			
		$disease1 = $this->fillEntity(new Disease(), $data1);
		$disease2 = $this->fillEntity(new Disease(), $data2);
		$disease3 = $this->fillEntity(new Disease(), $data3);
		$disease4 = $this->fillEntity(new Disease(), $data4);
		$disease5 = $this->fillEntity(new Disease(), $data5);
		$disease6 = $this->fillEntity(new Disease(), $data6);
		
		return array($disease1,$disease2,$disease3,$disease4,$disease5,$disease6);
	}
	
	/**
	 * 封装数据到对象
	 */
	protected function fillEntity($disease, $data) {
		foreach ($disease as $key => $value) {
			if (isset($data[$key]))
				$disease->$key = $data[$key];
		}
		return $disease;
	}
}