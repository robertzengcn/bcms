<?php 
/**
 * 搜索
 */
class SearchDAO extends DBBaseDAO {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function query($keyword) {
		$where['subject'] = $keyword;
		$i = 0;
		$tables = array('article','news','mediareport','success','moive','technology');
		foreach ($tables as $v){
			$search = $v."_search";
			DTExpression::like('subject', $where, $v);
			$sql = ORMMap::$sqlMap[$search] . ' where ' . DTEXPRESSION::$sql . DTOrder::$sql . DTExpression::$limit;
			$result = $this->getJoin($sql);
		 	
			if(!empty($result)){
				foreach($result as $k=>$val){
					$array[$i] = $val;
				    if($v == 'article'){
						$array[$i]->urls = "/".$array[$i]->department_url.'/'.$array[$i]->disease_url."/".$array[$i]->id.".html";
					}else{
						$array[$i]->urls = '/hospital/'.$v.'/'.$array[$i]->id.'.html';
					} 
					$i++;
				}
				return $array;
			} else{
				return null;
			}
		}
		
	}
}