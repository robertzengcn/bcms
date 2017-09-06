<?php

/**
 * show
 * @author Administrator
 *
 */
class ShowService extends BaseService {

    /**
     * 构造方法
     * 实例化基类并实例化dao数据表处理层,并将其赋值给dao属性
     */
    public function __construct() {
        parent::__construct();
        $this->dao = new ShowDAO();
    }
   /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     * @return Result
     */
    public function query($where) {
    	
        return $this->dao->query($where);
    }

   /**
     * 获取一条数据
     *
     * @param Entity $commodity
     * @return Result
     */
    public function get($scene) {
        if (!$scene->id) {
            throw new ValidatorException(7);
        }
		
		$this->dao->get($scene->id, $scene);
        return $scene;
    }
   /**
     * 保存数据
     *
     * @param Entity $commodity
     * @return Result
     */
    public function save($votewxsz) {
    	
        $votewxsz->validate();        
        $res=$this->dao->save($votewxsz);
        return $this->success($res);
    }
 
    /**
     * 更新数据
     *
     * @param Entity $commodity
     * @return Result
     */
    public function update($votewxsz) {	
        $votewxsz->validate();
        $this->dao->beginTrans();
        return $this->dao->update($votewxsz);
    }
    /**
     * 获取场景信息
     */
    public function scenePageList($where) {
        return $this->dao->getScenePageList($where);	
	}
    /**
     * 获取场景信息2
     */
    public function scenePageList2($where) {
        return $this->dao->getScenePageList2($where);	
	}
    /**
     * 获取场景信息3(全)
     */
    public function scenePageList3($where) {
        return $this->dao->getScenePageList3($where);	
	}	
    public function scenePageLists($where) {
        return $this->dao->getScenePageLists($where);	
	}
    public function sceneList($where) {
        return $this->dao->getSceneList($where);	
	}
    /**
     * 获取模板子菜单
     */
    public function upfileList($where) {
        return $this->dao->getUpfileList($where);	
	}
    /**
     * 获取模板图片列表
     */	
    public function getSysPageTpl($where) {
        return $this->dao->getSysPageTpl($where);	
	}
    /**
     * 保存分页
     */
    public function saveScenePage($scenepagedata) {
		$scenepagedata->validate();	
        return $this->dao->saveScenePage($scenepagedata);	
	}
    /**
     * 保存分页
     */
    public function saveScene($scenedata) {
		$scenedata->validate();	
        return $this->dao->saveScene($scenedata);	
	}
    /**
     * 更新分页
     */
    public function updateScenePage($info) {
        return $this->dao->updateScenePage($info);	
	}
	 /**
     * 删除分页
     */	
    public function delScenePage($id){
        return $this->dao->delScenePage($id);		
	}
    /**
     * 通过id获取素料
     */
    public function sysPageInfoById($id) {
        return $this->dao->sysPageInfoById($id);	
	}

