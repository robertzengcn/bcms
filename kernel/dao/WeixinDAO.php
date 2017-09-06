<?php
class WeixinDAO extends DBBaseDAO{
	
	public function __construct() {
        parent::__construct();
    }
    
    /**
     * 根据tag获取token...
     */
    public function getTokenByTag($entity){
    	$array = R::find('accesstoken',"tag='".$entity->tag."'");
    	foreach ($array as $bean){
    		$entity->generateFromRedBean($bean);
    	}
    }
    
    /**
     * 保存token...
     */
    public function saveToken($entity){
    	$bean = R::dispense('accesstoken');
    	$entity->generateRedBean($bean);
    	$insertId = R::store ( $bean );
		$entity->generateFromRedBean ( $bean );
		return true;
    }
    
    /**
     * 修改token...
     */
    public function updateToken($entity){
    	$bean = R::load('accesstoken', $entity->id);
    	$entity->generateRedBean($bean);
        $entity->id= R::store($bean);
        return true;
    }
    
    /**
     * 获取微信总数...
     */
    public function getCountWeixin($where){
    	DTExpression::like('weixinname', $where);
    	$count = R::count('weixin',DTExpression::$sql,DTExpression::$params);
    	return $count;
    }
    
    /**
     * 保存微信到数据库...
     */
    public function saveWeixin($entity){
    	$bean = R::dispense('weixin');
    	$this->remPic( 'save' , $entity , null );
		$entity->generateRedBean($bean);
		$insertId = R::store ( $bean );
		$entity->generateFromRedBean ( $bean );
		return $entity;
    }
    
    /**
     * 获取微信...
     */
    public function getListWeixin($where){
    	DTExpression::like('weixinname', $where);
        DTExpression::page($where);
        DTOrder::asc('id');
        $sql = DTExpression::$sql . DTOrder::$sql . DTExpression::$limit;
        $beans = R::find('weixin',$sql,DTExpression::$params);
		$array = array();
    	foreach($beans as $bean){
    		if ($bean->pic != '' && ! preg_match("/auth/i", $bean->tag)){
    			$bean->pic = UPLOAD.$bean->pic;
    		}
    		$weixin = new Weixin();
    		$weixin->generateFromRedBean($bean);
    		$array[] = $weixin;
    	}
    	return $array;
    }
    
    /**
     * 根据id进行查询微信...
     */
    public function getWeixinByName($weixinname){
        DTExpression::eq('weixinname', $weixinname);
        return R::findOne('weixin', DTExpression::$sql, DTExpression::$params);
    }
    
    /**
     * 根据id进行查询微信...
     */
    public function getWeixinById($entity){
    	$bean = R::load('weixin', $entity->id);
        $entity->generateFromRedBean($bean);
    }
    
    /**
     * 删除微信...
     */
    public function deleteWeixin($ids){
    	$beans = R::batch('weixin', $ids);
    	foreach ($beans as $value){
    		@unlink(ABSPATH.'/weixindb/'.$value->tag.'_sub.json');
    		@unlink(ABSPATH.'/weixindb/'.$value->tag.'_keywords.json');
    		@unlink(ABSPATH.'/weixindb/'.$value->tag.'_clickCount.json');
    		//删除accesstoken表中相关内容
    		$token = R::find('accesstoken',"tag='".$value->tag."'");
    		//删除mediaid表中内容
    		$medias = R::find('mediaid',"tag='".$value->tag."'");
    		//删除message表中内容
    		$messages = R::find('message',"tag='".$value->tag."'");
    		//删除关注者表中的数据
    		$users = R::find('attention',"tag='".$value->tag."'");
    		$this->beginTrans();
    		try{
    			R::trashAll($token);
    			R::trashAll($medias);
    			R::trashAll($messages);
    			R::trashAll($users);
    			$this->commitTrans();
    		}catch (Exception $e){
    			$this->rollbackTrans();
    			return false;
    		}
    	}
    	$this->remPic( 'deleteBatch' , null , $beans );
    	R::trashAll($beans);
    	return true;
    }
	
	/**
	 * 将上传的素材返回的相关信息添加到数据库...
	 */
	public function addMediaId($entity){
		$bean = R::dispense ('mediaid');
		$entity->generateRedBean($bean);
		$insertId = R::store ( $bean );
		$entity->generateFromRedBean ( $bean );
		if (! isset ( $insertId ) || $insertId == 0) {
			return false;
		}
		return $entity;
	}
	
