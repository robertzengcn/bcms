<?php

class ChannelService extends BaseService {

    /**
     * 构造函数
     */
    public function __construct() {
        $this->dao = new ChannelDAO();
    }

    /**
     * 条件查询
     *
     * @param unknown $where
     *            查询条件
     * @return multitype:unknown number
     */
    public function query($where) {
        $channels = $this->dao->query($where);
        $channelarticleser=new ChannelArticleService();
        foreach($channels as $key=>$val){
        	$val->num=$channelarticleser->countarticle($val->id)->data;
        }

        return $this->success($channels);
    }

    /**
     * 批量删除
     *
     * @param array $arr(id,...)
     * @return boolean
     */
    public function deleteBatch($ids) {
        return $this->dao->deleteBatch($ids);
    }

    /**
     * 获得一条数据
     *
     * @param Entity $channel
     * @return Result
     */
    public function get($channel) {
        if (! $channel->id) {
            throw new ValidatorException(7);
        }
        $this->dao->get($channel->id, $channel);

        return $this->success($channel);
    }

    /**
     * 保存数据
     *
     * @param Entity $channel
     * @return Result
     */
    public function save($channel) {
        $channel->validate();
        // 获取class对象并插入数据
        $this->dao->save($channel);

        return $this->success();
    }

    /**
     * 更改数据
     *
     * @param Entity $channel
     * @return Result
     */
    public function update($channel) {
        $channel->validate();
        if (! $channel->id) {
            throw new ValidatorException(7);
        }
        return $this->dao->update($channel);
    }

    /**
     * 删除数据
     *
     * @param Entity $channel
     * @return Result
     */
    public function delete($channel) {
        if (! $channel->id) {
            throw new ValidatorException(7);
        }

        $_REQUEST['pid'] = $channel->id;
        $_REQUEST['kind'] = 3;
        $userVarService = new UserVarService();
        $userVarService->clearByPid();

        $this->dao->delete($channel->id);

        return $this->success();
    }

    /**
     * 获取自定义字段
     */
    public function getUserVar() {
        $userVarService = new UserVarService();

        return $userVarService->getUserVar();
    }

    /**
     * 修改自定义字段
     */
    public function updateUserVar() {
        $userVarService = new UserVarService();
        $userVarService->clearByPid();

        return $userVarService->saveUserVar();
    }
    
    public function getHtmlUrl() {
    	$fxed = '';
    	switch ( $_REQUEST['func'] ){
    		case 'mobile':$fxed    = 'mobile/';break;
    		case 'app':$fxed    = 'app/';break;
    		case 'wechat':$fxed = 'wechat/';break;
    	}
    	$fxed = '';
    	$url = array();
    	 
    	$channel = $this->dao->getListAll();
    	return $this->success($channel);
    	 
    }
    
    public function getchannelbyid($arr){//用id获取channel信息
    	$channel=new Channel();
    	$channel->id=(int)$arr['id'];
    	$this->dao->get($channel->id, $channel);
    	
    	return $this->success($channel);
    	
    }
}