    /**
     * 更新page数据
     */	
    public function updateMyPage($data){
        return $this->dao->updateMyPage($data);	
	}
    /**
     * 保存data数据
     */	
    public function saveSceneData($info){
        return $this->dao->saveSceneData($info);	
	}
    /**
     * 删除data数据
     */	
    public function delSceneData($where){
        return $this->dao->delSceneData($where);	
	}
    /**
     * 更新scene数据
     */	
    public function updateMyScene($data){
        return $this->dao->updateMyScene($data);	
	}
    /**
     * 素材浏览量 +1
     */
    public function initAddPageSysCount($where){
        return $this->dao->initAddPageSysCount($where);		
	}
    /**
     * 浏览量 +1
     */
    public function addSceneViewCount($where){
        return $this->dao->addSceneViewCount($where);		
	}
    /**
     * 获取上传文件列表(我的背景)
     */	
    public function myUpfileList($where){
        return $this->dao->myUpfileList($where);		
	}
    /**
     * 上传文件数量(我的背景)
     */	
    public function countUpfileList($where){
        return $this->dao->countUpfileList($where);		
	}
    /**
     * 列表(背景库、音乐、图片...)
     */	
    public function upfileSysList($where){
        return $this->dao->upfileSysList($where);		
	}
    /**
     * 数量(背景库、音乐、图片...)
     */	
    public function countUpfileSysList($where){
        return $this->dao->countUpfileSysList($where);		
	}
    /**
     * 创建分类
     */	
    public function createShowTag($data){
        return $this->dao->saveTag($data);			
	}
	 /**
     * 删除分类
     */	
    public function delTag($id){
        return $this->dao->delTag($id);		
	}
	/**
     * 重新分类
     */	
    public function setUpfileTagId($where){
        return $this->dao->updateUpfileTagId($where);	
	}
	/**
     * 发布
     */	
    public function updatePublish($where){
        return $this->dao->updatePublish($where);	
	}
    /**
     * 秀场信息(标题、简介、关键字...)
     */
	public function getSys(){
        return $this->dao->getSys();	
	}
    /**
     * 秀场信息(AppID、AppSecret)
     */
	public function getConfig(){
        return $this->dao->getConfig();	
	}
    /**
     * 配置公众号信息(AppID、AppSecret)
     */
	public function saveConfig($data){
        return $this->dao->saveConfig($data);	
	}
    /**
     * 秀场详情
     */
	public function sceneDetail($where){
        return $this->dao->sceneDetail($where);	
	}
    /**
     * 秀场详情2
     */
	public function sceneDetail2($where2){
        return $this->dao->sceneDetail2($where2);	
	}
    /**
     * 缩略图（尾页）
     */
	public function getPageTplSys($where){
        return $this->dao->getPageTplSys($where);	
	}
    /**
     * 场景类型
     */
	public function getCateTypeList($where){
        return $this->dao->getCateTypeList($where);	
	}
    /**
     * 上传文件
     */
	public function addMyUpfile($data){

        return $this->dao->saveMyUpfile($data);	
	}
    /**
     * 删除场景
     */	
    public function delScene($where) {
        return $this->dao->delScene($where);		
	}
    /**
     * 设置场景信息
     */	
    public function saveSettings($where) {
        return $this->dao->saveSettings($where);		
	}
    /**
     * 是否分享
     */	
    public function isShareBySceneid($id) {
        return $this->dao->isShareBySceneid($id);		
	}
    /**
     * 增加分享
     */	
    public function addShare($data) {
        return $this->dao->addShare($data);
	}
    /**
     * 分享+1
     */	
    public function updateShare($where) {
        return $this->dao->updateShare($where);		
	}
    /**
     * 获取分享数据
     */
    public function queryShare($where) {
		
		$share = $this->dao->queryShare($where);
		$array = array();
		if($share){
			foreach($share as $key => $value){
					$share_c = $this->getShareCount($value->id);
				$array[$key]['id'] = $key;
				$array[$key]['scene_id'] = $value->id;
				if($share_c){
					$array[$key]['share_count'] = $share_c['timeline'] + $share_c['appmessage'] + $share_c['qq'] + $share_c['weibo'] + $share_c['qzone'];
				}else{
					$array[$key]['share_count'] = 0;
				}
				$array[$key]['show_count'] =  $value->hitcount_int ? $value->hitcount_int : 0;
				$array[$key]['name'] =  $value->scenename_varchar;
				$array[$key]['create_time'] = $value->createtime_time;
			}
			unset($share);
		}
        return $this->success($array);
	}
   /**
     * 获取详情数据
     */	
	public function getDetail($where){
		$detail = $this->dao->queryShare($where);
		$array = array();
		if($detail){
					$share_c = $this->getShareCount($where['id']);
				$array['scene_id'] = $detail[0]->id;
				if($share_c){
					$array['timeline'] = $share_c['timeline'];
					$array['appmessage'] = $share_c['appmessage'];
					$array['qq'] = $share_c['qq'];
					$array['weibo'] = $share_c['weibo'];
					$array['qzone'] = $share_c['qzone'];
					$array['other'] = $share_c['other'];
				}else{
					$array['timeline'] = 0;
					$array['appmessage'] = 0;
					$array['qq'] = 0;
					$array['weibo'] = 0;
					$array['qzone'] = 0;
					$array['other'] = 0;
				}
				$array['show_count'] =  $detail[0]->hitcount_int ? $detail[0]->hitcount_int : 0;
				$array['name'] =  $detail[0]->scenename_varchar;
				$array['create_time'] = $detail[0]->createtime_time;
				$array['thumb_img'] = $detail[0]->thumbnail_varchar;
				$array['link'] = NETADDRESS . '/addons/show.php?method=preview&id=' . $detail[0]->id;
			unset($share);
		}
        return $array;		
	}
    /**
     * 获取分享数据总数
     */
    public function totalRowsShare($where) {
		
		return $this->success( $this->dao->totalRowsShare($where));
	}
    /**
     * 获取分享量
     */	
    public function getShareCount($id) {
        return $this->dao->getShareCount($id);			
	}
}