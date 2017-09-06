<?php

class UserVarService extends BaseService {

    /**
     * 构造函数
     */
    public function __construct() {
        $this->dao = new UserVarDAO();
    }

    /**
     * 批量删除
     *
     * @param array $array(id,...)
     * @return boolean
     */
    public function deleteBatch($ids) {
        Entity::isIds($ids); // 验证ids是否合法

        return $this->dao->deleteBatch($ids);
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     * @return Result
     */
    public function query($where) {
        $userVars = $this->dao->query($where);

        return $this->success($userVars);
    }

    /**
     * 保存数据
     *
     * @param Entity $uservar
     * @return Result
     */
    public function save($uservar) {
        $uservar->validate();
        // 获取class对象并插入数据
        $this->dao->save($uservar);

        return $this->success();
    }

    /**
     * 获得模板
     */
    public function getTpl() {
        $tpl = ABSPATH . '/tpl/config.json';
        $con = file_get_contents($tpl);
        $con = json_decode($con);
        $tplNum = $con[0]->currentUsed;
        $tpl = ABSPATH . '/tpl/' . $tplNum . '/template';
        if (! file_exists($tpl)) {
            return $this->fail(52, ErrorMsgs::get(52));
        }

        $data = array();
        $dir = opendir($tpl);
        while ($file = readdir($dir)) {
            if ($file != '.' && $file != '..') {
                $con = file_get_contents($tpl . '/' . $file);
                $data = $data + (array) json_decode($con);
            }
        }

        if (! $data) {
            return $this->fail(50, ErrorMsgs::get(50));
        }

        return $this->success($data);
    }

    /**
     * 取得变量值
     */
    public function getUserVar() {
        $result = $this->dao->getByPid($_REQUEST['pid'], $_REQUEST['kind']);

        $userVars = array();
        foreach ($result as $key => $value) {
            $userVar = new UserVar();
            $userVar->generateFromRedBean($value);
            if ($userVar->type == 'pic') {
                $userVar->src = UPLOAD . $userVar->val;
            }
            $userVars[] = $userVar;
        }

        return $this->success($userVars);
    }

    /**
     * 保存自定义字段
     */
    public function saveUserVar() {
        foreach ($_REQUEST['name'] as $key => $value) {
            $userVar = new UserVar();
            $userVar->pid = $_REQUEST['pid'];
            $userVar->name = $_REQUEST['name'][$key];
            $userVar->val = $_REQUEST['val'][$key];
            $userVar->var_name = $_REQUEST['var_name'][$key];
            $userVar->kind = $_REQUEST['kind'];
            $userVar->type = $_REQUEST['type'];

            $this->save($userVar);
        }

        return $this->success();
    }

    /**
     * 根据pid清除自定义字段
     */
    public function clearByPid() {
        $result = $this->dao->clearByPid($_REQUEST['pid'], $_REQUEST['kind']);

        return $result;
    }

    /**
     * 修改变量配置值
     */
    public function mdfVar($para) {
        $tempUserVar = new UserVar();
        $this->dao->get($para[0], $tempUserVar);
        /*
         * if ($tempTechnology->id == 0) { return new Result ( false, 9, ErrorMsgs::get ( 9 ), NULL ); }
         */
        $tempUserVar->val = $para[1];

        return $this->dao->update($tempUserVar);
    }
}
