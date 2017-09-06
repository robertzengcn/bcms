<?php

/**
 * 在线问答模块(问题回答)service服务层
 * @author Administrator
 *
 */
class AnswerService extends BaseService {

    /**
     * 构造方法
     * 实例化基类并实例化dao数据表处理层,并将其赋值给dao属性
     */
    public function __construct() {
        parent::__construct();
        $this->dao = new AnswerDAO();
    }

    /**
     *
     *
     * 在线问答问题回答保存
     *
     * @param object $answer
     *            数据实体
     * @throws ValidatorException
     */
    public function save($answer) {
        // 数据补充
        $this->dataSupply($answer);
        // 数据校验
        $answer->validate();
        // 查找ask对象是否存在
        if (! $this->askExist($answer)) {
            return $this->fail(135, ErrorMsgs::get(135));
        }
        // 事务&try
        $this->dao->beginTrans();
        try {
            // 更新ask表
            $this->modifyAnswer($answer);
            // 新增answer回答数据
            $this->dao->save($answer);
            // 更新html文件
            $this->updateHtml($answer->askID);
            $this->dao->commitTrans();
        } catch (ValidatorException $ve) {
            $this->dao->rollbackTrans();
            throw new ValidatorException($ve->getCode());
        } catch (Exception $e) {
            $this->dao->rollbackTrans();
            return $this->fail(0, $e->getMessage());
        }
        
        
         
        // 执行问答总控问题提交
        include_once GENERATEPATH . 'interface/hwibsc/answer.php';
        new AnswerGet( $answer , 'answer' );
        // 增加相关推荐位置
        if (! empty($_REQUEST['recommendposition'])) {
            $recommendList = new RecommendListService();
            foreach ($_REQUEST['recommendposition'] as $value) {
                $recommend = new RecommendList();
                $recommend->recommendposition_id = $value;
                $recommend->ask_id = $answer->askID;
                $recommendList->save($recommend);
            }
        }
        // 执行返回
        return $this->success();
    }

    /**
     *
     *
     * 问题删除操作(批量)
     *
     * @param array $askIDS
     *            id数组
     */
    public function delete($askIDS) {
        Entity::isIds($askIDS); // 验证ids是否合法
        $this->dao->beginTrans();
        try {
            $this->dao->deleteAskBatch($askIDS); // 删除ask数据
            $this->dao->deleteAskDescBatch($askIDS); // 删除askdesc数据
            $this->dao->deleteAnsWerBatch($askIDS); // 删除answer数据
            $this->dao->deleteAskAssayBatch($askIDS); // 删除化验单数据
            $this->dao->deleteAskAddto($askIDS); // 删除追问回复信息
            $this->deleteHtml($askIDS); // 删除html文件
            $this->dao->commitTrans(); // 上述步骤都没有出现异常则进行事务提交
        } catch (ValidatorException $ve) {
            $this->dao->rollbackTrans();
            throw new ValidatorException($ve->getCode());
        } catch (Exception $e) {
            $this->dao->rollbackTrans();
            return $this->fail(0, $e->getMessage());
        }
        return $this->success();
    }

    /**
     *
     *
     * 回答数据修改(一次修改单条,且问题只能修改回答，不能修改提问者的问题)
     *
     * @param object $answer
     *            数据实体
     * @return object $result 返回更新后的数据实体
     */
    public function update($answer) {
        // 数据补充
        $this->dataSupply($answer);
        // 数据校验
        $answer->validate();
        $Result = $this->dao->answerExist($answer); // 问题回答是否存在
        if (! is_object($Result)) {
            return $this->fail(136, ErrorMsgs::get(136));
        }
        $this->dao->beginTrans();
        try {
            // 更新数据包
            $answer->id = $Result->id;
            $answer->askID = $Result->askID;
            $this->dao->update($answer); // 数据更新
            $this->updateHtml($answer->askID); // html文件更新
            $this->dao->commitTrans(); // 事务提交
        } catch (Exception $e) {
            $this->dao->rollbackTrans();
            return $this->fail(0, $e->getMessage());
        }
        return $this->success();
    }

