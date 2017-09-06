<?php

class PluginDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
    }

    public function installSql($sqlContent) {
        R::exec($sqlContent);
        return true;
    }
}
