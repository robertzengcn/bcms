<?php

class SpiteIPService extends BaseService {

    public function __construct() {
        $this->dao = new SpiteIPDAO();
    }

    /**
     * 获取恶意IP...
     */
    public function getSpite() {
        $IPs = $this->dao->getSpite();
        return $this->success($IPs);
    }
}