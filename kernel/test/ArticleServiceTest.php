<?php
include_once '../support.php';
require_once ENTITYPATH . "Article.php";
require_once DAOPATH . "ArticleDAO.php";
require_once '../ArticleService.php';
require_once '../dao/RecommendListDAO.php';
require_once '../TagService.php';
require_once '../dao/TagDAO.php';
require_once '../entity/Tag.php';
require_once '../entity/RecommendList.php';
require_once '../dao/DepartmentDAO.php';
require_once '../dao/DiseaseDAO.php';
require_once '../dao/DoctorDAO.php';
require_once '../WorkerService.php';
require_once '../entity/Worker.php';
require_once '../dao/WorkerDAO.php';
require_once '../entity/Department.php';
require_once '../entity/Disease.php';
require_once '../entity/Doctor.php';
require_once '../dao/RecommendPositionDAO.php';
require_once '../entity/RecommendPosition.php';
session_start();
$_SESSION["id"] = 1;
$_SESSION['group'] = 2;
$_REQUEST['tags'] = 111;
$_REQUEST ['recommendposition'] = array(1);

/**
 * 文章测试类...
 * @author Administrator
 *
 */
class ArticleServiceTest extends PHPUnit_Framework_TestCase{
	private $service = null;
	private $data = null;
	
	/**
	 * 测试前准备
	 */
	public function setUp() {
		$this->service = new ArticleService();
		$this->data = $this->initData();
	}
	
	/**
	 * 测试后数据还原
	 */
	public function tearDown() {
		$ids = array();
		foreach ($this->data as $value) {
			$rs = R::getAll("select id from article where subject='" . $value->subject . "'");
			if (!empty($rs)) {
			    $ids[] = $rs[0]['id'];
			}
		}

		$this->service->deleteBatch($ids);
	}
	
	/**
	 * 测试添加...
	 */
	public function testSave(){
		foreach ($this->data as $key=>$value){
			switch ($key){
				case '0':
					break;
				case '1':
					$value->subject = '';
					$code = 6;
					break;
				case '2':
					$value->content = '';
					$code = 5;
					break;
				case '3':
					$value->isbidding = '';
					$code = 8;
					break;
				case '4':
					$value->department_id = '';
					$code = 72;
					break;
				case '5':
					$value->disease_id = '';
					$code = 59;
					break;							
			}
			try {
				$result = $this->service->save($value);
				if ($result->statu){
					$this->assertEquals(true, $result->statu);
				}else{
					$this->assertEquals(0, $result->code);
				}
			} catch (ValidatorException $e) {
				$this->assertEquals($code, $e->getCode());
			}
		}
	}
	
	/**
	 * 测试修改...
	 */
	public function testUpdate(){
		$datas = $this->data;
		array_pop($datas);
		foreach ($datas as $value){
			$result = $this->service->save($value);
		}
		foreach ($this->data as $key=>$val){
			switch ($key){
				case 0:
					$val->subject = '啊啊';
					$val->content = 'XXXXX';
					break;
				case 1:
					$val->subject = '';
					$code = 6;
					break;
				case 2:
					$val->content = '';
					$code = 5;
					break;
				case 3:
					$val->isbidding = '';
					$code = 8;
					break;
				case 4:
					$val->department_id = '';
					$code = 72;
					break;
				case 5:
					$val->disease_id = '';
					$code = 59;
					break;
				case 6:
					$val->doctor_id = '';
					$result = $this->service->update($val);
					break;	
				case 7:
					$code = 7;
					break;						
			}
			try {
				$result = $this->service->update($val);
				$this->assertEquals(true, $result->statu);
			} catch (ValidatorException $e) {
				$this->assertEquals($code, $e->getCode());
			}
		}
	}
	
	/**
	 * 测试根据id获取数据...
	 */
	public function testGet(){
		$article = new Article();
		for($i=0;$i<=1;$i++){
			switch ($i){
				case 0:
					$article->id = 10;
					break;
				case 1:
					$article->id = '';
					$code = 7;
					break;	
			}
			try {
				$result = $this->service->get($article);
				$this->assertEquals($article->id,$result->data->id);
			}catch (ValidatorException $e){
				$this->assertEquals($code,$e->getCode());
			}
		}
	}
	
	/**
	 * 测试查询...
	 */
	public function testQuery(){
		$datas = $this->data;
		array_pop($datas); 
		foreach ($datas as $value){
			$result = $this->service->save($value);
		}
		$where = '';
		$where = array('subject' => 'a');
		$result = $this->service->query($where);
		$this->assertEquals(true,$result->statu);
	}
	
	/**
	 * 测试根据id数组获取数据...
	 */
	public function testGetByIds(){
		$_REQUEST['ids'] = array(1,2,3,4);
		$result = $this->service->getByIds($_REQUEST);
		$this->assertEquals(true,$result->statu);
	}
	
	/**
	 * 测试获取总数...
	 */
	public function testTotalRows(){
		$datas = $this->data;
		array_pop($datas); 
		foreach ($datas as $value){
			$result = $this->service->save($value);
		}
		$where = array('department_id'=>'1');
		$result = $this->service->totalRows($where);
		$this->assertEquals(true,$result->statu);
	}
	
