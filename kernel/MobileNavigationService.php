<?php
/* 移动端导航管理 */
class MobileNavigationService extends BaseService {

    /**
     * 构造函数
     */
    public function __construct() {
        $this->dao = new MobileNavigationDAO();
    }

    /**
     * 批量删除
     *
     * @param array $array(id,...)
     * @return boolean
     */
    //public function deleteBatch($ids) {
        //return $this->dao->deleteBatch($ids);
    //}

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
            $navigation = new MobileNavigation();
            $this->dao->get($value->pid, $navigation);
            $value->pid = ($navigation->id == 0) ? "无" : $navigation->subject;
        }

        return $this->success($navigations);
    }
    
    public function querySub($where) {
        $navigations = $this->dao->query($where);
        return $this->success($navigations);
    }
    /**
     * 查询(导航组)
     * Enter description here ...
     * @param $where
     */
    public function queryGroup($where) {
    	$navgroup = $this->dao->queryGroup($where);
    	return $this->success($navgroup);
    }
    
    /**
     * 查询(组成员)
     * Enter description here ...
     * @param $where
     */
    public function getGroup($where) {
    	$navgroups = $this->dao->getGroup($where);
    	foreach ($navgroups as $value) {
    		$MobileNavigation = new MobileNavigation();
    		$this->dao->get($value->pid, $MobileNavigation);    		
    		$value->pid = ($MobileNavigation->id == 0) ? "无" : $MobileNavigation->subject;
    	}    	
    	return $this->success($navgroups);
    }
    
    /**
     * 删除(导航组)
     * @param array $array(id,...)
     * @return boolean
     */
    public function deleteBatch($ids) {
    	$this->dao->deleteGroup($ids);
    	return $this->dao->deleteBatch($ids);
    }
    
    /**
     * 删除(组成员)
     * @param array $array(id,...)
     * @return boolean
     */
    public function deleteInfo($ids) {
    	return $this->dao->deleteBatch($ids);
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
    	$fxed = '';
    	switch ( $_REQUEST['func'] ){
    		case 'mobile':$fxed    = 'mobile/';break;
    		case 'app':$fxed    = 'app/';break;
    		case 'wechat':$fxed = 'wechat/';break;
    	}    	
        $url = array();
        $url[] = array(
            'name' => '站点首页',
            'url' => $fxed.'index.php'
        );
        $url[] = array(
            'name' => '科室/疾病',
            'url' => 'departments'
        );       
        $url[] = array(
            'name' => '文章列表',
            'url' => $fxed.'article.php'
        );
        $url[] = array(
            'name' => '在线问答',
            'url' => $fxed.'ask.php'
        );        
        $url[] = array(
        	'name' => '医院设备',
        	'url' => $fxed.'device.php'
        );
        $url[] = array(
            'name' => '医院医生',
            'url' => $fxed.'doctor.php'
        );
        $url[] = array(
            'name' => '医院环境',
            'url' => $fxed.'environment.php'
        );
        $url[] = array(
            'name' => '医院简介',
            'url' => $fxed.'introduce.php?method=getInfo'
        );
        $url[] = array(
            'name' => '医院荣誉',
            'url' => $fxed.'honor.php'
        );
        $url[] = array(
            'name' => '媒体新闻',
            'url' => $fxed.'news.php'
        );
        $url[] = array(
            'name' => '在线预约',
            'url' => $fxed.'reservation.php'
        );
        $url[] = array(
            'name' => '医疗案例',
            'url' => $fxed.'success.php'
        );        
        $url[] = array(
        	'name' => '特色技术',
        	'url' => $fxed.'technology.php'
        );
        $url[] = array(
        	'name' => '联系方式',
        	'url' => $fxed.'contact.php?method=getRoute'
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
    	$fxed = '';
    	switch ( $_REQUEST['func'] ){
    		case 'mobile':$fxed    = 'mobile/';break;
    		case 'app':$fxed    = 'app/';break;
    		case 'wechat':$fxed = 'wechat/';break;    	}
    	
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
                    $url[$key]['url'] = $fxed.'article.php?method=query&department_id=' . $value['id'];
                }
                break;
            case 'disease':
                foreach ($diseaseArrays as $key => $value) {
                	$url[$key]['id'] = $value['id'];
                    $url[$key]['name'] = $value['name'];
                    // 遍历科室，寻找对应的url前缀
                    foreach ($departmentArrays as $k => $v) {
                        if ($v['id'] == $value['department_id']) {
                            $url[$key]['url'] = $fxed.$v['url'] . '/' . $value['url'] . '/index.html';
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
     * 添加
     */
    public function save($navgroup) {
    	//非导航组的时候,需要进行的操作
    	if( $navgroup->is_group == 0 ) {
	        if( $navgroup->url != '' ){
	    		if( substr( $navgroup->url , 0 , 1 ) == '/' ){
	    			$navgroup->url = substr( $navgroup->url , 1 , strlen($navgroup->url)-1 );
	    		}
	    	}
	        if ($navgroup->pid == "0") {
	            $navgroup->layer = 0;
	        } else {
	            $nav = new MobileNavigation();
	            $nav->id = $navgroup->pid;
	            $this->get($nav);
	            $navgroup->layer = $nav->layer + 1;
	        }
    	}
        $this->dao->save($navgroup);
        return $this->success();
    }

    /**
     * 更新
     *
     * @param Entity $navigation
     * @return Result
     */
    public function update($navgroup) {
    	//非导航组的时候,需要进行的操作
    	if( $navgroup->is_group == 0 ) {
	    	if( $navgroup->url != '' ){
	    		if( substr( $navgroup->url , 0 , 1 ) == '/' ){
	    			$navgroup->url = substr( $navgroup->url , 1 , strlen($navgroup->url)-1 );
	    		}
	    	}
	        if ($navgroup->pid == "0") {
	            $navgroup->layer = 0;
	        } else {
	            $nav = new Navgroup();
	            $nav->id = $navgroup->pid;
	            $this->get($nav);
	            $navgroup->layer = $nav->layer + 1;
	        }
    	}
        return $this->dao->update($navgroup);
    }
}
