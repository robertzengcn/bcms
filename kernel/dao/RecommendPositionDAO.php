<?php

/**
 * 联系方式DAO
 *
 * @author Administrator
 *
 */
class RecommendPositionDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_RECOMMENDPOSITION;
    }

    /**
     * 获取推荐位置数据
     *
     * @return multitype:Recommendposition
     */
    public function getList() {
        $rs = R::findAll($this->tableName);
        $array = array();
        foreach ($rs as $k => $bean) {
            $entity = new RecommendPosition();
            $entity->generateFromRedBean($bean);
            $array[] = $entity;
        }

        return $array;
    }

    /**
     * 通过名称获取数据...
     *
     * @param unknown_type $name
     */
    public function getByName($name,$is_tomobile='') {
        $sql = "name='{$name}'";
        if ($is_tomobile != '') {
        	$sql .= " and is_tomobile={$is_tomobile}";
        }
        $rs = R::find($this->tableName, $sql);
        foreach ($rs as $v) {
            $entity = new RecommendPosition();
            $entity->generateFromRedBean($v);
        }
        return $entity;
    }
}
