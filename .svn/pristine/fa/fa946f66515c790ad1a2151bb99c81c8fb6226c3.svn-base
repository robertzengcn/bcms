<?php

/**
 * 过滤参数Service
 *
 * @author Administrator
 *
 */
class FilterService {

    public static $SQLINJECTION = 'sqlInjection';

    public static $CUSTOMERISLOGIN = 'isLoginCustomer';

    public static $WORKERISLOGIN = 'isLoginWorker';

    public static $FILERPLUSHTIME = 'filterPlushtime';

    public static $WORKERLOGHISTORY = 'workerloghistory';

    private $funcs = Array();

    /**
     * 加到队列
     *
     * @param unknown $funName
     */
    public function addFunc($funName) {
        $this->funcs[] = $funName;
    }

    /**
     * execute
     *
     * @return Result
     */
    public function execute() {
        foreach ($this->funcs as $k => $f) {
            $result = $this->$f();
            if (! $result->statu) {
                return $result;
            }
        }

        return new Result(true, 0, '', NULL);
    }

    /**
     * Sql注入过滤
     *
     * @return Result
     */
    private function sqlInjection() {
        $service = new SQLInjectionService();

        return $service->execute();
    }

    /**
     * 操作日志
     */
    private function workerloghistory() {
        $service = new LogService();
        $service->save(LogMsgs::get($_REQUEST['method']));

        return new Result(true, 0, '', NULL);
    }

    /**
     * 后台登陆验证
     *
     * @return Result
     */
    private function isLoginWorker() {
        if (! isset($_SESSION['is_login']) || ! $_SESSION['is_login']) {
            return new Result ( false, 25, ErrorMsgs::get ( 25 ), -1);
        } else {
            return new Result(true, 0, '', NULL);
        }
    }

    /**
     * 前台登陆验证
     *
     * @return Result
     */
    private function isLoginCustomer() {
        return new Result(true, 0, '', NULL);
    }

    /**
     * 过滤plushtim
     *
     * @return Result
     */
    private function filterPlushtime() {
        if (isset($_REQUEST['start_time']) && $_REQUEST['start_time'] != '') {
            $_REQUEST['start_time'] = strtotime($_REQUEST['start_time']);
        }
        if (isset($_REQUEST['end_time']) && $_REQUEST['end_time'] != '') {
            $_REQUEST['end_time'] = strtotime($_REQUEST['end_time']) + 86499;
        }
        if (isset($_REQUEST['plushtime']) && $_REQUEST['plushtime'] != '') {
            $_REQUEST['plushtime'] = $_REQUEST['plushtime'];
        }

        return new Result(true, 0, '', NULL);
    }
}
