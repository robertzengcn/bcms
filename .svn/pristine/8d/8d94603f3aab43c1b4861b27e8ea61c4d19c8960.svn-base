<?php

/**
 * 在线问答模块流程控制器
 * @author Administrator
 *
 */
class AskController extends Controller {

    private $service = null;

    /**
     * 构造方法
     * 实例化基类并实例化service层,并将其赋值给service属性
     */
    public function __construct() {
        parent::__construct();
        $this->service = new AskService();
    }

    /**
     * 数据安全验证、登录检测
     *
     * @see controller/Controller::filter()
     */
    public function filter() {
        $filterService = new FilterService();
        $filterService->addFunc($filterService::$SQLINJECTION);
        $filterService->addFunc($filterService::$FILERPLUSHTIME);
        return $filterService->execute();
    }

    /**
     * 在线问题添加方法
     * 由前端页面发起,允许get或者post提交数据
     */
    public function save() {
        // 实例化ask数据实体,并将其进行request参数绑定
        $this->blindParams($ask = new Ask());
        if (empty($ask->show_position)) {
            $ask->show_position = '0';
        } else {
            $ask->show_position = implode(',', $ask->show_position);
        }
        
        // 绑定问答详情数据实体
        $this->blindParams($askDesc = new AskDesc());
        // 绑定化验单数据实体
        $this->blindParams($askAssay = new AskAssay());
        // 执行service新增操作;并将其结果输出
        die(json_encode($this->service->save($ask, $askDesc, $askAssay)));
    }

    /**
     * 分页查询&数据列表
     */
    public function query() {
        $askList = $this->service->query($_REQUEST);
        $totalRows = $this->service->totalRows($_REQUEST);
        
        foreach ($askList->data as $key => $value) {
        	$value->plushtime = date('Y-m-d H:i:s', $value->plushtime);
        	if ($value->isanswer == 1) {
        		$value->answertime = date('Y-m-d H:i:s', $value->answertime);
        	}
        }
        
        die(json_encode(array(
            'rows' => $askList->data,
            'ttl' => $totalRows->data
        )));
    }

    /**
     * 获取回复数据包
     */
    public function getRepeat() {
        $id = $_REQUEST['id']; // ask主键id
        $info = $this->service->getRepeat($id);
        
        $info->plushtime = date('Y-m-d H:i:s', $info->plushtime);
        die(json_encode(new Result(true, 0, '', $info))); // 获取并输出回复联合数据
    }

    /**
     * 获取所有科室信息
     */
    public function getDepartments() {
        die(json_encode($this->service->getDepartments()));
    }

    /**
     * 根据科室ID,获取疾病
     */
    public function getByDepartmentID() {
        die(json_encode($this->service->getByDepartmentID($_REQUEST['department_id'])));
    }
    
    /**
     * 设置问答是否显示
     * */
    public function setDisplay() {
        die(json_encode($this->service->setDisplay($_REQUEST['id'], $_REQUEST['isdisplay'])));
    }
}