    /**
     *
     *
     * html文件删除方法,遍历并删除该id数组中的所有html文件
     *
     * @param array $askIDS
     *            id数组
     */
    private function deleteHtml($askIDS) {
        // .直接返回true，因为生成以集成到makeHtml
        return true;
        if (is_array($askIDS) && isset($askIDS)) {
            global $folder;
            $dirPath = GENERATEPATH . $folder['ask'];
            foreach ($askIDS as $id) {
                $htmPath = $dirPath . '/' . $id . '.' . 'html';
                if (! file_exists($htmPath)) {
                    continue;
                }
                if (! is_writable($htmPath)) {
                    throw new ValidatorException(0);
                } else {
                    unlink($htmPath);
                }
            }
        }
        return true;
    }

    /**
     * html文件修改方法(如果不存在则创建,否则更新)debug
     *
     * @param
     *            int askID askid主键
     */
    public function updateHtml($askID) {
        // .直接返回true，因为生成以集成到makeHtml
        return true;
        // .实例化tag,并将问答详细页的模版路径传进去
        $this->tag = new Tag('ask/detail');
        $this->tag->init();
        // .判断以及生成文件夹是否存在
        global $folder;
        $dirPath = GENERATEPATH . $folder['ask'];
        if (! is_dir($dirPath)) {
            if (! mkdir($dirPath)) {
                throw new ValidatorException(0);
            }
        }
        // .判断是否有写入权限
        if (! is_writable($dirPath)) {
            throw new ValidatorException(0);
        }
        // .注入在线问题数据(这里可能是一个对象数组,由于暂时不提供多答,则取第一条生成即可)
        $Result = $this->dao->getAnswerInfo($askID);
        // .注入在线问题追问数据(遍历回答,取出各个回答的追问数据)
        foreach ($Result as $key => $value) {
            $Result[$key]->addto = $this->dao->getAskAddto($value->answer_id);
        }
        $this->tag->smarty->assign('subject', $Result[0]->subject);
        $this->tag->smarty->assign('replyData', $Result);
        // .模版解析
        $content = $this->tag->assginVarsAndDisplay(NULL);
        $htmPath = $dirPath . '/' . $askID . '.' . 'html';
        if ((int) file_put_contents($htmPath, $content) <= 0) {
            throw new ValidatorException(0);
        }
        return true;
    }

    /**
     *
     *
     * 根据asnwerid获取对应的追问记录
     *
     * @param int $answerID
     * @return string $addToHtml
     */
    public function getAskAddto($answerID) {
        return $this->dao->getAskAddto($answerID);
    }

    /**
     *
     *
     * 获取单条数据
     *
     * @param object $answer
     */
    public function get($answer) {
        $this->dao->get($answer->askID, $answer);
        return $answer;
    }

    /**
     *
     *
     * 问题回答成功提交后,进行ask表的问题回答时间与回答状态
     *
     * @param object $answer
     * @throws new ValidatorException( 0 ) debug
     * @return boolean true
     */
    private function modifyAnswer($answer) {
        $askService = new AskService();
        if (! is_object($askService->modifyAnswer($answer->askID))) {
            throw new ValidatorException(0);
        }
        return true;
    }

    /**
     *
     *
     * 问题回答数据补充,需要补充父层id、医师id以及补充回答时间
     *
     * @param object $answer
     * @return boolean true || false
     */
    private function dataSupply($answer) {
        $answer->hosID = (int) $answer->hosID <= 0 ? 0 : $answer->hosID; // 医院id
        $answer->docID = (int) $_SESSION['is_login'] === 1 ? (int) $_SESSION['id'] : 0; // 回答医生id
        $answer->plushtime = time(); // 补充回答时间
        $answer->useful = 0; // (顶)
        $answer->useless = 0; // (踩)
        return true;
    }

    /**
     * 是否已回答过这个问题
     *
     * @param object $answer
     *            answer数据实体对象
     * @return boolean true || false
     */
    public function answerExist($answer) {
        $answerInfo = $this->dao->answerExist($answer);
        if (! is_object($answerInfo)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 查找对应的ask是否存在,如果不存在则返回false
     *
     * @param object $answer
     *            answer数据实体对象
     * @return boolean true || false
     */
    private function askExist($answer) {
        $askService = new AskService();
        $askInfo = $askService->getAsk($answer->askID);
        unset($askService);
        if (is_object($askInfo) && $askInfo->id == $answer->askID) {
            return true;
        } else {
            return false;
        }
    }
}