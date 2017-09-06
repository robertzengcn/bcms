<?php
function smarty_function_getReservation($params,&$smarty){
	$start = isset($params['start']) ? $params['start'] : '';
	$end = isset($params['end']) ? $params['end'] : '';
	$model = isset($params['model']) ? (int)$params['model'] : 1;
	$ser = new ReservationTag();
	$data = $ser->getLimitAll($start,$end,$model);
	//print_r($data);
	$fun = explode('_',__FUNCTION__);
	$fun = $fun[2];
	$assign = isset($params['assign']) ? $params['assign'] : $fun;
	$smarty->assign ( $assign , $data );
}