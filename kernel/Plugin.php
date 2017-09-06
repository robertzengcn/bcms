<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/web-setting.php';

class Plugin {

    private $configs = Array();

    function __construct() {
        $this->init();
    }

    function __destruct() {}

    private function init() {
        $dirs = $this->getDirs();
        $this->readAndSaveConfig($dirs);
    }

    private function getDirs() {
        $dir = ABSPATH . '/plugin';
        $handler = opendir($dir);
        while (($filename = readdir($handler)) !== false) {
            if ($filename != "." && $filename != ".." && $filename != ".svn") {
                $files[] = $filename;
            }
        }
        closedir($handler);

        return $files;
    }

    private function readAndSaveConfig($dirs) {
        foreach ($dirs as $dir) {
            $content = file_get_contents(ABSPATH . '/plugin/' . $dir . '/config.json');
            $this->configs[$dir] = json_decode($content);
        }
    }

    function contains($identity) {
        return array_key_exists(identity, $this->configs);
    }

    function loadModle($identity) {
        if (! $this->contains($identity)) {
            return NULL;
        }

        return $this->configs[$identity];
    }

    function loadModleAsJSON($identity) {
        if (! $this->contains($identity)) {
            return NULL;
        }

        return json_encode($this->configs[$identity]);
    }

    function getAll() {
        return $this->configs;
    }

    function getAllAsJSON() {
        return json_encode($this->configs);
    }

    function uninstall($identity) {}

    function getRecommands() {}

    function checkIsBuy() {}
}
