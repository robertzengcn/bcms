<?php
class NavgroupService extends BaseService {

    /**
     * 构造函数
     */
    public function __construct() {
        $this->dao = new NavgroupDAO();
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
	            $nav = new Navgroup();
	            $nav->id = $navgroup->pid;
	            $this->get($nav);
	            $navgroup->layer = $nav->layer + 1;
	        }
	        //将相对路径拼接为绝对路径
	       $navgroup->url = $this->neataddress_url( $navgroup->url );
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
	        //将相对路径拼接为绝对路径
	        $navgroup->url = $this->neataddress_url( $navgroup->url );
    	}
        return $this->dao->update($navgroup);
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
            $navgroup = new Navgroup();
            $dao=new NavgroupDAO();
            $dao->get($value->pid, $navgroup);            
            $value->pid = ($navgroup->id == 0) ? "无" : $navgroup->subject;
        }          
        return $this->success($navgroups);
    }
    
    /** 查询 不处理pid */
    public function querySub($where) {
    	$navgroups = $this->dao->getGroup($where);    	
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
     * 通过ID查询记录
     *
     * @param Entity $navigation
     * @return Result
     */
    public function get($navgroup) {
        $this->dao->get($navgroup->id, $navgroup);
        return $this->success($navgroup);
    }
    
    /**
     * 通过flag查询导航组所有的组成员
     */
    public function getFlag($flag) {
    	return $this->dao->getFlag($flag);
    }
    
    /**
     * 通过flag查询导航组的名字
     */
    public function getName($flag) {
    	return $this->dao->getName($flag);
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
