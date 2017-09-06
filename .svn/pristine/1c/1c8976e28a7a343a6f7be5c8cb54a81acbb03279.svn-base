<?php

/**
 * 在线问答(追问)service服务层
 * @author Administrator
 *
 */
class AskAddtoService extends BaseService {

    /**
     * 构造方法
     * 实例化基类并实例化dao数据表处理层,并将其赋值给dao属性
     */
    public function __construct() {
        parent::__construct();
        $this->dao = new AskAddtoDAO();
    }

    /**
     *
     *
     * 在线问题追问与回复
     *
     * @param object $askAddto
     */
    public function addto($askAddto) {
        // 数据补充
        $this->dataSupply($askAddto);
        // 验证是否已回答(没有回答的问题是不能进行追问或者回复的)
        $answerService = new AnswerService();
        if ($answerService->answerExist($askAddto) === true) {
            return $this->fail(0, '该问题尚未回答,无法进行追问或回复!');
        }
        // 数据提交
        $Result = $this->dao->save($askAddto);
        $answerService = new AnswerService();
        $answerService->updateHtml($askAddto->askID);
        // 执行问答总控追问回复提交
        include_once GENERATEPATH . 'interface/hwibsc/answer.php';
        new AnswerGet( $askAddto , 'addto' );
        // 修改推荐位
        if (! empty($_REQUEST['recommendposition'])) {
            $recommendList = new RecommendListService();
            $recommendList->deleteById('ask_id', $askAddto->askID);
            foreach ($_REQUEST['recommendposition'] as $value) {
                $recommend = new RecommendList();
                $recommend->recommendposition_id = $value;
                $recommend->ask_id = $askAddto->askID;
                $recommendList->save($recommend);
            }
        }
        return $Result;
    }

    /**
     *
     *
     * 数据补充，补充当前登录用户id,顶,踩,时间等基础数据
     *
     * @param object $askAddto
     * @return boolean true || false
     */
    public function dataSupply($askAddto) {
        $askAddto->plushtime = time();
        $askAddto->useful = 0;
        $askAddto->useless = 0;
        return true;
    }
}