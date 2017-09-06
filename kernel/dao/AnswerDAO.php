<?php

/**
 *
 * ask在线问答dao层
 * @author Administrator
 *
 */
class AnswerDAO extends DBBaseDAO {

    /**
     * 构造方法
     */
    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_ANSWER;
    }

    /**
     * 通过ask_id查找是否存在对应的记录,并返回这个记录
     *
     * @param object $answer
     *            answer数据实体对象
     * @return object
     */
    public function answerExist($answer) {
        DTExpression::eq('ask_id', array(
            'ask_id' => $answer->askID
        ), $this->tableName);
        $dataObject = $this->getByOne(ORMMap::$classes[$this->tableName], DTExpression::$sql);
        return $dataObject;
    }

    /**
     *
     *
     * 获取某个在线问题回答下的所有追问与追问回复记录
     *
     * @param int $answerID
     *            问题id
     */
    public function getAskAddto($answerID) {
        $all = R::findAll(TABLENAME_ASKADDTO, 'ans_id = ' . $answerID);
        $arr = array();
        foreach ($all as $k => $bean) {
            $entity = new Answer();
            $entity->generateFromRedBean($bean);
            $arr[] = $entity;
        }
        return $arr;
    }

    /**
     *
     *
     * 通过askID获取联合数据，包括问题、问题详情、问题答案等
     *
     * @param int $id
     */
    public function getAnswerInfo($askID) {
        DTExpression::eq('id', array(
            'id' => $askID
        ), TABLENAME_ASK);
        $sql = ORMMap::$sqlMap['ask_repeat'] . ' where ' . DTEXPRESSION::$sql . DTExpression::$limit;
        return $this->getJoin($sql);
    }

    /**
     *
     *
     * 清除ask表数据
     *
     * @param array $askIDS
     */
    public function deleteAskBatch($askIDS = array()) {
        $batchs = R::batch(TABLENAME_ASK, $askIDS);
        return $this->deleteBeans($batchs);
    }

    /**
     *
     *
     * 清除askdesc表数据
     *
     * @param array $askIDS
     */
    public function deleteAskDescBatch($askIDS = array()) {
        $batchs = R::find(TABLENAME_ASKDESC, "ask_id in ( " . implode(',', $askIDS) . " )");
        return $this->deleteBeans($batchs);
    }

    /**
     *
     *
     * 清除answer数据
     *
     * @param array $askIDS
     */
    public function deleteAnsWerBatch($askIDS = array()) {
        $batchs = R::find(TABLENAME_ANSWER, "ask_id in ( " . implode(',', $askIDS) . " )");
        return $this->deleteBeans($batchs);
    }

    /**
     *
     *
     * 清除assay化验单数据
     *
     * @param array $askIDS
     */
    public function deleteAskAssayBatch($askIDS = array()) {
        $batchs = R::find(TABLENAME_ASKASSAY, "ask_id in ( " . implode(',', $askIDS) . " )");
        return $this->deleteBeans($batchs);
    }

    /**
     *
     *
     * 清除askaddto数据
     *
     * @param array $askIDS
     */
    public function deleteAskAddto($askIDS = array()) {
        $batchs = R::find(TABLENAME_ASKADDTO, "ask_id in ( " . implode(',', $askIDS) . " )");
        return $this->deleteBeans($batchs);
    }
}
