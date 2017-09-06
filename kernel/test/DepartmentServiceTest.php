<?php
include_once '../support.php';
require_once ENTITYPATH . "Department.php";
require_once DAOPATH . "DepartmentDAO.php";
require_once '../DepartmentService.php';
$_SESSION["id"] = 1;
$_SESSION['group'] = 2;
/**
 * 图片测试类
 */
class DepartmentServiceTest extends PHPUnit_Framework_TestCase {
    private $service = null;
    private $data = null;

    /**
     * 测试前准备
     */
    public function setUp() {
        $this->service = new DepartmentService();
        $this->data = $this->initData();
    }

    /**
     * 测试后数据还原
     */
    public function tearDown() {
        $ids = array();
        foreach ($this->data as $department) {
            $rs = R::getAll("select id from department where keywords='" . $department->keywords . "'");
            if (!empty($rs)) {
                $ids[] = $rs[0]['id'];
            }
        }

        $this->service->deleteBatch($ids);
    }

    /**
     *
     * 测试获取科室
     */
     public function testGetDepartments(){
         $this->service->getDepartments();
     }


    /**
     *
     * 测试获取一条科室信息
     */

    public function testGet(){
        //添加初始数据
        foreach ($this->data as $department) {
            $result = $this->service->save($department);
        }

        foreach($this->data as $key => $department){
            $code = '';
            switch($key){
                case 0:
                    break;
                case 1:
                    $department->id = '';
                    $code = 67;
                    break;
            }
            try {
                $result = $this->service->get($department);
                $this->assertEquals(true, $result->statu);
            } catch (ValidatorException $e) {
                $this->assertEquals($code, $e->getCode());
            }

        }
    }
    /**
     * 测试添加
     */
    public function testSave() {
        foreach ($this->data as $key => $department) {
            $code = '';
            switch($key){
                case 0:
                    break;
                case 1:
                    $department->name = '';
                    $code = 67;
                    break;
                case 2:
                    $department->url = '';
                    $code = 68;
                    break;
                case 3:
                    $department->url = '123';
                    $code = 141;
                    break;
            }
            try {
                $result = $this->service->save($department);
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
        foreach ($this->data as $department) {
            $result = $this->service->save($department);
        }

        //开始修改
        foreach ($this->data as $key => $department) {
            $code = '';
            //初始化修改数据
            switch ($key) {
                case '0': //正常修改
                    $department->name = '科室名字1';
                    $department->url = 'aabb';
                    $department->title = '科室标题1';
                    $department->keywords = 'SEO标题1';
                    $department->description = 'SEO描述';
                    $department->tplurl = 'upload/sdfs/kk.htpl';
                    break;
                case '1':  //名称为空，预期会throw异常code=19，返回false
                    $department->name = '';
                    $code = 67;
                    break;
                case '2': //url为空，预期会throw异常code=94，返回false
                    $department->url = '';
                    $code = 68;
                    break;
                case '3':
                    $department->url = '123';
                    $code = 141;
                    break;
                case '4':
                    $department->id = '';
                    break;

            }

            try {

                $result = $this->service->update($department);
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
        foreach ($this->data as $department) {
            $result = $this->service->save($department);
        }
        //开始删除
       $ids = array();
       foreach ($this->data as $department) {
            $rs = R::getAll("select id from department where keywords='" . $department->keywords . "'");
            $ids[] = $rs[0]['id'];
            }
       for ($i=0; $i<6; $i++) {
           $code = '';
           try{
               switch ($i) {
                   case '0'://不是数组，抛异常:code=130
                       $id = '123';
                       $code = 130;
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
                       break;
                   case '5'://正常可删除
                       $id = $ids;
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
        foreach ($this->data as $department) {
            $result = $this->service->save($department);
        }

        for ($i=0; $i<4; $i++) {
            if ($i==0) { //where为空数组，返回所有
                $where = array();
            } elseif ($i==1) { //where为空串，返回所有
                $where = '';
            } elseif ($i==2) { //字段任意，匹配不到，返回所有
                $where = array(
                    'name' => 'abc',
                );
            } elseif ($i==3) {
                $where = array(
                    'url' => '123'
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
     * 初始化测试数据
     */
    protected function initData() {
        $data1 = array('name'=>'name1', 'url'=> 'as', 'title'=>'a', 'keywords'=>'keywords1', 'description'=>'decription1','tplurl'=>'upload/tpl/tpl1.htpl');
        $data2 = array('name'=>'name2', 'url'=> 'b', 'title'=>'a', 'keywords'=>'keywords2', 'description'=>'decription2','tplurl'=>'upload/tpl/tpl2.htpl');
        $data3 = array('name'=>'name3', 'url'=> 'c', 'title'=>'a', 'keywords'=>'keywords3', 'description'=>'decription3','tplurl'=>'upload/tpl/tpl3.htpl');
        $data4 = array('name'=>'name4', 'url'=> 'd', 'title'=>'a', 'keywords'=>'keywords4', 'description'=>'decription4','tplurl'=>'upload/tpl/tpl4.htpl');
        $data5 = array('name'=>'name5', 'url'=> 'e', 'title'=>'a', 'keywords'=>'keywords5', 'description'=>'decription5','tplurl'=>'upload/tpl/tpl5.htpl');
        $data6 = array('name'=>'name6', 'url'=> 'f', 'title'=>'a', 'keywords'=>'keywords6', 'description'=>'decription6','tplurl'=>'upload/tpl/tpl6.htpl');
        $data7 = array('name'=>'name7', 'url'=> 'g', 'title'=>'a', 'keywords'=>'keywords7', 'tplurl'=>'upload/tpl/tpl17.htpl');

        $department1 = $this->fillEntity(new Department(), $data1);
        $department2 = $this->fillEntity(new Department(), $data2);
        $department3 = $this->fillEntity(new Department(), $data3);
        $department4 = $this->fillEntity(new Department(), $data4);
        $department5 = $this->fillEntity(new Department(), $data5);
        $department6 = $this->fillEntity(new Department(), $data6);
        $department7 = $this->fillEntity(new Department(), $data7);

        return array($department1, $department2, $department3, $department4, $department5,$department6,$department7);
    }

    /**
     * 封装数据到对象
     */
    protected function fillEntity($department, $data) {
        foreach ($department as $key => $value) {
            if (isset($data[$key]))
                $department->$key = $data[$key];
        }
        return $department;
    }
}
