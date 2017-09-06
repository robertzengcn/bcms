<?php

/**
 *
 * 投票dao层
 * @author Administrator
 *
 */
class VoteDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_VOTE;
    }

    /**
     *
     *
     * 获取多条数据::debug,需使用ORMMap语句映射获取demarment名称
     *
     * @param $params 参数包
     */
    public function query($params) {
        DTExpression::ge('start_time', $params, 'start_time');
        DTExpression::le('over_time', $params, 'end_time');
        DTExpression::eq('status', $params);
        DTExpression::like('title', $params);
        DTExpression::page($params);
        if (isset($params['order']) &&  $params['order']) {
            DTOrder::$sql = $params['order'];
        }
         return $this->getByComposite(ORMMap::$classes[$this->tableName], DTExpression::$sql . DTOrder::$sql . DTExpression::$limit, ORMMap::$sqlMap['common_fields_vote']); 
    }

    /**
     *
     *
     * 获取数据总数
     *
     * @param $params 参数包
     */
    public function totalRows($params) {
        DTExpression::ge('start_time', $params, 'start_time');
        DTExpression::le('over_time', $params, 'end_time');
        DTExpression::eq('status', $params);
        DTExpression::like('title', $params);
        return $this->getRecordCount(DTExpression::$sql, DTExpression::$params);
    }
    /**
     * 修改数据
     *
     * @param object $entity
     * @return boolean
     */
    public function update($entity) {
        $bean = R::load($this->tableName, $entity->id);

        if ($bean->id == 0) {
            return new Result(false, 78, ErrorMsgs::get(78), NULL);
        }
        $entity->generateRedBean($bean);
        $entity->id= R::store($bean);

        return new Result(true, 0, '', NULL);
    }


     /**
     *
     * 根据报名ID获取活动名称
     */   
    
    public function getActiveName($id){
		$name = R::getRow(ORMMap::$sqlMap['vote_title'], array(':id' => $id));
		return 	$name['title'];
    }
     /**
     *
     * 根据报名ID获取活动信息
     */   
    
    public function activeInfo($id){
		$result = R::getRow('select * from '.$this->tableName.' where id=:id',array(':id'=>$id));
		
        return $result;
    }
     /**
     *
     * 获取所有活动名称
     */   
    
    public function getAllActiveName(){
		$title = R::getAll(ORMMap::$sqlMap['vote_title_all'], array(':enddate' => time()));
/* 		$array = array();
		if(count($title)>0){
			foreach($title as $value){
				$array[$value['id']] = $value['title'];
			}
		} */
		return 	$title;
    }
    /**
     * 浏览量 +1
     */	
    public function initAddView($arr) {
    	$result = R::exec('update '.$this->tableName.' set checks=checks+1,ed_dcount=:ed_dcount where id=:id',$arr);
    	R::close();
		return $result;		
	}
    /**
     * 开启mysql定时器
     */	
    public function onMysqlEvent($id) {
		$result1 = R::getRow("show variables like 'event_scheduler'");
		if($result1['Value'] == 'OFF'){
			R::exec("SET GLOBAL event_scheduler='on'");
		}
	
		R::exec("create procedure vote_proce_".$id."()
begin
insert into votestatisticslog(vid,tj_time,total_votes) select ".$id." as vid,unix_timestamp() as tj_time,count(*) as total_votes from votelog where tp_time >unix_timestamp(CONCAT(date_sub(curdate(),interval 1 day),' 00:00:00')) and tp_time < unix_timestamp(CONCAT(date_sub(curdate(),interval 1 day),' 23:59:59'));
TRUNCATE TABLE votelog;
end");
		$result3 = R::exec("CREATE EVENT IF NOT EXISTS vote_event_".$id." ON SCHEDULE EVERY 1 DAY STARTS date_add(date(curdate() + 1),interval 1 second) ON COMPLETION PRESERVE ENABLE DO CALL vote_proce_".$id."()");
		return $result3;		
	}
    /**
     * 关闭mysql定时器
     */	
    public function offMysqlEvent($id) {
	    R::exec("DROP PROCEDURE IF EXISTS vote_proce_".$id);
	    R::exec("DROP EVENT IF EXISTS vote_event_".$id);
		$result1 = R::getRow("show variables like 'event_scheduler'");
		if($result1['Value'] == 'ON'){		
			$result = R::exec("SET GLOBAL event_scheduler='off'");
		}
		return $result;		
	}
	/*
     * 获取某个时间段点击量
     * */
    
    public function getIcountByTime($time,$id) {  	 
		$sql1 = 'select ed_dcount from vote where status=1 and id='.$id;
		$dnum = R::getRow($sql1);
		
		$num = 0;
			if(isset($dnum['ed_dcount']) && $dnum['ed_dcount']){
				$ed_dcount = unserialize($dnum['ed_dcount']);
				$num = $ed_dcount[$time];
			}
			
		return $num;
	
	}
	/*
     * 获取投票列表名称\点击量
     * */
    
    public function getVoteChecksAndTitle() {	 
		$sql1 = 'select id,title,checks,enddate from '.$this->tableName.' where status=1';
		return R::getAll($sql1);
	
	}	
}
