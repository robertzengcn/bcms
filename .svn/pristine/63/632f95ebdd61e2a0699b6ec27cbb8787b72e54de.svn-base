<?php
require_once './config.inc.php';
/**
 * 
 * 用户获取最新博医系统安装协议
 * @method GetAgreeMent
 * @return string 协议内容
 */
function GetAgreeMent(){
	$url = './agreement.txt';
	if( $content = file_get_contents( $url ) ){
		return $content;
	}
	return '';
}
/**
 * 
 * 通过key名称获取指定的服务器信息
 * @method GetServerInfo
 * @param $key 健名称
 * @return string 值
 */
function GetServerInfo( $key ){
	$ServerInfo = $_SERVER;
	if( isset( $ServerInfo[ $key ] ) && $ServerInfo[ $key ] != '' ){
		return $ServerInfo[ $key ];
	}
	return '';
}
/**
 * 
 * 获取当前环境PHP版本
 * @method GetPhpVersion
 * @return string version
 */
function GetPhpVersion(){
	return PHP_VERSION;
}
/**
 * 
 * 根据key检测对应的函数是否被当前系统所支持
 * @method GetMethodExist
 * @param $method 函数名称
 * @param $trip 提示信息
 * @return string On || Off
 */
function GetMethodExist( $method , $trip ) {
	switch( $method ){
		case 'pdo_mysql':
			$loaded = get_loaded_extensions();
			$trip = '&nbsp;(<font color="#777">'.$trip.'</font>)';
			foreach ( $loaded as $value ){
				if( strtolower( $value ) == 'pdo_mysql' ){
					return '<font color="green">On</font>' . $trip;
				}
			}
			return '<font color="red">Off</font>' . $trip;
			break;
		default:
			$trip = '&nbsp;(<font color="#777">'.$trip.'</font>)';
			if( function_exists ( $method ) ) {
				return '<font color="green">On</font>' . $trip;
			}else{
				return '<font color="red">Off</font>' . $trip;
			}
			break;
	}
}
/**
 * 读取配置文件中的网站联系方式数组
 * @method GetContactInput
 * @return array 需求数组
 */
function GetContactInput() {
	global $config;
	return $config['System_Contact'];
}
/**
 * 读取并解析数据库表结构文件信息
 * @method GetStructureInfo
 * @return array 解析后数组
 */
function GetStructureInfo() {
	$StructureFile = './hwibs_structure.sql';
	if( ! file_exists( $StructureFile ) ) {
		return false;
	}
	$StructureContent = file_get_contents( $StructureFile );
	$pattern = "#CREATE TABLE(.*);#iUs";
	preg_match_all($pattern, $StructureContent, $matches);
	return $matches;
}
/**
 * 获取在线模版列表(免费)
 * @method GetTemplateList
 * @reutr array 
 */
function GetTemplateList() {
    try {
        $url = 'http://www.boyicms.com/interface/hwibs/product/index.php?product=template&method=getList';
        $content = file_get_contents( $url );
        $TemplateList = json_decode( $content , true );
        return $TemplateList['data'];
    } catch (Exception $e) {
        return array();
    }
	
}
/**
 * 
 * 系统需求权限文件夹检测工作
 * @method GetDirAuth
 * @return array 权限数组
 */
function GetDirAuth(){
	global $config;
	$Temp      = null;
	$AuthArray = array();
	define ( 'ABSPATH', rtrim ( $_SERVER ['DOCUMENT_ROOT'], '/' ) );
	if( isset( $config['System_Authority'] ) ) {
		$DirArrays = $config['System_Authority'];
		foreach( $DirArrays as $dir => $auth ) {
			$Temp = explode( ',' , $auth );
			foreach( $Temp as $k => $v ) {
				$MethodName = 'GetPath' . ucfirst( $v );
				$AuthArray[ $dir ] [ $v ] = $MethodName( ABSPATH . $dir );
			}
		}
	}
	foreach( $AuthArray as $k => $v ) {
		if( $v['read'] === true ) {
			$AuthArray [$k]['read'] = '<font color="green">√读<font>';
		}else{
			$AuthArray [$k]['read'] = '<font color="red">×读<font>';
		}
		if( $v['write'] === true ) {
			$AuthArray [$k]['write'] = '<font color="green">√写<font>';
		}else{
			$AuthArray [$k]['write'] = '<font color="red">×写<font>';
		}
	}
	return $AuthArray;
}
/**
 * 
 * 根据路径获取该文件夹(文件)是否有读取权限
 * @method GetPathRead
 * @param $Path 路径
 * @return boolean
 */
function GetPathRead( $Path ){
	if( substr( $Path , -1 , 1 ) == '/' || substr( $Path , -1 , 1 ) == '\\' ) {
		@mkdir( $Path );
	}else{
		$fp = @fopen( $Path , 'w+' );
		@fclose( $fp );
	}
	if( is_dir( $Path ) ) {
		$handler = @opendir( $Path );
		if( $handler === false ){
			return false;
		}
		if( @readdir( $handler ) === false ) {
			return false;
		}
	}else if( is_file( $Path ) ) {
		return @fopen( $Path , 'rb' ) ? true : false;
	}
	return true;
}
/**
 * 
 * 根据路径获取该文件夹(文件)是否有写入权限
 * @method GetPathWrite
 * @param $Path 路径
 * @return boolean
 */
function GetPathWrite( $Path ){
	if( is_dir( $Path ) ) {
	    if (!is_writable( $Path )) {
	    	chmod($Path, '0777');
	    }
		return is_writable( $Path );
	}else if( is_file( $Path ) ) {
		return is_writable( $Path );
	}
	return false;
}
/**
 * 安装执行方法
 * @info 用于检验是否已安装或安装成功后的执行操作
 * @method install
 * @param $mode 模式
 * @return boolean
 */
function install( $mode ){
	switch( $mode ){
		case 'success'://安装成功
			$txt = 'success';
			$file = @fopen( './install.txt' , 'w+');
			if( $file !== false ){
				@fwrite($file, $txt);
			}
			return true;
			break;
		case 'index'://进入安装界面
			$txt = 'success';
			$content = @file_get_contents( './install.txt' );
			if( trim( $content ) == '' || ( trim( $content ) != $txt ) ){
				return true;
			}
			return false;
			break;
		default:return true;break;
	}
}
?>