	/**
	 * 测试根据疾病id获取...
	 */
	public function testGetByDisease(){
		$datas = $this->data;
		array_pop($datas); 
		foreach ($datas as $value){
			$result = $this->service->save($value);
		}
		$result = $this->service->getByDisease(1);
		$this->assertEquals(true,$result->statu);
	}
	
	/**
	 * 测试根据科室获取...
	 */
	public function testGetByDepartmentID(){
		$datas = $this->data;
		array_pop($datas); 
		foreach ($datas as $value){
			$result = $this->service->save($value);
		}
		$result = $this->service->getByDepartmentID(1,1,8,'desc');
		$this->assertEquals(true,$result->statu);
	}
	
	/**
	 * 获取热点文章测试...
	 */
	public function testGetByClick(){
		$limit = 6;
		$result = $this->service->getByClick($limit);
		$this->assertEquals($limit,count($result));
	}
	
	/**
	 * 测试根据其他条件获取...
	 */
	public function testOtherRows(){
		$result = $this->service->otherRows();
		$this->assertTrue(true);
	}
	
	/**
	 * 测试根据各种条件获取 ...
	 */
	public function testGetRecommend(){
		$ids = array(1,2,3,4);
		$result = $this->service->getRecommend('subject',array(1,2,3,4),'desr');
		if ($result){
			$this->assertTrue(true);
		}
	}
	
	/**
	 * 测试获取相关数据...
	 */
	public function testGetAssociatedData(){
		$result = $this->service->getAssociatedData();
		$this->assertTrue(true);
	}
	
	/**
	 *测试获得统计...
	 */
	public function testGetStat(){
		$para = array('end_time'=>time(),'start_time'=>time()-3600);
		$result = $this->service->getStat($para);
		$this->assertTrue(true);
	}
	
	/**
	 * 测试删除...
	 */
	public function testDeleteBatch(){
		$datas = $this->data;
		array_pop($datas);
		foreach ($datas as $value){
			$result = $this->service->save($value);
		}
		$ids = array();
		foreach ($datas as $val){
			$result = R::getAll("select id from article where subject='" . $val->subject . "'");
			$ids[] = $result[0]['id'];
		}
		//添加一个测试文件
		if( count( $ids ) >= 1 ){
			$filename = GENERATEPATH . 'article/' . $ids[0] . '.html';
			file_put_contents($filename, 'test');
			//echo $filename;
		}
		for ($i=0;$i<=3;$i++){
				switch ($i){
					case 0:
						$id = 123;
						$code = 130;
						break;
					case 1:	
						$id = array('');
						$code = 7;
						break;
					case 2:
						$id = array('aaaa');
						$code = 131;
						break;
					case 3:
						$id = $ids;
						break;	 	
				}
				try {
					$result = $this->service->deleteBatch($id);
					$this->assertEquals(true,$result->statu);
				}catch (Exception $e){
					$this->assertEquals($code, $e->getCode());
				}
			}	
	}
	
	/**
	 * 初始化测试数据
	 */
	protected function initData() {
		$data1 = array('subject'=>'a', 'content'=> 'aaa', 'isbidding'=>'0', 'department_id'=>'1', 'disease_id'=>'1','doctor_id'=>'1','is_top'=>'0');
        $data2 = array('subject'=>'b', 'content'=> 'bbb', 'isbidding'=>'0', 'department_id'=>'1', 'disease_id'=>'1','doctor_id'=>'1','is_top'=>'0');
        $data3 = array('subject'=>'c', 'content'=> 'ccc', 'isbidding'=>'0', 'department_id'=>'1', 'disease_id'=>'1','doctor_id'=>'1','is_top'=>'0');
        $data4 = array('subject'=>'d', 'content'=> 'ddd', 'isbidding'=>'0', 'department_id'=>'1', 'disease_id'=>'1','doctor_id'=>'1','is_top'=>'0');
        $data5 = array('subject'=>'e', 'content'=> 'eee', 'isbidding'=>'0', 'department_id'=>'1', 'disease_id'=>'1','doctor_id'=>'1','is_top'=>'0');
        $data6 = array('subject'=>'f', 'content'=> 'fff', 'isbidding'=>'0', 'department_id'=>'1', 'disease_id'=>'1','doctor_id'=>'1','is_top'=>'0');
        $data7 = array('subject'=>'g', 'content'=> 'ggg', 'isbidding'=>'0', 'department_id'=>'1', 'disease_id'=>'1','doctor_id'=>'1','is_top'=>'0');
        $data8 = array('subject'=>'h', 'content'=> 'hhh', 'isbidding'=>'0', 'department_id'=>'1', 'disease_id'=>'1','is_top'=>'0');
		
		$article1 = $this->fillEntity(new Article(), $data1);
		$article2 = $this->fillEntity(new Article(), $data2);
		$article3 = $this->fillEntity(new Article(), $data3);
		$article4 = $this->fillEntity(new Article(), $data4);
		$article5 = $this->fillEntity(new Article(), $data5);
		$article6 = $this->fillEntity(new Article(), $data6);
		$article7 = $this->fillEntity(new Article(), $data7);
		$article8 = $this->fillEntity(new Article(), $data8);

		return array($article1,$article2,$article3,$article4,$article5,$article6,$article7,$article8);
	}
	
	/**
	 * 封装数据到对象
	 */
	protected function fillEntity($article, $data) {
		foreach ($article as $key => $value) {
			if (isset($data[$key]))
			    $article->$key = $data[$key];
		}
		return $article;
	}
}