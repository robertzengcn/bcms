<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-9-28
 * Time: 下午2:07
 */
class OptimizeController extends Controller {

    /**
     * 构造函数 初始化service
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * 过滤(non-PHPdoc)
     *
     * @see Controller::filter()
     */
    function filter() {
        $filterService = new FilterService();
        $filterService->addFunc($filterService::$SQLINJECTION);
        $filterService->addFunc($filterService::$WORKERISLOGIN);
        $filterService->addFunc($filterService::$WORKERLOGHISTORY);

        return $filterService->execute();
    }

    /**
     * 调用deletePic函数删除图片
     * 返回信息给前端
     */
    function optimizePic() {
        $this->deletePic(COMPILEDIR . 'temporaryPic/');

        echo json_encode(new Result(true, 0, '', null));
    }

    /**
     * 清除指定文件夹内的非文件夹文件
     *
     * @param $dir //要清除文件的文件夹路径
     *
     */
    private function deletePic($dir) {
        if (is_dir($dir)) {
            $dh = opendir($dir);
            while (false !== ($file = readdir($dh))) {

                if ($file != "." && $file != "..") {
                    $fullpath = $dir . "/" . $file;

                    if (! is_dir($fullpath)) {
                        unlink($fullpath);
                    } else {
                        $this->deletePic($fullpath);
                    }
                }
            }

            closedir($dh);
        }
    }
}
