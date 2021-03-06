<?php

class RecommendPositionService extends BaseService {

    /**
     * 构造函数
     */
    public function __construct() {
        $this->dao = new RecommendPositionDAO();
    }

    /**
     * 获取推荐位置数据
     *
     * @return multitype:Recommendposition
     */
    public function getList() {
        return $this->dao->getList();
    }

    /**
     * 根据名称获取数据
     *
     * @param unknown_type $name
     */
    public function getByName($name,$is_tomobile='') {
        return $this->dao->getByName($name,$is_tomobile);
    }
}
