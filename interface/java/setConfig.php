<?php
/**
 * 读取java安装配置文件
 */
if( isset($_REQUEST['filename']) && $_REQUEST['filename'] != '' ){
$filePath = '../../'.$_REQUEST['filename'];
}else{
$filePath = '../../config.php';
}
if( !file_exists($filePath) ){
	die('-1');return false;
}
$content = @file_get_contents($filePath);
if( trim( $content ) == '' ){
	die('-2');return false;
}
$content = mb_substr($content,1,mb_strlen( $content ));
$content = mb_substr($content,0,mb_strlen( $content ) - 1);
$dataArray = explode(',', $content);
foreach ($dataArray as $key => $value){
	$dataArray[$key] = trim( $value );
}
$tempData = null;
$tempSize = array(
	'buisnessID'=>'swt',
	'address'=>'address',
	'tel'=>'tel',
	'busRoute'=>'route',
	'name'=>'name',
	'domain'=>'domain',
	'qq'=>'qq',
	'icp'=>'icp'
);
$hand = @mysql_connect('localhost','root','hiwbs#!');
if( !$hand ){
	die('-3');return false;
}
@mysql_select_db('hwibs_model');
@mysql_query('SET NAMES UTF8',$hand);
foreach ($dataArray as $key => $value){
	$tempData = explode('=',trim( $value ));
	$sql = "UPDATE `contact` SET `val`='".$tempData[1]."' WHERE `flag`='".$tempSize[$tempData[0]]."';";
	@mysql_query($sql,$hand);
}
echo "<script type='text/javascript'>location.href='http://localhost:8099/hcc';</script>";
?>