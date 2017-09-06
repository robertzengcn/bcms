<?php

/**
 * 医院简介DAO
 *
 * @author Administrator
 *
 */
class IntroduceDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_INTRODUCE;
    }

    /**
     * 获取医院简介
     *
     * @return class:Introduce
     */
    public function get($id = '', $entity = '') {
        $introduceBean = R::findOne($this->tableName);
        $introduce = new Introduce();
        $introduce->generateFromRedBean($introduceBean);

        return $introduce;
    }
}
