<?php
/**
 * 
 * 资讯tag标签
 * @author Administrator
 *
 */
class ChannelArticleTag extends CommonTag {
	
	/**
	 * 
	 * 构造方法
	 */
	function __construct() {
		$this->service = new ChannelArticleService ();
		parent::__construct( get_class() );
	}
	
	/**
	 * 
	 * 根据页码获取对应的数据
	 * {{foreach $tagOb->getList($cur) as $v}}
	 * {{/foreach}}
	 * @param  int $current  当前页
	 * @param  boolean $sort 排序规则,true为时间降序
	 * @return array list
	 */
	public function getList($current,$sort = true, $limit = '') {
		#.第几页
		$current   = (int)$current <= 0 ? 0 : (int)$current - 1;
		#.查询总条数
		$count  = $this->service->totalRows ( array ('1' => 1 ) )->data;
		#.分页数
		$pageCount = ceil( $count / $this->tagConfig['pageSize']);
		#.组合条件进行数据查询
		$limit = $limit == '' ? $this->tagConfig['pageSize'] : $limit;
		$limit = array ("page" => $current, "size" => $limit );
		$field = '*';
		$where = array ('1' => 1 );
		$order = $sort === true ? "plushtime desc" : "plushtime asc";
		$data = $this->getPage ( $field, $where, $limit, $order );
		return $data;
	}
	
	/**
	 * 
	 * 根据页码获取分页html
	 * {{$tagOb->getPageHtml($cur)}}
	 * @param int $current 当前页
	 */
	public function getPageHtml($current , $channel_id , $dir, $size = '',$show_position) {
		#.第几页
		$current   = (int)$current <= 0 ? 0 : (int)$current - 1;
		#.查询总条数
		$count  = $this->service->totalRows ( array ('channel_id' => $channel_id , 'show_position' =>$show_position) )->data;
		#每页显示条数
		$size = empty($size) ? $this->tagConfig['pageSize'] : $size;
		#.生成html信息
		return $this->setPageHtml($current, $size , $count , $dir);
	}
	
	/**
	 * 
	 * 根据唯一id获取该id的详细信息
	 * {{$news = $tagOb->get($id)}}
	 * @param int $id 唯一id
	 */
	public function get($id) {
		$id = (int)$id <= 0 ? 0 : (int)$id;
		$where = array( "id" => $id );
		$result = $this->service->findOne( $where , '*' );
		$entity = new ChannelArticle();
		$entity->generateFromRedBean($result);
		return $entity;
	}
	
	/**
	 * 根据频道id获取文章
	 */
	public function getByChannelID($channelId,$page='',$size=''){
		$where = array();
		$where['channel_id'] = $channelId;
		$page = $page == '' ? 1 : $page;
		$size = $size == '' ? $this->tagConfig['pageSize'] : $size;
		$where['page'] = $page;
		$where['size'] = $size;
		$data = $this->service->getByChannelID($where)->data;
		return $data;
	}
	
	/**
	 * 根据频道name获取文章
	 */
	public function getByChannelName($channelname,$page='',$size=''){
		$channelservice->service = new ChannelService ();
		$thedate=array('name' => $channelname);
		$chandetail=$channelservice->service->query($thedate);
		$chanobj=$chandetail->data;		
		$thenum=$chanobj[0]->id;
		$where = array();
		$where['channel_id'] = $thenum;
		$page = $page == '' ? 1 : $page;
		$size = $size == '' ? $this->tagConfig['pageSize'] : $size;
		$where['page'] = $page;
		$where['size'] = $size;
		$data = $this->service->getByChannelID($where)->data;
		
		return $data;
	}
	
	/**
	 * 根据推荐位置获取频道文章列表 ...
	 * @param unknown_type $recommend_id
	 */
	public function getByRecommend($recommend,$name='channelarticle_id',$is_tomobile=''){
	    if (!is_numeric($recommend)){
	        $position = new RecommendPositionService();
	        $result = $position->getByName($recommend,$is_tomobile);
	        $recommend_id = $result->id;
	    }else{
	        $recommend_id = (int)$recommend <=0 ? 0 : (int)$recommend;
	    }
	    $recommendObj = new RecommendListService();
	    $channelarticles = $recommendObj->getByRecommendID($recommend_id,$name);
	    $resultArr = array();
	    foreach ($channelarticles as $value){        
	        $channelatrs = new ChannelArticle();
	        $channelatrs->id = $value->channelarticle_id;
	        $resultArr[] = $this->service->get($channelatrs)->data;
	        
	    }
	    return $resultArr;
	}
	
	/**
	 * 根据推荐位置以及栏目名获取频道文章列表 ...
	 * @param unknown_type $recommend_id $channelname
	 */
	
	public function getByNameRecommend($recommend,$channelname,$name='channelarticle_id'){
		if (!is_numeric($recommend)){
			$position = new RecommendPositionService();
			$result = $position->getByName($recommend);
			$recommend_id = $result->id;
		}else{
			$recommend_id = (int)$recommend <=0 ? 0 : (int)$recommend;
		}
		$recommendObj = new RecommendListService();
		$channelarticles = $recommendObj->getByRecommendID($recommend_id,$name);
		$resultArr = array();
		foreach ($channelarticles as $value){
			$channelatrs = new ChannelArticle();
			$channelatrs->id = $value->channelarticle_id;
			$resultArr[] = $this->service->get($channelatrs)->data;
			 
		}
		//return $resultArr;
		$channelservice->service = new ChannelService ();
		$thedate=array('name' => $channelname);
		$chandetail=$channelservice->service->query($thedate);
		$chanobj=$chandetail->data;
		$thenum=$chanobj[0]->id;
		$where = array();
		$where['channel_id'] = $thenum;
        
		$result=array();
		$i=0;
		foreach ($resultArr as $key=>$value){
			if($value->channel_id==$thenum){
				$result[$i]=$value;
			}
			$i++;
		}

		return $result;
		
	}
	
    /**
     * 
     * 获取列表 
     */
    public function getChaArtList($sql){
		return $this->service->getJoin ( $sql );
    }   
    /**
     * 
     * 获取表字段 
     */
    public function getChanFields(){
		return $this->service->getFields();
    } 	
}