<?php

/**
 *
 * show
 * @author Administrator
 *
 */
class ShowDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct(); 
        $this->tableName = TABLENAME_SHOWSCENE;
        $this->sysTableName = TABLENAME_SHOWSYS;
        $this->tagTableName = TABLENAME_SHOWTAG;
        $this->shareTableName = TABLENAME_SHOWSHARE;
		$this->sceneDataTableName = TABLENAME_SHOWSCENEDATA;
        $this->upfileTableName = TABLENAME_SHOWUPFILE;
        $this->scenePageTableName =  TABLENAME_SHOWSCENEPAGE;
        $this->scenePageSysDataTableName = TABLENAME_SHOWSCENEPAGESYS;
		$this->upfilesysTableName = TABLENAME_SHOWUPFILESYS;
    }
   /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     * @return Result
     */
    public function query($where) {
		
		return R::getAll('select * from '.$this->tableName.' where 1=1 and delete_int=0 and userid_int=:userid_int',array(':userid_int'=>$where['userid_int']));	
	}
    /**
     * 获得总数
     *
     * @param array $where
     *            查询条件
     *            return object $arr
     */
    public function totalRows($where) {
        DTExpression::eq('vid', $where);
        return $this->getRecordCount(DTExpression::$sql, DTExpression::$params);
    }
    /**
     * 获取场景信息
     */	
    public function getScenePageList($where) {
			$scenepage = R::getAll(ORMMap::$sqlMap['scenepage'], array(
                ':sceneid_bigint' => $where['sceneid_bigint'],
                ':mytypl_id' => $where['mytypl_id'],
                ':userid_int' => $where['userid_int']
            ));
			return $scenepage;
    }
    /**
     * 获取场景信息2
     */
    public function getScenePageList2($where) {
			$scenepage = R::getAll(ORMMap::$sqlMap['scenepage2'], array(
                ':sceneid_bigint' => $where['sceneid_bigint'],
                ':userid_int' => $where['userid_int']
            ));
			return $scenepage;
    }
    /**
     * 获取场景信息3
     */
    public function getScenePageList3($where) {
    		
        $result = R::findAll($this->scenePageTableName,'sceneid_bigint=:sceneid_bigint and userid_int=:userid_int',$where);
        $sparray = array();
        foreach ($result as $key => $value) {
            if ($value->id != 0) {
                $scenepage = new ShowScenePage();
				if (is_object($value)) {
					foreach ($value as $k => $val) {
						$scenepage->$k = $val;
					}
				}
                $sparray[] = $scenepage;
            }
        }
        return $sparray;
    }
	
	
    public function getScenePageLists($where) {		
			$scenepages = R::getAll(ORMMap::$sqlMap['scenepages'], array(
                ':id' => $where['id'],
                ':userid_int' => $where['userid_int']
            ));	
			return $scenepages;
    }
    public function getSceneList($where) {
			$scene = R::getAll(ORMMap::$sqlMap['scenelist'], array(
                ':id' => $where['id'],
                ':delete_int' => $where['delete_int'],
                ':userid_int' => $where['userid_int']
            ));	
			return $scene;	
	}
    /**
     * 获取模板子菜单
     */
    public function getUpfileList($where) {
			$upfile = R::getAll(ORMMap::$sqlMap['upfilelist'], array(
                ':userid_int' => $where['userid_int'],
                ':type_int' => $where['type_int'],
                ':biztype_int' => $where['biztype_int']
            ));	
			return $upfile;	
	}
    /**
     * 获取模板图片列表
     */	
    public function getSysPageTpl($where) {
			$upfile = R::getAll(ORMMap::$sqlMap['syspagetpl'], array(
                ':userid_int' => $where['userid_int'],
                ':tagid_int' => $where['tagid_int']
            ));	
			return $upfile;	
	}
    /**
     * 保存分页
     */	
    public function saveScenePage($scenepagedata) {
		$scenepagedataBean = R::dispense(TABLENAME_SHOWSCENEPAGE);			
    	$scenepagedata->generateRedBean($scenepagedataBean); 			
    	R::store($scenepagedataBean);
    	R::close();  	  	
    	return $scenepagedataBean->id;
	}
    /**
     * 创建新的场景
     */	
    public function saveScene($scenedata) {
		$scenedataBean = R::dispense(TABLENAME_SHOWSCENE);			
    	$scenedata->generateRedBean($scenedataBean); 			
    	R::store($scenedataBean);
    	R::close();  	  	
    	return $scenedataBean->id;
	}
   /**
     * 更新分页
     */	
    public function updateScenePage($entity) {
        $bean = R::load($this->scenePageTableName, $entity->id);

        if ($bean->id == 0) {
            return new Result(false, 78, ErrorMsgs::get(78), NULL);
        }
        $entity->generateRedBean($bean);
        $entity->id= R::store($bean);
    	return $entity->id;
	}
	 /**
     * 删除分页
     */	
    public function delScenePage($id){
        $bean = R::load($this->scenePageTableName, $id);       
        return R::trash($bean);
	}	
	/**
     * 通过id获取素料
     */	
	public function sysPageInfoById($id){	
		return R::getRow(ORMMap::$sqlMap['syspageinfo'], array(':id' => $id));		
	}

    /**
     * 更新page数据
     */	
	public function updateMyPage($data){	
	    $result = R::exec('update '.$this->scenePageTableName.' set pagecurrentnum_int=:pagecurrentnum_int,properties_text=:properties_text,content_text=:content_text where id=:id and sceneid_bigint=:sceneid_bigint and userid_int=:userid_int',$data);
    	R::close();
		return $result;
	}
		
    /**
     * 保存data数据
     */
    public function saveSceneData($entity) {
        $bean = R::dispense($this->sceneDataTableName);
        $entity->generateRedBean($bean);
        $entity->id= R::store($bean);
        return $entity;
    }
    /**
     * 删除data数据
     */
    public function delSceneData($where) {
    	$result = R::exec('delete from '.$this->sceneDataTableName.' where userid_int=:userid_int and pageid_bigint=:pageid_bigint and sceneid_bigint=:sceneid_bigint',$where);
    	R::close();
		return $result;
    }
    /**
     * 更新scene数据
     */	
	public function updateMyScene($data){
			if(isset($data['musictype_int']) && $data['musictype_int']){
				$musictype_int = ',musictype_int=:musictype_int';
			}else{
				$musictype_int = '';
			}
	    $result = R::exec('update '.$this->tableName.' set musicurl_varchar=:musicurl_varchar'.$musictype_int.' where id=:id and sceneid_bigint=:sceneid_bigint and userid_int=:userid_int',$data);
    	R::close();
		return $result;
	}
    /**
     * 浏览量 +1
     */	
    public function initAddPageSysCount($where) {
    	$result = R::exec('update '.$this->scenePageSysDataTableName.' set usecount_int=usecount_int+1 where id=:id',$where);
    	R::close();
		return $result;		
	}
    /**
     * 浏览量 +1
     */	
    public function addSceneViewCount($where) {
    	$result = R::exec('update '.$this->tableName.' set hitcount_int=hitcount_int+1 where id=:id',$where);
    	R::close();
		return $result;		
	}
    /**
     * 获取分享量
     */	
    public function getShareCount($id) {
		$sql = 'select * from '.$this->shareTableName.' where 1=1 and id=:id limit 1';
		return R::getRow($sql, array(':id' => $id));
	}
    /**
     * 获取上传文件列表(我的背景)
     */	
    public function myUpfileList($where){
		if(!empty($where['tagid_int'])){
				$tagid_int = ' tagid_int=:tagid_int and';
			$upfile = array(
                ':userid_int' => $where['userid_int'],
                ':biztype_int' => $where['biztype_int'],
                ':filetype_int' => $where['filetype_int'],
                ':tagid_int' => $where['tagid_int'],
                ':delete_int' => $where['delete_int'],
                ':startpage' => $where['startpage'],
                ':showsize' => $where['showsize']
            );	
		}else{
				$tagid_int = '';
			$upfile = array(
                ':userid_int' => $where['userid_int'],
                ':biztype_int' => $where['biztype_int'],
                ':filetype_int' => $where['filetype_int'],
                ':delete_int' => $where['delete_int'],
                ':startpage' => $where['startpage'],
                ':showsize' => $where['showsize']
            );			
		}
	$sql = 'select id,filename_varchar,ext_varchar,filetype_int,biztype_int,filesrc_varchar,filethumbsrc_varchar,userid_int,sizekb_int from '.$this->upfileTableName.' where userid_int=:userid_int and biztype_int=:biztype_int and filetype_int=:filetype_int and'.$tagid_int.' delete_int=:delete_int order by id desc limit :startpage,:showsize';
			return R::getAll($sql,$upfile);			
	}	
    /**
     * 获取数据总数(我的背景)
     */
    public function countUpfileList($where){
		if(!empty($where['tagid_int'])){
				$tagid_int = ' tagid_int=:tagid_int and';
			$upfile = array(
                ':userid_int' => $where['userid_int'],
                ':biztype_int' => $where['biztype_int'],
                ':filetype_int' => $where['filetype_int'],
                ':tagid_int' => $where['tagid_int'],
                ':delete_int' => $where['delete_int']
            );	
		}else{
			$tagid_int = '';
			$upfile = array(
                ':userid_int' => $where['userid_int'],
                ':biztype_int' => $where['biztype_int'],
                ':filetype_int' => $where['filetype_int'],
                ':delete_int' => $where['delete_int']
            );			
		}
		
	$sql = 'select count(*) as num from '.$this->upfileTableName.' where userid_int=:userid_int and biztype_int=:biztype_int and filetype_int=:filetype_int and'.$tagid_int.' delete_int=:delete_int';
	
		$count = R::getRow($sql,$upfile);
			return $count['num'];	
    }
    /**
     * 列表(背景库、音乐、图片...)
     */	

    public function upfileSysList($where){
						
			if(isset($where['biztype_int'])){
				$biztype_int = ' biztype_int=:biztype_int and';
				if($where['tagid_int']){
					$array = array(
							':biztype_int' => $where['biztype_int'],
							':filetype_int' => $where['filetype_int'],
							':tagid_int' => $where['tagid_int'],
							':startpage'=>$where['startpage'],
							':showsize'=>$where['showsize']
							);
					$tagid_int = ' and tagid_int=:tagid_int';
				}else{
					$tagid_int = '';
					$array = array(
							':biztype_int' => $where['biztype_int'],
							':filetype_int' => $where['filetype_int'],
							':startpage'=>$where['startpage'],
							':showsize'=>$where['showsize']							
							);
				}
			}else{
				$biztype_int = '';
				if($where['tagid_int']){
					$array = array(
							':tagid_int' => $where['tagid_int'],
							':filetype_int' => $where['filetype_int'],
							':startpage'=>$where['startpage'],
							':showsize'=>$where['showsize']
							);
					$tagid_int = ' and tagid_int=:tagid_int';					
				}else{
					$tagid_int = '';
					$array = array(
							':filetype_int' => $where['filetype_int'],
							':startpage'=>$where['startpage'],
							':showsize'=>$where['showsize']
							);					
				}				
			}
			$sql = 'select id,filename_varchar,ext_varchar,filetype_int,biztype_int,filesrc_varchar,filethumbsrc_varchar,userid_int,sizekb_int from showupfilesys where'.$biztype_int.' filetype_int=:filetype_int'.$tagid_int.' order by id desc limit :startpage,:showsize';
			return R::getAll($sql, $array);			
	}	
    /**
     * 数量(背景库、音乐、图片...)
     */
    public function countUpfileSysList($where){
			if(isset($where['biztype_int'])){
				$biztype_int = ' biztype_int=:biztype_int and';
				if($where['tagid_int']){
					$array = array(
							':biztype_int' => $where['biztype_int'],
							':filetype_int' => $where['filetype_int'],
							':tagid_int' => $where['tagid_int']);
					$tagid_int = ' and tagid_int=:tagid_int';
				}else{
					$tagid_int = '';
					$array = array(
							':biztype_int' => $where['biztype_int'],
							':filetype_int' => $where['filetype_int']);
				}
			}else{
				$biztype_int = '';
				if($where['tagid_int']){
					$array = array(
							':tagid_int' => $where['tagid_int'],
							':filetype_int' => $where['filetype_int']
							);
					$tagid_int = ' and tagid_int=:tagid_int';					
				}else{
					$tagid_int = '';
					$array = array(
							':filetype_int' => $where['filetype_int']
							);					
				}				
			}
			$sql = 'select count(*) as num from showupfilesys where'.$biztype_int.' filetype_int=:filetype_int'.$tagid_int;

			$upfilecount = R::getRow($sql,$array);
			
			return $upfilecount['num'];	
    }
    /**
     * 保存tag数据
     */
    public function saveTag($entity) {
        $bean = R::dispense($this->tagTableName);
        $entity->generateRedBean($bean);
        $entity->id= R::store($bean);
        return $entity->id;
    }
    /**
     * 单条删除tag
     *
     * @param int $id
     */
    public function delTag($id) {
        $bean = R::load($this->tagTableName, $id);       
        return R::trash($bean);
    }
    /**
     * 重新分类
     */	
    public function updateUpfileTagId($where) {
		$ids = explode(',',$where['ids']);
		foreach($ids as $id){
			unset($where['ids']);
			$where['id'] = $id;
			$result = R::exec('update '.$this->upfileTableName.' set tagid_int=:tagid_int where userid_int=:userid_int and id=:id',$where);
		}

		return $result;		
	}
	
    /**
     * 浏览量 +1
     */	
    public function updatePublish($where) {
    	$result = R::exec('update '.$this->tableName.' set publish_time=:publish_time where id=:id and userid_int=:userid_int',$where);
    	R::close();
		return $result;		
	}
    /**
     * 秀场信息(标题、简介、关键字...)
     */	
	public function getSys(){
		return R::getRow("select * from ".$this->sysTableName." where 1=1 order by id desc limit 1");
	}
    /**
     * 秀场信息(AppID、AppSecret)
     */	
	public function getConfig(){
		return R::getRow("select web_appid,web_appsecret from ".$this->sysTableName." where 1=1  limit 1");
	}
    /**
     * 配置公众号信息(AppID、AppSecret)
     */	
    public function saveConfig($data) {
    	$result = R::exec('update '.$this->sysTableName.' set web_appid=:web_appid ,web_appsecret=:web_appsecret where id=1',$data);
    	R::close();
		return $result;		
	}
    /**
     * 秀场详情
     */	
	public function sceneDetail($where){
		return R::getRow("select * from ".$this->tableName." where 1=1 and id=:id and delete_int=:delete_int and userid_int=:userid_int limit 1",$where);
	}
    /**
     * 秀场详情2
     */	
	public function sceneDetail2($where2){
		if(isset($where2['id'])){
			return R::getRow("select * from ".$this->tableName." where 1=1 and id=:id and delete_int=:delete_int limit 1",$where2);			
		}else{
			return R::getRow("select * from ".$this->tableName." where 1=1 and scenecode_varchar=:scenecode_varchar and delete_int=:delete_int limit 1",$where2);			
		}

	}
    /**
     * 缩略图（尾页）
     */
    public function getPageTplSys($where){
			$tplsys = R::getAll(ORMMap::$sqlMap['pagetplsys'], array(
                ':filetype_int' => $where['filetype_int']
            ));	
			return $tplsys;	
    }
    /**
     * 场景类型
     */
    public function getCateTypeList($where){
			$type = R::getAll(ORMMap::$sqlMap['catetypelist'], array(
                ':type' => $where['type']
            ));	
			return $type;	
    }
    /**
     * 上传文件
     */
	public function saveMyUpfile($entity){
        $bean = R::dispense($this->upfileTableName);
        $entity->generateRedBean($bean);
        $entity->id= R::store($bean);
        return $entity->id;
	}
    /**
     * 删除场景
     */	
    public function delScene($where) {
    	$result = R::exec('update '.$this->tableName.' set delete_int=1 where id=:id and userid_int=:userid_int',$where);
    	R::close();
		return $result;		
	}
    /**
     * 设置场景信息
     */	
    public function saveSettings($where) {
    	$result = R::exec('update '.$this->tableName.' set scenename_varchar=:scenename_varchar,movietype_int=:movietype_int,thumbnail_varchar=:thumbnail_varchar,desc_varchar=:desc_varchar where id=:id and userid_int=:userid_int',$where);
    	R::close();
		return $result;		
	}
    /**
     * 是否分享
     */	
    public function isShareBySceneid($id) {
		return R::getRow("select * from ".$this->tableName." where id=:id limit 1",array(':id'=>$id));	
	}
    /**
     * 增加分享
     */	
    public function addShare($entity) {
        $bean = R::dispense($this->shareTableName);
        $entity->generateRedBean($bean);
        $entity->id= R::store($bean);
        return $entity->id;	
	}
    /**
     * 分享+1
     */	
    public function updateShare($where) {
		
		$updatefield = $where['channel'].'='.$where['channel'].'+1';	
		$sql = 'update '.$this->shareTableName.' set '.$updatefield.' where scene_id=:scene_id';
		
    	$result = R::exec($sql,array(':scene_id'=>$where['scene_id']));
    	R::close();
		return $result;		
	}
    /**
     * 获取分享数据
     */
    public function queryShare($where) {	

        DTExpression::eq('id', $where);	
        DTExpression::eq('delete_int', $where);
        DTExpression::ge('createtime_time', $where, 'start_time');
        DTExpression::le('createtime_time', $where, 'end_time');
        DTExpression::like('scenename_varchar', $where);
        DTExpression::page($where);
        if (isset($where['order']) &&  $where['order']) {
            DTOrder::$sql = $where['order'];
        } else {
            DTOrder::asc($this->tableName . '.id');
        }   
	
         return $this->getByComposite(ORMMap::$classes[$this->tableName], DTExpression::$sql . DTOrder::$sql . DTExpression::$limit);		
	}
    /**
     * 获得总数
     */
    public function totalRowsShare($where) {
        DTExpression::eq('delete_int', $where);
        DTExpression::ge('createtime_time', $where, 'start_time');
        DTExpression::le('createtime_time', $where, 'end_time');
        DTExpression::like('scenename_varchar', $where);
        return $this->getRecordCount(DTExpression::$sql, DTExpression::$params);
    }
}
