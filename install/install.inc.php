<?php
require_once './config.inc.php';
require_once './function.php';
class  Mysql {
	private $DB = null;
	//链接检测
	private function check() {
		if( ! function_exists( 'mysql_connect' ) ) {
			$this->Install_Msg(false,'你的服务器环境不支持mysql');
		}
		$DB['DBUSER']     = trim( $_REQUEST['DBUSER'] );
		$DB['DBPASSWORD'] = trim( $_REQUEST['DBPASSWORD'] );
		$DB['DBHOST']     = trim( $_REQUEST['DBHOST'] );
		$this->DB = @mysql_connect( $DB['DBHOST'] , $DB['DBUSER'] , $DB['DBPASSWORD'] );
		if( ! $this->DB ) {
			$this->Install_Msg(false,'无法链接数据库：帐号密码或地址有误!');
		}
		return $DB;
	}
/* 	//数据库如果不存在，则实际返回
	private function Mysql_DB_ISSET() {
		if( isset( $_GET['mode'] ) && $_GET['mode'] == 'test' ){
			$DB['DBNAME']     = trim( $_REQUEST['DBNAME'] );
			if( ! @mysql_select_db( $DB['DBNAME'] , $this->DB ) ) {
				$this->Install_Msg(false,'您输入的数据库不存在,我们将为您自动创建!');
			}
		}
	} */
	//数据库帐号密码数据库连接存在检测
	public function Mysql_Test() {
		$this->check();
		//$this->Mysql_DB_ISSET();
		$DB['DBNAME']     = trim( $_REQUEST['DBNAME'] );
		if( ! @mysql_select_db( $DB['DBNAME'] , $this->DB ) ) {
			$sql = "CREATE DATABASE IF NOT EXISTS `". $DB['DBNAME'] ."` DEFAULT CHARSET utf8 COLLATE utf8_general_ci;";
			if(!mysql_query( $sql , $this->DB )){
				$this->Install_Msg(false,'无法创建数据库：'.$DB['DBNAME'].'库创建失败,请检查该用户是否有权限创建');
			}
		}
	}
	//数据库链接
	public function Mysql_Content() {
		if( ! function_exists( 'mysql_connect' ) ) {
			$this->Install_Msg(false,'你的服务器环境不支持mysql');
		}
		require_once '../web-setting.php';
		require_once '../lib/rb.php';
		$this->DB = @mysql_connect( DBHOST , DBUSER , DBPASSWORD );
		if( ! $this->DB ) {
			$this->Install_Msg(false,'数据库链接失败,请检查你填写的数据库信息配置');
		}
		if( ! @mysql_select_db( DBNAME , $this->DB ) ) {
			$this->Install_Msg(false,'数据库链接失败,请检查你的数据库"'.DBNAME.'"是否已创建.');
		}
		@mysql_query("SET @@sql_mode = ''");
		@mysql_query('SET NAMES UTF8',$this->DB);
		//进行innodb事务引擎检测
		$innodb_sql = 'show engines;';
		$exeend = @mysql_query($innodb_sql,$this->DB);
		$is_innodb = false;
		while ( $assoc = mysql_fetch_assoc( $exeend ) ){
			if( strtoupper( $assoc['Engine'] ) == 'INNODB' ){
				$is_innodb = true;
				break;
			}
		}
		if( ! $is_innodb ){
			$this->Install_Msg(false,'您的MYSQL数据库不支持innodb引擎,请先安装.');
		}
	}
	//默认数据sql执行
	public function Mysql_Default( $data ) {
		foreach( $data as $key => $sql ) {
			if( $this->Mysql_Excute( $sql ) === false ){
				$this->Install_Msg(false,'系统初始化数据写入失败.');
			}
		}
	}
	//sql语句执行
	public function Mysql_Excute( $sql ) {
		return mysql_query( $sql , $this->DB );
	}
}
class Install extends Mysql {
	//数据库信息配置
	public function Install_DB(){
		$DB['DBNAME']     = trim( $_REQUEST['DBNAME'] );
		$DB['DBUSER']     = trim( $_REQUEST['DBUSER'] );
		$DB['DBPASSWORD'] = trim( $_REQUEST['DBPASSWORD'] );
		$DB['DBHOST']     = trim( $_REQUEST['DBHOST'] );
		
		//新增患者管理数据库配置信息，默认与系统同一服务器，配置可实现数据库分离
		$DB['IN_DBNAME']     = trim( $_REQUEST['DBNAME'] );
		$DB['IN_DBUSER']     = trim( $_REQUEST['DBUSER'] );
		$DB['IN_DBPASSWORD'] = trim( $_REQUEST['DBPASSWORD'] );
		$DB['IN_DBHOST']     = trim( $_REQUEST['DBHOST'] );
		
		$WebSettingFile = './web-setting.php';
		if( file_exists( $WebSettingFile ) ) {
			$content = @file_get_contents( $WebSettingFile );
			//是否可写
			if( ! is_writable( $WebSettingFile ) ) {
				$this->Install_Msg(false,'配置文件写入失败,原因：配置文件不可写或没有写入的权限.');
			}
			if( $content != '' ){
				foreach( $DB as $key => $value ) {
					$content = str_replace( '{~'. $key .'~}' , $value , $content );
				}
				file_put_contents( '../web-setting.php' , $content );
			}else{
				$this->Install_Msg(false,'数据库配置文件内容错误!');
			}
		}else{
			$this->Install_Msg(false,'系统配置文件不存在!');
		}
	}
	//检测数据库链接
	public function Install_TESTCONNECT(){
		$this->Mysql_Test();
	}
	//安装数据库结构(加载数据结构)
	public function Install_DT(){
		$matches = GetStructureInfo();
		if( $matches === false ) {
			$this->Install_Msg(false,'博医CMS数据表结构文件不存在!');
		}else if( count( $matches[0] ) <= 0 ){
			$this->Install_Msg(false,'博医CMS数据表结构文件错误!');
		}
		$this->Install_Msg(true,array('sum'=>count( $matches[0] )));
		
	}
	//安装数据库结构(实际分步安装)
	public function Install_DTD(){
		$this->Mysql_Content();
		$i = (int)$_REQUEST['i'];
		$StructureInfo = GetStructureInfo();
		if( isset( $StructureInfo [0] [ $i ] ) ) {
			$pattern = "#CREATE TABLE `(.*)`#iUs";
			preg_match_all($pattern, $StructureInfo [0] [ $i ], $matches);
			$sql = "SET FOREIGN_KEY_CHECKS=0;";
			if( $this->Mysql_Excute( $sql ) === false ){
				$this->Install_Msg(false,'数据表安装失败,无法关闭外键约束.');
			}
			$sql = "DROP TABLE IF EXISTS `". $matches[1][0] ."`;";
			if( $this->Mysql_Excute( $sql ) === false ){
				$this->Install_Msg(false,'数据表安装失败,请检查您是否具有表操作权限,名称：'.$matches[1][0]);
			}
			$sql = $StructureInfo [0] [ $i ];
			if( $this->Mysql_Excute( $sql ) === false ){
				$this->Install_Msg(false,'数据表安装失败,请检查您是否具有表操作权限,名称：'.$matches[1][0]);
			}
			$this->Install_Msg(true,'正在创建表:' . $matches[1][0] );
		}
	}
	//安装必须存在的数据包(指的是联系方式跟seo信息)
	private function Install_MUST(){
		$this->Mysql_Content();
		global $config;
		$Contact    = $config['Contact_Sql'];
		$Seo        = $config['Seo_Sql'];
		$Introduce  = $config['Introduct_Sql'];
		$ArticleSq  = $config['Article_Sql'];
		$RuleSql  = $config['Rule_Sql'];
		$this->Mysql_Default( $Contact );
		$this->Mysql_Default( $Seo );
		$this->Mysql_Default( $Introduce );
		$this->Mysql_Default( $ArticleSq );
		$this->Mysql_Default( $RuleSql );
	}
	//安装数据库升级sql_change文件
	private function Install_SQL_CHANGE(){
		$change_file = './sql_change.txt';
		if( file_exists( $change_file ) ){
			$change_content = file_get_contents( $change_file );
			if( trim( $change_content ) != '' ){
				$data = explode("\r\n", $change_content);
				if( count( $data ) >= 1 ){
					foreach ( $data as $key => $value ){
						$this->Mysql_Excute( $value );
					}
				}
			}
		}
		
	}
	//设置网站联系方式(修改,不是添加)
	public function Install_HS(){
		$this->Install_MUST();
		$this->Install_SQL_CHANGE();
		global $config;
		$Contact = $config['System_Contact'];
		foreach( $Contact as $key => $value ) {
			if( isset( $_REQUEST[ $key ] ) && $_REQUEST[ $key ] != '' ) {
				$sql  = "";
				$sql  = "update `contact` set `val`='{$_REQUEST[ $key ]}' where `flag`='{$value['flag']}'";
				if( $this->Mysql_Excute( $sql ) === false ){
					$this->Install_Msg(false,'网站联系方式设置失败,请检查是否具有更新权限.');
				}
			}
		}
	}
	//初始化管理员账户信息
	public function Install_AD(){
		$this->Mysql_Content();
		$AD_USER = trim( $_REQUEST['AD_USER'] );
		$AD_PASS = trim( $_REQUEST['AD_PASS'] );
		$AD_TPL  = trim( $_REQUEST['tel'] );
		if( $AD_USER == '' || $AD_PASS == '' || ( strlen( $AD_PASS ) < 6 ) ) {
			$this->Install_Msg(false,'网站管理员账户名或账户密码填写不正确!');
		}
		$AD_PASS = md5( md5( $AD_PASS ) );
		$AD_TIME = time();
		$sql  = "INSERT INTO `worker` (`name`,`password`,`group_id`,`plushtime`,`purview`,`telephone`,`nick_name`) ";
		$sql .= "VALUES ('{$AD_USER}','{$AD_PASS}','1','{$AD_TIME}','','{$AD_TPL}','');";
		if( $this->Mysql_Excute( $sql ) === false ){
			$this->Install_Msg(false,'管理员信息设置失败,请检查是否具有写入权限.');
		}
	}
	//安装初始化数据包
	public function Install_DD(){
		$install = trim( $_REQUEST['install'] );
		switch($install){
			case 'true':
				$defaultDDfile = './hwibs_default.sql';
				if( ! file_exists( $defaultDDfile ) ){
					$this->Install_Msg(false,'初始化数据包不存在,请重新下载最新的博医CMS!');
				}
				$this->Mysql_Content();
				$sql = file_get_contents( $defaultDDfile );
				if( $this->Mysql_Excute( $sql ) === false ){
					$this->Install_Msg(false,'初始化数据包写入失败.');
				}
				break;
			case 'false':
				break;
			default:break;
		}
	}
	//安装用户选择模版
	public function Install_TP(){
		if( isset( $_REQUEST['id'] ) ){
			require_once '../web-setting.php';
			$zipID = $_REQUEST['id'];
			//需要安装才安装
			if( $zipID != 'none' ) {
				$zipFile = GENERATEPATH . 'template_c/'.$zipID.'.zip';
				if( ! file_exists( $zipFile ) ) {
					$this->Install_Msg(false,'模版安装失败,模版包不存在,可能没有下载成功!');
				}
				$url = NETADDRESS . '/controller/?controller=Template&method=templateInstall&zipFile='.$zipFile;
				$result  = file_get_contents( $url );
				$content = json_encode( $result );
				//是否有必要判断是否安装成功？
			}
		}else{
			$this->Install_Msg(false,'模版安装失败,请刷新页面重试安装');
		}
	}
	//首页生成
	public function Install_IN(){
		if( isset( $_REQUEST['tp'] ) ){
			$tp     = $_REQUEST['tp'];
			//用户需要选择了模版的情况下生成模版中的首页
			if( $tp != 'none' ) {
				require_once '../web-setting.php';
				$url     = NETADDRESS . '/controller/?controller=MakeHtml&method=index&op=index';
				$result  = file_get_contents( $url );
			//如果没有选择模版,则复制默认首页
			}else{
				@copy( './dist/template/index.html' , '../index.html' );
			}
		}
		install( 'success' );
	}
	//消息输出
	public function Install_Msg($Boolean,$Msg = ''){
		die( json_encode( array( 'statu' => $Boolean , 'msg' => $Msg ) ) );
	}
}
$Install = new Install();
if( isset( $_REQUEST['method'] ) && $_REQUEST['method'] != '' ) {
	$method_name = 'Install_' . strtoupper( trim( $_REQUEST['method'] ) );
	if( method_exists($Install, $method_name) ) {
		$Install->$method_name();
		$Install->Install_Msg(true);
	}
}
$Install->Install_Msg(false,'安装失败');
?>