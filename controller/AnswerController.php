<?php

/**
 * 在线问答模块问题回答流程控制器
 * @author Administrator
 *
 */
class AnswerController extends Controller {

    private $service = null;

    private $tag = null;

    /**
     * 构造方法
     * 实例化基类并实例化service层,并将其赋值给service属性
     */
    public function __construct() {
        parent::__construct();
        $this->service = new AnswerService();
        // .载入标签解析以及smarty基础
        require_once ABSPATH . '/dynapage/Tag.php';
        require_once ABSPATH . '/lib/smarty/Smarty.class.php';
    }

    /**
     * 数据sql以及数据验证、登录、日志方法添加并验证
     *
     * @see controller/Controller::filter()
     */
    public function filter() {
        $filterService = new FilterService();
        $filterService->addFunc($filterService::$SQLINJECTION);
        $filterService->addFunc($filterService::$WORKERISLOGIN);
        $filterService->addFunc($filterService::$FILERPLUSHTIME);
        $filterService->addFunc($filterService::$WORKERLOGHISTORY);
        return $filterService->execute();
    }

    /**
     * 问题回答方法::save
     */
    public function save() {
        // 数据实体绑定
        $this->blindParams($answer = new Answer());
        $result=$this->service->save($answer);
        fb($result);
         $push=$this->getRequest('push', $default = 0); 
         $askid=$this->getRequest('askID', $default = 0);
         

        global $controller;
        $controller->notify('NOTIFY_ASK_SAVE',array('push'=>$push,'askid'=>$askid,'type'=>1,'content'=>$_REQUEST['content']));
        // 问题回答添加并输出
        die(json_encode($result));
    }

    /**
     * 删除某个(或多个)在线问题
     */
    public function delete() {
        $ids = null;
        $askIDS = array();
        // 提交数据为数组还是单个删除
        $ids = $_REQUEST['id'];
        if (is_array($ids)) { // 数组
            $askIDS = $ids;
        } else {
            $askIDS = array(
                $ids
            ); // 数组单个
        }
        // 删除并输出删除结果
        die(json_encode($this->service->delete($askIDS)));
    }

    /**
     * 修改问题答案方法,单个回答的修改::update
     */
    public function update() {
        // 数据实体绑定
        $this->blindParams($answer = new Answer());
        // 数据提交更新
        die(json_encode($this->service->update($answer)));
    }

    /**
     * 生成问答首页静态页面
     */
    public function createIndex() {
        // 实例化tag,并将问答首页的模版路径传进去
        $this->tag = new Tag('ask/index');
        $this->tag->init();
        // 判断以及生成文件夹是否存在
        global $folder;
        $dirPath = GENERATEPATH . $folder['ask'];
        if (! is_dir($dirPath)) {
            if (! mkdir($dirPath)) {
                die(json_encode(new Result(false, 47, ErrorMsgs::get(47), NULL))); // 文件夹不存在且生成失败
            }
        }
        // 判断是否有写入权限
        if (! is_writable($dirPath)) {
            die(json_encode(new Result(false, 109, ErrorMsgs::get(109), NULL))); // 文件夹没有写入权限
        }
        // 数据注入问题列表、科室列表等等...
        $ask = new AskService();
        $askList = $ask->query(array());
        $this->tag->smarty->assign('list', $askList->data); // 提问问题列表
        unset($askList);
        // 模版解析
        $content = $this->tag->assginVarsAndDisplay(NULL);
        // 文件写入
        $htmPath = $dirPath . '/' . 'index' . '.' . 'html';
        if ((int) file_put_contents($htmPath, $content) <= 0) {
            die(json_encode(new Result(false, 49, ErrorMsgs::get(49), NULL))); // html文件生成失败
        }
        // 输出
        die(json_encode(new Result(true, 0, '', NULL)));
    }

    /**
     * 获取问答追问记录
     */
    public function getAskAddto() {	

        // 获取answer_id，通过这个id获取到这个问题下所有的追问与回复
        $answerID = $_REQUEST['answerID'];
        $Result = $this->service->getAskAddto($answerID);
      
        $addToHtml = '';
        if (isset($_REQUEST['from']) && $_REQUEST['from'] == 'admin') {
            // 获取并输出数据
            foreach ($Result as $key => $value) {
            	$Result[$key]->plushtime = date('Y-m-d H:i:s', $value->plushtime);
            }
 //            global $controller;
//          $push=$this->getRequest('push', $default = 0); 
         
         
             //$controller->notify('NOTIFY_ASK_ADDTO',array('push'=>$push));
            die(json_encode(new Result(true, 0, '', $Result)));
        }
        
        foreach ($Result as $key => $value) {
            //由于改变了js调用方式，故前台模板页面若出现问题，可能需要作以下操作：
            //引用js路径改变: /hcc/js/boyicms/ask.js
            //调用方式用gAsk.XXX();
            if ($value->mode == 1) {
                $addToHtml .= "<li class='re zw'><span>追问：</span>" . $value->info . "<a class='zwhf' onclick='return ask_hf(".$value->id.");'>回复</a></li>";
                $addToHtml .= "<li class='re zw' style='display:none;' id='hf_textarea_".$value->id."'><textarea></textarea><input onclick='return ask_hf_tj(".$value->id.");' type='button' value='提交' /></li>";
            } else {
                $addToHtml .= "<li class='re hf'><span>回复：</span>" . $value->info . "<a class='hfzw' onclick='return ask_zw(".$value->id.");'>&nbsp;</a></li>";
                $addToHtml .= "<li class='re hf' style='display:none;' id='zw_textarea_".$value->id."'><textarea></textarea><input onclick='return ask_zw_tj(".$value->id.");' type='button' value='提交' /></li>";
            }
        }

        // 获取并输出数据
        die(json_encode(new Result(true, 0, '', $addToHtml)));
    }
   
}
