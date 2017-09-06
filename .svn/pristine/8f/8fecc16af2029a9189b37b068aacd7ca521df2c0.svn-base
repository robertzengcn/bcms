<?php
/**
 * 
 * 模版切换数据初始化切换工作
 * @author 全球医院网
 * @version 1.0
 *
 */
if( isset($_REQUEST['install']) && $_REQUEST['install'] == 'javaInstall' ){
	@session_start();
	$_SESSION['is_java_install'] = 'true';
	new TemplateIni('',$_REQUEST['behind']);
	echo "<script type='text/javascript'>location.href='http://localhost:8099/interface/java/setConfig.php';</script>";
}
class TemplateIni {
	/**
	 * 
	 * 构造函数,传入被切换与切换后的模版名称(英文),用于进行初始化数据切换工作
	 * @param string $front  被切换的模版
	 * @param string $behind 切换后的模版
	 * @info 被切换的模版可以为空，原因是首次选择模版的时候，是没有被切换模版的!
	 */
	public function __construct($front = '' , $behind = '' ) {
		require_once '../web-setting.php';
		include_once GENERATEPATH . 'lib/analyze.php';
		if( $front == '' ){
			new analyze_stencil('',TEMPDIR . $behind);
		}else{
			new analyze_stencil(TEMPDIR . $front,TEMPDIR . $behind);
		}
	}
	
	public function getError(){
		$iniRunEnd['msg'] = true;
		return $iniRunEnd;
	}
}
?>