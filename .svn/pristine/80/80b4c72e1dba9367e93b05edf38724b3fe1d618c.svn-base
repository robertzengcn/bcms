<?php

/**
 * 资讯(StatisticsLog)DAO
 *
 * @author Administrator
 *
 */
class VoteStatisticsLogDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_VOTESTATISTICSLOG;
    }



    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     *            return object $array
     */
    public function query($where) {
        DTExpression::ge('tj_time', $where, 'start_time');
        DTExpression::le('tj_time', $where, 'end_time');
        DTExpression::page($where);
        DTOrder::desc('tj_time');
        return $this->getByComposite(ORMMap::$classes[$this->tableName], DTExpression::$sql . DTOrder::$sql . DTExpression::$limit);
    }

    /**
     * 获得总数
     *
     * @param array $where
     *            查询条件
     *            return object $array
     */
    public function totalRows($where) {
        DTExpression::ge('tj_time', $where, 'start_time');
        DTExpression::le('tj_time', $where, 'end_time');
        return $this->getRecordCount(DTExpression::$sql, DTExpression::$params);
    }
    public function addAutoData($arr) {
        $result = R::exec("insert into ".$this->tableName."(tj_time,vid,total_check,total_votes) values('".time()."','".$arr['vid']."','".$arr['total_check']."','".$arr['total_votes']."')");
    	R::close();
        if($result){
            return true;
        }else{
            return false;
        }		
	}

    /**
     * 投票分布
     *
     * @param 时间戳 $starTime
     * @param 时间戳 $endTime
     * @return multitype:number
     */
    public function distributed($starTime, $endTime) {
        $num = R::getRow(ORMMap::$sqlMap['getVotes'], array(
            ':star_time' => $starTime,
            ':end_time' => $endTime
        ));
		
        $array = array();
        $array['tnum'] = ($num['vcount'] == null) ? 0 : (int)$num['vcount'];		
        return $array;
    }
    /**
     * 所有投票曲线
     *
     * @return Result
     */
    public function voteDistributedByLine($starTime, $endTime) { 
        $array = array();
        $sql = 'select total_votes as vcount,tj_time from vote where add_time>=:star_time and add_time<:end_time';
        $alltnum = R::getAll($sql, array(
            ':star_time' => $starTime,
            ':end_time' => $endTime
        ));
        for ($i = $starTime; $i <= $endTime;) {
            $j = $i + 86400;
            $field = date('Y-m-d', $i);
            $array['visittime'][] = $field;
            $array['tnum'][$field] = 0;
            $array['fnum'][$field] = 0;
            $array['bnum'][$field] = 0;
            $i = $j;
        }		
	}
   /**
     * 投票-时间曲线
     *
     * @param 时间戳 $starTime
     * @param 时间戳 $endTime
     * @return multitype:number
     */
    public function distributedByLine($starTime, $endTime, $vid) {        
        $array = $this->formatTimeByDay($starTime, $endTime);
        $sql = 'select total_votes as vcount,tj_time from votestatisticslog where (tj_time-3600)>=:star_time and (tj_time-3600)<:end_time';
        $alltnum = R::getAll($sql, array(
            ':star_time' => $starTime,
            ':end_time' => $endTime
        ));
        if (!empty($alltnum)) {
            foreach ($alltnum as $v) {
				$t = $v['tj_time']-3600;
				$start = mktime(0,0,0,date("m",$t),date("d",$t),date("Y",$t));
				$end = mktime(23,59,59,date("m",$t),date("d",$t),date("Y",$t));			
			    $time = date('Y-m-d', $t);
                $array['tnum'][$time] = $v['vcount'] ? (int)$v['vcount'] : 0;
				$count = R::count('voteitem','addtime>=:stime and addtime<:etime',array('stime'=>$start,'etime'=>$end));
                $array['bnum'][$time] = (int)$count;		
            }
        }
		$sql1 = 'select ed_dcount from voteitem where status=1 and vid='.$vid;
		$xdnum = R::getAll($sql1);		
		foreach ($xdnum as $value) {
			if(isset($value['ed_dcount']) && $value['ed_dcount']){
				$ed_dcount = unserialize($value['ed_dcount']);
				$ed_dcount_key = array_keys($ed_dcount);
				foreach($ed_dcount_key as $val){
					if(in_array($val,$array['visittime'])){
						$array['fnum'][$val] += $ed_dcount[$val];					
					}					
				}

			}		
		}
		$sql2 = 'select ed_dcount from vote where status=1 and id='.$vid;
		$idnum = R::getRow($sql2);		
			if(isset($idnum['ed_dcount']) && $idnum['ed_dcount']){
				$ed_count = unserialize($idnum['ed_dcount']);
				$ed_count_key = array_keys($ed_count);
				foreach($ed_count_key as $val){
					if(in_array($val,$array['visittime'])){
						$array['fnum'][$val] += $ed_count[$val];					
					}					
				}
			}		
        return array('visittime'=>$array['visittime'], 'tnum'=>array_values($array['tnum']), 'fnum'=>array_values($array['fnum']), 'bnum'=>array_values($array['bnum']));
    }
    
    /**
     * 格式化时间
     * 
     * @$day 间隔天数，默认1天，即每天都统计
     * */
    public function formatTimeByDay($starTime, $endTime) {
        $array = array();
        for ($i = $starTime; $i <= $endTime;) {
            $j = $i + 86400;
            $field = date('Y-m-d', $i);
            $array['visittime'][] = $field;
            $array['tnum'][$field] = 0;
            $array['fnum'][$field] = 0;
            $array['bnum'][$field] = 0;
            $i = $j;
        }
        
        return $array;
    }
    /**
     * 批量删除
     */
    public function clear() {
        DTExpression::ge('tj_time', $_REQUEST, 'start_time');
        DTExpression::le('tj_time', $_REQUEST, 'end_time');
        DTOrder::$sql = isset($where['order']) ? $where['order'] : '';

        $StatisticsLogArray = $this->getByComposite(ORMMap::$classes[$this->tableName], DTExpression::$sql . DTOrder::$sql . DTExpression::$limit);

        $ids = array();
        foreach ($StatisticsLogArray as $key => $value) {
            $ids[] = $value->id;
        }
        $StatisticsLogArray = $this->getBatch($ids);
        R::trashAll($StatisticsLogArray);

        return new Result(true, 0, '', NULL);
    }	
}
