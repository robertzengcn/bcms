<?php
include_once '../support.php';
require_once ENTITYPATH . "MediaReport.php";
require_once DAOPATH . "MediaReportDao.php";
require_once '../MediaReportService.php';
require_once '../TagService.php';
require_once DAOPATH.'TagDAO.php';
require_once ENTITYPATH.'Tag.php';
$_SESSION["id"] = 1;
$_SESSION['group'] = 2;
/**
 * 图片测试类
 */
class MediaReportServiceTest extends PHPUnit_Framework_TestCase {
    private $service = null;
    private $data = null;

    /**
     * 测试前准备
     */
    public function setUp() {
        $this->service = new MediaReportService();
        $this->data = $this->initData();
    }

    /**
     * 测试后数据还原
     */
    public function tearDown() {
        $ids = array();
        foreach ($this->data as $mediaReport) {
            $rs = R::getAll("select id from mediareport where subject='" . $mediaReport->subject . "'");
            if (!empty($rs)) {
                $ids[] = $rs[0]['id'];
            }
        }

        $this->service->deleteBatch($ids);
    }




    /**
     *
     * 测试获取一条媒体报道
     */

    public function testGet(){
        //添加初始数据
        $_REQUEST ['tags'] = 'abc,cbd,dde';
        foreach ($this->data as $mediaReport) {
            $this->service->save($mediaReport);
        }

        foreach($this->data as $key => $mediaReport){
            $code = '';
            switch($key){
                case 0:
                    break;
                case 1:
                    $mediaReport->id = '';
                    $code = 67;
                    break;
                default:
                    break;
            }
            try {
                $result = $this->service->get($mediaReport);
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
        $_REQUEST ['tags'] = 'abc,cbd,dde';
        foreach ($this->data as $key => $mediaReport) {
            $code = '';
            switch($key){
                case 0:
                    break;
                case 1:
                    $mediaReport->subject = '';
                    $code = 6;
                    break;
                case 2:
                    $mediaReport->content = '';
                    $code = 5;
                    break;
                case 3:
                    $mediaReport->plushtime = '';
                    break;
                case 4:
                    $mediaReport->updatetime='';
                    break;

            }
            try {
                $result = $this->service->save($mediaReport);
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
        $_REQUEST ['tags'] = 'abc,cbd,dde';
        //添加初始数据
        foreach ($this->data as $mediaReport) {
            $this->service->save($mediaReport);
        }

        //开始修改
        foreach ($this->data as $key => $mediaReport) {
            $code = '0';
            //初始化修改数据
            switch ($key) {
                case '0': //正常修改
                    $mediaReport->subject = '媒体报道11';
                    $mediaReport->pic = 'aabb.jpg';
                    $mediaReport->source = '媒体source';
                    $mediaReport->content = '媒体内容1';
                    $mediaReport->click_count = '121';
                    $mediaReport->title = '媒体标题';
                    $mediaReport->keywords = 'SEO标题1';
                    $mediaReport->description = 'SEO描述';
                    $mediaReport->plushtime = '1396509000';
                    $mediaReport->updatetime = '1410325000';
                    break;
                case '1':  //名称为空，预期会throw异常code=19，返回false
                    $mediaReport->subject = '';
                    $code = 6;
                    break;
                case '2': //url为空，预期会throw异常code=94，返回false
                    $mediaReport->content = '';
                    $code = 5;
                    break;
                case '3':
                    $mediaReport->plushtime = '';
                    break;
                case '4':
                    $mediaReport->updatetime = '';
                    break;
                case '5':
                    $mediaReport->id = '';
                    break;
            }

            try {
                $result = $this->service->update($mediaReport);
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
        $_REQUEST ['tags'] = 'abc,cbd,dde';
        foreach ($this->data as $mediaReport) {
            $this->service->save($mediaReport);
        }
        //开始删除
        $ids = array();

        foreach ($this->data as $mediaReport) {
            $rs = R::getAll("select id from mediaReport where subject='" . $mediaReport->subject . "'");
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
        $_REQUEST ['tags'] = 'abc,cbd,dde';
        //添加初始数据
        foreach ($this->data as $mediaReport) {
            $this->service->save($mediaReport);
        }

        for ($i=0; $i<4; $i++) {
            if ($i==0) { //where为空数组，返回所有
                $where = array();
            } elseif ($i==1) { //where为空串，返回所有
                $where = '';
            } elseif ($i==2) { //字段任意，匹配不到，返回所有
                $where = array(
                    'subject' => 'abc',
                );
            } elseif ($i==3) {
                $where = array(
                    'content' => '123'
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
        $data1 = array('subject'=>'subject1', 'pic'=> '', 'source'=>'source1',  'content'=>'keywords1', 'title'=>'title1','keywords'=>'keywords1','description'=>'description1');
        $data2 = array('subject'=>'subject2', 'pic'=> '', 'source'=>'source2', 'content'=>'keywords2', 'title'=>'title2','keywords'=>'keywords2','description'=>'description2');
        $data3 = array('subject'=>'subject3', 'pic'=> '', 'source'=>'source3', 'content'=>'keywords3', 'title'=>'title3','keywords'=>'keywords3','description'=>'description3');
        $data4 = array('subject'=>'subject4', 'pic'=> '', 'source'=>'source4', 'content'=>'keywords4', 'title'=>'title4','keywords'=>'keywords4','description'=>'description4');
        $data5 = array('subject'=>'subject5', 'pic'=> '', 'source'=>'source5', 'content'=>'keywords5', 'title'=>'title5','keywords'=>'keywords5','description'=>'description5');
        $data6 = array('subject'=>'subject6', 'pic'=> '12.jpg', 'source'=>'source6', 'content'=>'keywords6', 'title'=>'title6','keywords'=>'keywords6','description'=>'description6');


        $mediaReport1 = $this->fillEntity(new MediaReport(), $data1);
        $mediaReport2 = $this->fillEntity(new MediaReport(), $data2);
        $mediaReport3 = $this->fillEntity(new MediaReport(), $data3);
        $mediaReport4 = $this->fillEntity(new MediaReport(), $data4);
        $mediaReport5 = $this->fillEntity(new MediaReport(), $data5);
        $mediaReport6 = $this->fillEntity(new MediaReport(), $data6);


        return array($mediaReport1, $mediaReport2, $mediaReport3, $mediaReport4, $mediaReport5,$mediaReport6);
    }

    /**
     * 封装数据到对象
     */
    protected function fillEntity($mediaReport, $data) {
        foreach ($mediaReport as $key => $value) {
            if (isset($data[$key]))
                $mediaReport->$key = $data[$key];
        }
        return $mediaReport;
    }
}
