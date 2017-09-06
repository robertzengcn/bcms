<?php

/**
 * 频道文章DAO
 *
 * @author Administrator
 *
 */
class ChannelArticleDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_CHANNELARTICLE;
        $this->channelName = TABLENAME_CHANNEL;
    }

    /**
     * 获取频道
     *
     * @param Channel() $channel
     *            $channel->id
     * @return bean
     */
    public function getChannel($channel) {
        $channelBean = R::load($this->channelName, $channel->id);
        $channel->generateFromRedBean($channelBean);

        return $channelBean;
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     *            return object $arr
     */
    public function query($where) {
        DTExpression::eq('id', $where);
        DTExpression::ge('plushtime', $where, 'start_time');
        DTExpression::le('plushtime', $where, 'end_time');
        DTExpression::like('subject', $where);
        DTExpression::eq('channel_id', $where);
        DTExpression::page($where);
        DTOrder::desc('plushtime');

        if (isset($where['show_position']) && $where['show_position']) {
            $show_position = str_replace('show_position', $this->tableName . '.show_position', stripslashes($where['show_position']));
            DTExpression::$sql .= " and " . $show_position;
        }
        
        return $this->getByComposite(ORMMap::$classes[$this->tableName], DTExpression::$sql . DTOrder::$sql . DTExpression::$limit);
    }

    /**
     * 获得总数
     *
     * @param array $where
     *            查询条件
     *            return object $arr
     */
    public function totalRows($where) {
        DTExpression::ge('plushtime', $where, 'start_time');
        DTExpression::le('plushtime', $where, 'end_time');
        DTExpression::eq('channel_id', $where);
        DTExpression::like('subject', $where);

        if (isset($where['show_position']) && $where['show_position']) {
        	$show_position = str_replace('show_position', $this->tableName . '.show_position', stripslashes($where['show_position']));
        	DTExpression::$sql .= " and " . $show_position;
        }
        return $this->getRecordCount(DTExpression::$sql, DTExpression::$params);
    }
    /**
     * 通过channel_id查询数据
	 * @return array
     */	
    public function getChanneArticleInfo($channelId) {
        $data = R::getAll( "SELECT * FROM ".$this->tableName." WHERE channel_id=".$channelId );
		return	$data;
	}
	/**
	 * 计算某个频道下文章个数
	 * */
	public function countarticle($arr){
		$num=R::count($this->tableName,'channel_id=:channel_id',$arr);
		return	$num;
	}
    /**
     * 获得所有文章的id
	 * @return array
     */	
    public function getAllChanneArticleId() {
        $data = R::getAll( "SELECT id FROM ".$this->tableName." WHERE 1=1" );
		return	$data;
	}
	/**
	 * 
	 * */
	public function getartbycharids($where){
		DTExpression::in('channel_id', $where['ids']);
		DTExpression::page($where['limits']);
		$data=$this->getByComposite(ORMMap::$classes[$this->tableName],DTExpression::$sql . DTOrder::$sql . DTExpression::$limit);
		$num=$this->totalRows($where);
		
		return	array('data'=>$data,'ttl'=>$num);
		
	}
}
