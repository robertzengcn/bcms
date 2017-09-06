<?php
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
require_once ROOT . '/web-setting.php';
require_once ABSPATH . '/controller/Controller.php';
require_once DAOPATH . 'DTExpression.php';
require_once DAOPATH . 'DTOrder.php';
require_once DAOPATH . 'ORMMap.php';
require_once ABSPATH . '/lib/smarty/Smarty.class.php';
require_once KERNELPATH . 'Result.php';

spl_autoload_register(array(
    'Controller',
    'load'
));

/**
 * 对smarty进行配置
 *
 * @return Smarty
 */
function init_smarty() {
    $smarty = new Smarty();
    $smarty->setPluginsDir(PLUGINSDIR_SMARTY);
    $smarty->setTemplateDir(TEMPDIR);
    $smarty->setcompileDir(COMPILEDIR);
    $smarty->setCacheDir(CACHEDIR);
    $smarty->left_delimiter = LEFT_LIMITER;
    $smarty->right_delimiter = RIGHT_LIMITER;
    $content = file_get_contents(ABSPATH . '/dynapage/tagobjects.json');
    $array = json_decode($content, true);
    foreach ($array as $value) {
        $classname = $value['obj'];
        $file = ABSPATH . '/tagobj/' . $classname . '.php';
        if (file_exists($file)) {
            $object = new $classname();
            $smarty->assign($classname, $object);
        }
    }
    return $smarty;
}


/**
 * 网页动态呈现
 *
 * @param unknown_type $path
 */
function display($path) {
    $smarty = init_smarty();
    // 获取所有的tag对象传人到模版

    $smarty->display($path);
}

function displayList($array, $path) {
    $smarty = init_smarty();
    foreach ($array as $key => $value) {
        $smarty->assign($key, $value);
    }
    $smarty->display($path);
}