<?php
/**
 * 
 * 手机模版切换[安装]数据初始化切换工作
 * @author 全球医院网
 * @version 1.0
 *
 */
class MobileIni {
	
	//设置模版变量文件夹命名空间
	private $project = '';
	
	/**
	 * 
	 * 构造函数,传入被切换与切换后的模版名称(英文),用于进行初始化数据切换工作
	 * @param string $front   被切换的模版
	 * @param string $behind  切换后的模版
	 * @param string $project 项目文件夹[app\mobile\wechat]
	 * @info 被切换的模版可以为空，原因是首次选择模版的时候，是没有被切换模版的!
	 */
	public function __construct($front = '' , $behind = '' , $project = '' ) {
		//设置项目目录
		switch ( $project ){
			case 'mobile':$this->project = GENERATEPATH . 'mobile/Tpl/';break;
			case 'app':$this->project = GENERATEPATH . 'app/Tpl/';break;
			case 'wechat':$this->project = GENERATEPATH . 'wechat/Tpl/';break;
			default:$this->project = GENERATEPATH . 'mobile/Tpl/';break;
		}
		require_once '../web-setting.php';
		include_once GENERATEPATH . 'lib/analyze.php';
		if( $front == '' ){
			new analyze_stencil('',$this->project . $behind);
		}else{
			new analyze_stencil($this->project . $front,$this->project . $behind);
		}
	}
	
	public function getError(){
		$iniRunEnd['msg'] = true;
		return $iniRunEnd;
	}
	
}
?>