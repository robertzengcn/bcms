<?php
/**
 * 
 * 图片管理tag标签
 * @author Administrator
 *
 */
class PicManagerTag extends CommonTag {
	
	/**
	 * 
	 * 构造方法
	 */
	function __construct() {
		$this->service = new PicManagerService ();
		parent::__construct( get_class() );
	}
	
	/**
	 * 
	 * 获取网站logo信息
	 * @return object $data logo对象信息
	 */
	public function getLogo() {
		$result = $this->service->getByFlag('logo')->data;
		return empty($result) ? $result : $result[0];
	}

    /**
     *
     * 获取网站单图片信息
     * @return object $data logo对象信息
     */
    public function getPic($flag = '') {
        $result = $this->service->getByFlag($flag)->data;

        //$result = $this->service->getByFlag($flag,$date)->data;
        return empty($result) ? $result : $result[0];
    }
    
    /**
     * 获取网站单张图片信息(手机)
     * @param string $flag
     * @return unknown
     */
    public function getMobilePic($flag = '',$cate = 'mobile'){
    	if( $flag == '' || is_null($flag) ){
    		return null;
    	}
    	$where = array();
    	//$where['flag'] = $flag;
    	
    	switch($cate){
    		case 'mobile':$where['cate']=1;break;
    		case 'app':$where['cate']=2;break;
    		case 'wechat':$where['cate']=3;break;
    		//case '':$where['cate']=1;
    		default:$where['cate']=1;break;
    	}
    	$cates=$where['cate'];

    	$this->service = new MobilePicManagerService();

    	$result = $this->service-> getByFlag($flag,$cates)->data;
    	
    	
    	return empty($result) ? $result : $result[0];
    }
    
    /**
     * 获取手机轮播图信息(手机)
     * @param string $flag
     * @return NULL|unknown
     */
    public function getMobileScroll($flag = '',$cate = 'mobile') {
    	if ($flag == '') {
    		return null;
    	}
    	switch($cate){
    		case 'mobile':$where['cate']=1;break;
    		case 'app':$where['cate']=2;break;
    		case 'wechat':$where['cate']=3;break;
    		//case '':$where['cate']=1;
    		default:$where['cate']=1;break;
    	}
    	$cates=$where['cate'];
    	
    	#.查询flag所存在的数据行的pid
    	$this->service = new MobilePicManagerService();
    	$result = $this->service->getByFlag( $flag,$cates )->data;
    	if( isset($result[0]->id) && (int)$result[0]->id > 0 ) {
    		$pid    = $result[0]->id;
    		$picService = new PicService();
    		$picArrays = $picService->query( array( "pid" => $pid ) )->data;
    		if(is_array($picArrays) && count($picArrays) >= 1){
    			foreach($picArrays as $key => $value) {
    				unset($picArrays[$key]->id);
    				unset($picArrays[$key]->pid);
    				unset($picArrays[$key]->sort);
    			}
    		}
    		return $picArrays;
    	}
    	return null;
    }
	
	/**
	 * 
	 * 根据flag获取对应的弹窗html文本
	 * @param string $flag 位置标识符
	 * @return string 文本内容
	 */
	public function getSpecial($flag = '') {
		#.组合文件名并查询对应的文件是否存在
		$htmlFile = ABSPATH . '/tpl/effect/special_' . strtolower( $flag ) . '.html';
		if( file_exists($htmlFile) ) {
			return file_get_contents( $htmlFile );
		}
		return '';
	}
	
	/**
	 * 
	 * 根据位置(标记)获取对应的轮播信息,包含连接\图片\文本
	 * @param unknown_type $flag
	 * @return array&object 对象形式数组
	 */
	public function getScroll($flag = '') {
		if ($flag == '') {
			return null;
		}
		#.查询flag所存在的数据行的pid
		$result = $this->service->getByFlag( $flag )->data;
		if( isset($result[0]->id) && (int)$result[0]->id > 0 ) {
			$pid    = $result[0]->id;
			$picService = new PicService();
			$picArrays = $picService->query( array( "pid" => $pid ) )->data;
			if(is_array($picArrays) && count($picArrays) >= 1){
				foreach($picArrays as $key => $value) {
					unset($picArrays[$key]->id);
					unset($picArrays[$key]->pid);
					unset($picArrays[$key]->sort);
				}
			}
			return $picArrays;
		}
		return null;
	}
}
