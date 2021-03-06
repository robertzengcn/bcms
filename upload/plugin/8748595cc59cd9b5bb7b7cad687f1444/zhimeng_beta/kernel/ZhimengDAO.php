<?php

class ZhimengDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_ZMDATA;
    }

    /**
     * 清空本地数据库...
     */
    public function clearTable(){
    	R::exec('delete from zmdata');
    	return true;
    }
    
 public function getsidedate($arr){
 	
 	$dededata = R::batch('zmdata',$arr);
 	//return $dededata;
 	$zhimens = array();
 	foreach ($dededata as $key => $value) {
 		if ($value->id != 0) {
 			
 			$zhimens[]=$value;
 			
 		}
 	}
 	return $zhimens[0];
 }
    
    /**
     * 将织梦数据保存到数据库...
     */
    public function saveZmdata($entity){
    	$entity->description = str_replace("'", '"', $entity->description);
    	$entity->body = str_replace("'", '"', $entity->body);
    	//$sql = "insert zmdata (id,title,litpic,keywords,description,body) values ({$entity->id},'{$entity->title}','{$entity->litpic}','{$entity->keywords}','{$entity->description}','{$entity->body}')";
    	R::exec("insert zmdata (id,title,litpic,keywords,description,body) values ({$entity->id},'{$entity->title}','{$entity->litpic}','{$entity->keywords}','{$entity->description}','{$entity->body}')");
    	return $entity;
    }
    
    /**
     * E获取zmdata表中数据 ...
     */
    public function getZmDatas($where){
    	$size = (int)$where['size'];
    	$start = ((int)$where['page'] - 1)*$size;
    	$data = R::find('zmdata',"limit $start,$size");
    	$arr = array();
    	foreach ($data as $bean){
    		$entity = new Zmdata();
    		$entity->generateFromRedBean($bean);
    		$arr[] = $entity;
    	}
    	return $arr;
    }
    
    /**
     * 获取zmdata表中的总数 ...
     */
    public function getZmdataCount(){
    	$count = R::count('zmdata');
    	return $count;
    }
    
    /**
     * 添加数据到article表 ...
     */
    public function addDataLoca($entity){
    	$tablename = TABLENAME_ARTICLE;
    	$bean = R::load($tablename, $entity->id);
    	$array = array();
    	if($bean->id == 0){
    		$sql = "insert {$tablename} (id,subject,pic,content,click_count,title,keywords,description,plushtime,updatetime,isbidding,department_id,disease_id,worker_id,doctor_id,is_top) values ({$entity->id},'{$entity->subject}','{$entity->pic}','{$entity->content}',{$entity->click_count},'{$entity->title}','{$entity->keywords}','{$entity->description}','{$entity->plushtime}','{$entity->updatetime}',{$entity->isbidding},{$entity->department_id},{$entity->disease_id},{$entity->worker_id},{$entity->doctor_id},{$entity->is_top})";
    	}else{
    		//$sql = "update {$tablename} set subject='{$entity->subject}',pic='{$entity->pic}',content='{$entity->content}',click_count={$entity->click_count},title='{$entity->title}',keywords='{$entity->keywords}',description='{$entity->description}',plushtime={$entity->plushtime},updatetime={$entity->updatetime},isbidding={$entity->isbidding},department_id={$entity->department_id},disease_id={$entity->disease_id},worker_id={$entity->worker_id},doctor_id={$entity->doctor_id} where id={$entity->id}";
    		$array[] = $entity;
    		return $array;
    	}
    	//echo $sql;exit;
    	R::exec($sql);
    	return $entity;
    }
}
