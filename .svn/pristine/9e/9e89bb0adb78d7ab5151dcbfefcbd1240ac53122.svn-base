<?php

class SpiteIPDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_SPITEIP;
    }

    public function getSpite() {
        $res = R::find($this->tableName);
        $arr = array();
        foreach ($res as $bean) {
            $entity = new SpiteIP();
            $entity->generateFromRedBean($bean);
            $count = R::count('trendip', "ip='{$entity->ip}' and times-{$entity->times}<={$_REQUEST['lastT']}");
            if ($count >= $_REQUEST['lastC']) {
                $entity->count = $count;
                $arr[] = $entity;
            }
        }
        return $arr;
    }
}