	/**  修改素材*/
	public function updateMediaId($entity){
	    $bean = R::load('mediaid', $entity->id);
	    $entity->generateRedBean($bean);
	    $entity->id= R::store($bean);
	    return true;	    
	}
		
	
	
	/**
	 * 删除素材...
	 */
	public function delMessageById($ids){
	    $beans = R::batch('mediaid', $ids);
	    R::trashAll($beans);
	    return true;
	}
	
	/**
	 * 获取素材 根据id...
	 */
	public function getMessageById($id){
    	$bean = R::load('mediaid', $id);
    	$media = new MediaId();
        $media->generateFromRedBean($bean);
        return $media;
	}
	
	/**
	 * 根据thumb_media_id获取素材信息...
	 */
	public function getMaterialByMid($thumb_media_id){
	    DTExpression::$params = array();
        DTExpression::$limit = '';
        DTExpression::$sql = ' 1=1 ';
        DTOrder::$sql = '';
	    DTExpression::eq('thumb_media_id', $thumb_media_id);
	    $bean = R::findOne('mediaid', DTExpression::$sql, DTExpression::$params);
	    $media = new MediaId();
	    $media->generateFromRedBean($bean);
	    return $media;
	}
	
	/**
	 * 根据media_id获取素材信息...
	 */
	public function getMaterialByMediaid($media_id){
	    DTExpression::$params = array();
	    DTExpression::$limit = '';
	    DTExpression::$sql = ' 1=1 ';
	    DTOrder::$sql = '';
	    DTExpression::eq('media_id', $media_id);
	    $bean = R::findOne('mediaid', DTExpression::$sql, DTExpression::$params);
	    $media = new MediaId();
	    $media->generateFromRedBean($bean);
	    return $media;
	}
	
	/**
	 * 根据filename获取素材信息...
	 */
	public function getMaterialByFileName($filename, $type){
	    DTExpression::eq('filename', $filename);
	    $bean = R::findOne('mediaid', DTExpression::$sql, DTExpression::$params);
	    $media_id = $type . '_media_id';
	    return array('media_id'=>$result->$media_id, 'url'=>$result->filename);
	}
	
	/**
	 * 获取素材 根据title...
	 */
	public function getMessageByTitle($title){
		$arr = array();
    	$array = R::find('mediaid',"title like '%".$title."%'");   	
		foreach ($array as $bean){
		    $media = new MediaId();
			$media->generateFromRedBean($bean);		
			$arr[] = $media;
		}		
        return $arr; 
	}
	
	
	
	/**
	 * 根据类型来获取相关的所有素材...
	 */
	public function getByType($type){
		$beans = R::findAll('mediaid',"type='{$type}' and tag='".WEIXIN_TAG."'");
		$array = array();
		foreach ($beans as $bean){
			if (time()-$bean->created_at >= 259200){
				$arr = array_reverse(explode('/', $bean->filename));
				$file = ABSPATH.'/'.$arr[3].'/'.$arr[2].'/'.$arr[1].'/'.$arr[0];
				if (file_exists($file)){
					@unlink($file);
				}
				R::trash($bean);
			}else{
				$media = new MediaId();
				$media->generateFromRedBean($bean);
				$array[] = $media;
			}
		}
		return $array;
	}
	
	/**
	 * 保存关键词到数据库...
	 */
	/*public function saveKeys($entity){
		$bean = R::dispense ('keywords');
		$entity->generateRedBean($bean);
		$entity->id = R::store ( $bean );
		if ($entity->id){
			return true;
		}else{
			return false;
		}
	}*/
	
	/**
	 * 将对应的回复图文信息保存到数据库...
	 */
	/*public function saveAmpnews($entity){
		$bean = R::dispense ('ampnews');
		$entity->generateRedBean($bean);
		$entity->id = R::store ( $bean );
		return true;
	}*/
	
	/**
	 * 查询出所有的关键词...
	 */
	/*public function getAllKeys(){
		$beans = R::findAll('keywords');
		$array = array();
		foreach ($beans as $bean){
			$keywords = new Keywords();
			$keywords->generateFromRedBean($bean);
			$array[] = $keywords;
		}
		return $array;
	}*/
	
