<?php

class StatisticsLogService extends BaseService {

    /**
     * 构造函数
     */
    public function __construct() {
        $this->dao = new StatisticsLogDAO();
    }

    /**
     * 批量删除
     *
     * @return boolean
     */
    public function deleteBatch() {
        return $this->dao->clear();
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     * @return Result
     */
    public function query($where) {
        $query = $this->dao->query($where);
        foreach ($query as $key => $value) {
            $value->visittime = date('Y-m-d H:i:s', $value->visittime);
        }

        return $this->success($query);
    }

    /**
     * 保存数据
     *
     * @param Entity $statisticsLog
     * @return Result
     */
    public function save($statisticsLog) {
        $statisticsLog->validate();

        if (! isset($statisticsLog->visittime) || $statisticsLog->visittime == '') {
            $statisticsLog->visittime = time();
        }
        if (! isset($statisticsLog->sessionid) || $statisticsLog->sessionid == '') {
            $statisticsLog->sessionid = session_id();
        }
        // 获取class对象并插入数据
        $this->dao->save($statisticsLog);

        return $this->success();
    }

    /**
     * 获得昨日下的流量
     *
     * @param array $para
     */
    public function getYes($data) {
        $totalRows = $this->dao->getYes($data);

        return $this->success($totalRows);
    }

    /**
     * 获得各种情况下的总数
     *
     * @param array $para
     * @return Result
     */
    public function getStat() {
        $data = array();
        $data['url'] = NETADDRESS . '/html/' . $_REQUEST['dir'] . '/' . $_REQUEST['id'] . '.html';
        // 获得昨日时间
        $today = date('Y-m-d', time());
        $time = strtotime($today);
        $data['yestoday_start'] = $time - 24 * 3600;
        $data['yestoday_end'] = $time - 1;

        // 获得本周时间
        if (date('w') == 0) {
            $week = mktime(0, 0, 0, date('m'), date('d') - 6, date('y'));
        } else {
            $week = mktime(0, 0, 0, date('m'), date('d') - date('w') + 1, date('y'));
        }
        $data['week_start'] = $week;
        $data['week_end'] = $week + 7 * 24 * 3600 - 1;

        $totalRows = $this->dao->getStat($data);

        switch ($_REQUEST['dir']) {
            case 'news':
                $totalRows['title'] = '医院动态';
                break;
            case 'article':
                $totalRows['title'] = '咨询文章';
                break;
            case 'success':
                $totalRows['title'] = '案例文章';
                break;
            case 'technology':
                $totalRows['title'] = '特色技术';
                break;
        }
        $totalRows['title'] = $totalRows['title'] . '本周内的流量占总数的百分比';

        $num = number_format($totalRows['week_ttl'] / $totalRows['ttl'], 4);
        $num = number_format($num * 100, '2');
        $other = 100 - $num;
        $other = number_format($other, '2');
        $totalRows['data'] = array(
            array(
                '其他',
                intval($other)
            ),
            array(
                'name' => $totalRows['title'],
                'y' => intval($num),
                'sliced' => true,
                'selected' => true
            )
        );

        return $this->success($totalRows);
    }

    /**
     * 获取流量趋势
     *
     * @return Result
     */
    public function trend() {
        // 默认今天
        $starTime = strtotime(date('Y-m-d', time()));
        $endTime = strtotime(date('Y-m-d'), time()) + 86399;

        if (isset($_REQUEST['star']) && $_REQUEST['star'] != '') {
            $starTime = strtotime($_REQUEST['star']);
        }
        if (isset($_REQUEST['end']) && $_REQUEST['end'] != '') {
            $endTime = strtotime($_REQUEST['end']) + 86399;
        }
        if (isset($_REQUEST['dir']) && $_REQUEST['dir'] != '' && isset($_REQUEST['id']) && $_REQUEST['id'] != '') { // 文章页
            $url = NETADDRESS . '/html/' . $_REQUEST['dir'] . '/' . $_REQUEST['id'] . '.html';
        } elseif (isset($_REQUEST['dir']) && $_REQUEST['dir'] == 'index') { // 首页
            $url = NETADDRESS . '/html/index.html';
        } elseif (isset($_REQUEST['dir']) && $_REQUEST['dir'] != '') { // 列表页
            $url = NETADDRESS . '/html/' . $_REQUEST['dir'] . '/' . 'index.html';
        } else {
            $url = '';
        }
        
        $array = array();
        for ($i = $starTime; $i <= $endTime;) {
            $j = $i + 86400;
            $num = $this->dao->trend($i, $j, $url);
            $array['pv'][] = $num['fwnum'];
            $array['uv'][] = $num['dlnum'];
            $array['ip'][] = $num['ipnum'];
            $array['key'][] = date('Y-m-d', $i);
            $i = $j;
        }
        return $this->success($array);
       
    }

    /**
     * 今日新老访客分布
     *
     * @return Result
     */
    public function distributed() {
        // 默认今天
        $starTime = strtotime(date('Y-m-d'));
        $endTime = strtotime(date('Y-m-d', strtotime('+1 day')));

        if (isset($_REQUEST['star']) && $_REQUEST['star'] != '') {
            $starTime = strtotime($_REQUEST['star']);
        }
        if (isset($_REQUEST['end']) && $_REQUEST['end'] != '') {
            $endTime = strtotime($_REQUEST['end']);
        }

        $distributed = $this->dao->distributed($starTime, $endTime);

        $num = $distributed['oldnum'] + $distributed['newnum'];
        if ($num == 0) {
            $oldnum = 0;
            $newnum = 0;
        } else {
            $oldnum = number_format($distributed['oldnum'] / $num, 4);
            $newnum = number_format($distributed['newnum'] / $num, 4);
        }

        $oldnum = number_format($oldnum * 100, '2');
        $newnum = number_format($newnum * 100, '2');

        $totalRows = array(
            array(
                'name' => '老访客',
                'y' => intval($oldnum),
                'x' => $distributed['oldnum'],
                'sliced' => true,
                'selected' => true
            ),
            array(
                'name' => '新访客',
                'y' => intval($newnum),
                'x' => $distributed['newnum'],
                'sliced' => true,
                'selected' => true
            )
        );

        return $this->success($totalRows);
    }
    
    /**
     * 今日新老访客分布曲线数据
     *
     * @return Result
     */
    public function distributedByLine() {
        // 默认今天
        $starTime = strtotime(date('Y-m-d'));
        $endTime = strtotime(date('Y-m-d', strtotime('+1 day')));
    
        if (isset($_REQUEST['star']) && $_REQUEST['star'] != '') {
            $starTime = strtotime($_REQUEST['star']);
        }
        if (isset($_REQUEST['end']) && $_REQUEST['end'] != '') {
            $endTime = strtotime($_REQUEST['end']);
        }
    
        $data = $this->dao->distributedByLine($starTime, $endTime);
        return $this->success($data);
    }

    /**
     * 来路域名TOP10(按来访次数)
     *
     * @return Result
     */
    public function selFrom() {
        $selFrom = $this->dao->selFrom();
        foreach ($selFrom as $key => $value) {
            if ($value['fromurl'] == '') {
                $selFrom[$key]['fromurl'] = '直接输入网址或书签';
            }
        }

        return $this->success($selFrom);
    }

    /**
     * 受访页面TOP10(按浏览次数)
     *
     * @return Result
     */
    public function selTo() {
        $selTo = $this->dao->selTo();

        return $this->success($selTo);
    }
}
