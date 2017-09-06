<?php

class ShopService extends BaseService {

    /**
     * 构造函数
     */
    public function __construct() {
        $this->dao = new NavigationDAO();
    }

    /**
     * 批量删除
     *
     * @param array $array(id,...)
     * @return boolean
     */
    public function deleteBatch($ids) {
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
        $navigations = $this->dao->query($where);
        foreach ($navigations as $value) {
            $navigation = new Navigation();
            $this->dao->get($value->pid, $navigation);
            $value->pid = ($navigation->id == 0) ? "无" : $navigation->subject;
        }

        return $this->success($navigations);
    }

    /** 查询 不处理pid */
    public function querySub($where) {
        $navigations = $this->dao->query($where);
        return $this->success($navigations);
    }    
    /**
     * 获得一条数据
     *
     * @param Entity $navigation
     * @return Result
     */
    public function get($navigation) {
        $this->dao->get($navigation->id, $navigation);
        $this->dao->getNameByUrl($navigation);

        return $this->success($navigation);
    }

    /**
     * 获取所有
     *
     * @return Result
     */
    public function getNavigation() {
        $navigations = $this->dao->getNavigation();

        return $this->success($navigations);
    }

    /**
     * 获取静态url列表
     *
     * @return Result
     */
    public function getHtmlUrl() {
        $url = array();
        $url[] = array(
            'name' => '网站首页',
            'url' => 'index.html'
        );
        /*$url[] = array(
            'name' => '科室列表',
            'url' => 'departments'
        );*/
        $url[] = array(
            'name' => '科室/疾病',
            'url' => 'departments'
        );
       /* $url[] = array(
            'name' => '科室封面',
            'url' => 'departments/index.html'
        );
        $url[] = array(
            'name' => '疾病封面',
            'url' => 'disease/index.html'
        );
        $url[] = array(
            'name' => '医生封面',
            'url' => 'doctor/index.html'
        );*/
        $url[] = array(
            'name' => '医院简介',
            'url' => 'hospital/introduce.html'
        );
        $url[] = array(
            'name' => '医院动态',
            'url' => 'hospital/news/index.html'
        );
        $url[] = array(
            'name' => '媒体报道',
            'url' => 'hospital/media/index.html'
        );
        $url[] = array(
            'name' => '医院荣誉',
            'url' => 'hospital/honor/index.html'
        );
        $url[] = array(
            'name' => '医疗设备',
            'url' => 'hospital/device/index.html'
        );
        $url[] = array(
            'name' => '医院环境',
            'url' => 'hospital/environment/index.html'
        );        
        $url[] = array(
            'name' => '经典案例',
            'url' => 'hospital/success/index.html'
        );
        $url[] = array(
				'name' => '科室医生',
				'url' => 'doctor'
		);
        $url[] = array(
            'name' => '联系方式',
            'url' => 'hospital/contact.html'
        );
        $url[] = array(
            'name' => '专题封面',
            'url' => 'topic/index.html'
        );        
		$url[] = array(
        		'name' => '医院技术',
        		'url' => 'technology/index.html'
        );		
		$url[] = array(
        	'name' => '个性频道',
        	'url' => 'channel'
        );
        return $this->success($url);
    }

    /**
     * 获取静态url by para
     *
     * @return Result
     */
    public function getHtmlUrlByPara() {
        // 获取所有科室
        $departmentArrays = $this->dao->getDepartments();
        // 获取所有疾病
        $diseaseArrays = $this->dao->getDisease();        
        // 初始化变量
        $url = array();
        switch ($_REQUEST['op']) {
            case 'departments':
                foreach ($departmentArrays as $key => $value) {
                	$url[$key]['id'] = $value['id'];
                    $url[$key]['name'] = $value['name'];
                    $url[$key]['url'] = '' . $value['url'] . '/index.html';
                }
                break;
            case 'disease':
                foreach ($diseaseArrays as $key => $value) {
                	$url[$key]['id'] = $value['id'];
                    $url[$key]['name'] = $value['name'];
                    $url[$key]['parent'] = $value['parent_id'];
                    // 遍历科室，寻找对应的url前缀
                    foreach ($departmentArrays as $k => $v) {
                        if ($v['id'] == $value['department_id']) {
                            $url[$key]['url'] = $v['url'] . '/' . $value['url'] . '/index.html';
                        }
                    }
                }
                break;
            default:
                $url = array();
                break;
        }

        return $this->success($url);
    }

    /**
     * 保存数据
     *
     * @param Entity $navigation
     * @return Result
     */
    public function save($navigation) {
        if( $navigation->url != '' ){
    		if( substr( $navigation->url , 0 , 1 ) == '/' ){
    			$navigation->url = substr( $navigation->url , 1 , strlen($navigation->url)-1 );
    		}
    	}
        $navigation->validate();
        if ($navigation->pid == "0") {
            $navigation->layer = 0;
        } else {
            $nav = new Navigation();
            $nav->id = $navigation->pid;
            $this->get($nav);
            $navigation->layer = $nav->layer + 1;
        }
        //将相对路径拼接为绝对路径
        $navigation->url = $this->neataddress_url( $navigation->url );
        // 获取class对象并插入数据
        $this->dao->save($navigation);
        return $this->success();
    }

    /**
     * 更改数据
     *
     * @param Entity $navigation
     * @return Result
     */
    public function update($navigation) {
    	if( $navigation->url != '' ){
    		if( substr( $navigation->url , 0 , 1 ) == '/' ){
    			$navigation->url = substr( $navigation->url , 1 , strlen($navigation->url)-1 );
    		}
    	}
        $navigation->validate();
        if ($navigation->pid == "0") {
            $navigation->layer = 0;
        } else {
            $nav = new Navigation();
            $nav->id = $navigation->pid;
            $this->get($nav);
            $navigation->layer = $nav->layer + 1;
        }
        //将相对路径拼接为绝对路径
        $navigation->url = $this->neataddress_url( $navigation->url );
        return $this->dao->update($navigation);
    }
    
    /**
     * 自动拼接导航中的绝对路径
     * @param string $url
     */
    private function neataddress_url( $url = '' ){
    	if( $url == '' ){
    		return '';
    	}
    	$temp_url = strtolower( $url );
    	if( substr($temp_url,0,7) == 'http://' ){
    		return $url;
    	}else if( substr($temp_url,0,8) == 'https://' ){
    		return $url;
    	}else if( substr($temp_url,0,6) == 'ftp://' ){
    		return $url;
    	}
    	return NETADDRESS . '/' . $url;
    }
}