	/**
	 * 删除所有关键词...
	 */
	/*public function deleteAllKeys(){
		$keysBeans = R::findAll('keywords');
		$ampBeans = R::findAll('ampnews');
		R::trashAll($keysBeans);
		R::trashAll($ampBeans);
		return true;
	}*/
	
	/**
	 * 根据id删除关键词...
	 */
	/*public function deleteKeyById($id){
		$bean = R::load('keywords', $id);
		R::trash($bean);
		return true;
	}*/
	
	/**
	 * 根据msgid获取数据...
	 */
	public function getMsgByMid($entity){
		$array = R::find('message',"msgid='{$entity->msgid}' and fromusername='{$entity->fromusername}' and tag='".WEIXIN_TAG."'");
		foreach ($array as $bean){
			$entity->generateFromRedBean($bean);
		}
		return $entity;
	}
	

	/**
	 * 将消息添加到表中...
	 */
	public function addToMsg($entity){
		$bean = R::dispense('message');
		$entity->generateRedBean($bean);
		$entity->id = R::store($bean);
		return true;
	}
	
	/**
	 * 获取所有的消息...
	 */
	public function getAllMsg(){
		if ($_REQUEST['page'] && $_REQUEST['size']){
			$start = ((int)$_REQUEST['page']-1)*(int)$_REQUEST['size'];
			$size = (int)$_REQUEST['size'];
			$beans = R::findAll('message',"tag='".WEIXIN_TAG."' limit {$start},{$size}");
		}else{
			$beans = R::findAll('message',"tag='".WEIXIN_TAG."'");
		}
		$array = array();
		foreach ($beans as $bean){
			if(time()-$bean->createtime>=432000){
				if ($bean->msgtype == 'voice' || $bean->msgtype == 'video'){
					if ($bean->msgtype == 'voice'){
						$file = $bean->msgid.'.amr';
					}else{
						$file = $bean->msgid.'.mp4';
					}
					$filename = ABSPATH.'/template_c/temporaryPic/weixin/'.$file;
					if (file_exists($filename)){
						@unlink($filename);
					}
				}
				R::trash($bean);
			}else{
				$message = new Message();
				$message->generateFromRedBean($bean);
				$array[] = $message;
			}
		}
		return $array;
	}
	
	/**
	 * 获取消息总数...
	 */
	public function getCountMsg(){
		$count = R::count('message',"tag='".WEIXIN_TAG."'");
		return $count;
	}
	
	/**
	 * 修改信息...
	 */
	public function updateStatu($entity){
		$array = R::find('message',"msgid={$entity->msgid} and fromusername='{$entity->fromusername}' and tag='".WEIXIN_TAG."'");
		foreach ($array as $value){
			$bean = $value;
		}
		$bean->isreply = 1;
		R::store($bean);
		return true;
	}
	
	/**
	 * 将关注者保存到数据库...
	 */
	public function saveUser($entity){
		$bean = R::dispense('attention');
		$entity->generateRedBean($bean);
		R::store($bean);
		return true;
	}
	
	/**
	 * 获取表中所有用户...
	 */
	public function getAllUsers($where){
		DTExpression::page($where);
		$beans = R::find('attention',"tag='".WEIXIN_TAG."' ".DTExpression::$limit);
		$arr = array();
		foreach ($beans as $bean){
			$attention = new Attention();
			$attention->generateFromRedBean($bean);
			$arr[] = $attention;
		}
		return $arr;
	}
	
	/**
	 * 删除表中的关注者...
	 */
	public function deleteUser($entity){
		$bean = R::load('attention', $entity->id);
		R::trash($bean);
		return true;
	}
	
	/**
	 * 获取关注者表中数据总数...
	 */
	public function getCountUser(){
		$count = R::count('attention',"tag='".WEIXIN_TAG."'");
		return $count;
	}
	
	/**
	 * 删除表...
	 */
	public function dropTable($data){
		if(is_array($data)){
			foreach ($data as $value){
				R::exec($value);
			}
		}else{
			R::exec($data);
		}
		return true;
	}
	
	/**
	 * 根据关键词id获取对应的图文内容...
	 */
	/*public function getAmpnewByKid($kid){
		$beans = R::find('ampnews','keywordid='.$kid);
		$array = array();
		foreach ($beans as $bean){
			$Ampnews = new Ampnews();
			$Ampnews->generateFromRedBean($bean);
			$array[] = $Ampnews;
		}
		return $array;
	}*/
}