<?php
//载入入口文件
include_once 'init.php';

/**
 * 
 * 医院介绍
 * @author Administrator
 *
 */
class introduceMobile extends Mobile {
	
	/**
	 * 
	 * 构造方法,通过method方法,调取对应的输出函数
	 * @param unknown_type $method
	 */
	public function __construct() {
		parent::__construct();
		$this->excute();
	}
	
	public function index(){
		$introduce = $this->getServiceMethod('Introduce','get');
		if($introduce->data!=null){
			$this->smarty->assign('data',$introduce->data);
		}
		$channel = $this->getServiceMethod('channel','query',array('shortname'=>'yiyuanwenhua'));//取医院文化的栏目
		
		if(!empty($channel->data)){
			$channelarticles = $this->getServiceMethod('channelArticle','query',array('channel_id'=>$channel->data['0']->id));//获取医院文化文章	
			if(!empty($channelarticles->data)){
			$this->smarty->assign('wenhua',$channelarticles->data['0']);
			}else{
				$this->smarty->assign('wenhua',"");
			}
		}else{
			$this->smarty->assign('wenhua',"");
		}
		
		$environment = $this->getServiceMethod('environment','query',array('page'=>1,'size'=>4));//取医院环境
		$hulichannel = $this->getServiceMethod('channel','query',array('shortname'=>'hulijianjie'));//取医院文化的栏目
		if(!empty($hulichannel->data)){
			$huliarticles = $this->getServiceMethod('channelArticle','query',array('channel_id'=>$hulichannel->data['0']->id));//获取医院文化文章			
			$this->smarty->assign('huidataid',$hulichannel->data['0']->id);
			$this->smarty->assign('huidata',$huliarticles->data);		
		}
		$hulidongtai = $this->getServiceMethod('channel','query',array('shortname'=>'hulidongtai'));//取医院文化的栏目
		
		if(!empty($hulidongtai->data)){
			$hudongtaiarticles = $this->getServiceMethod('channelArticle','query',array('channel_id'=>$hulidongtai->data['0']->id));//获取医院文化文章
				
			$this->smarty->assign('hudongtai',$hudongtaiarticles->data);
			$this->smarty->assign('hudongtaiid',$hulidongtai->data['0']->id);
		}
		$tongzhi = $this->getServiceMethod('channel','query',array('shortname'=>'tongzhigonggao'));//取医院通告
		if(!empty($tongzhi->data)){
			$tongzhiarticles = $this->getServiceMethod('channelArticle','query',array('channel_id'=>$tongzhi->data['0']->id));//获取医院文化文章
		
			$this->smarty->assign('tongzhi',$tongzhiarticles->data);
			$this->smarty->assign('tongzhiid',$tongzhi->data['0']->id);
		}
		$tianshi = $this->getServiceMethod('channel','query',array('shortname'=>'tianshifengcai'));//取医院通告
		if(!empty($tianshi->data)){
			$tianshiarticles = $this->getServiceMethod('channelArticle','query',array('channel_id'=>$tianshi->data['0']->id));//获取医院文化文章
		
			$this->smarty->assign('tianshi',$tianshiarticles->data);
		}
		$guanli = $this->getServiceMethod('channel','query',array('shortname'=>'guanliguifan'));//取管理规范
		if(!empty($guanli->data)){					
			$this->smarty->assign('guanliid',$guanli->data['0']->id);
		}
		$hushijinxiu = $this->getServiceMethod('channel','query',array('shortname'=>'hushijinxiu'));//取护士进修
		if(!empty($hushijinxiu->data)){
			$this->smarty->assign('hushijinxiuid',$hushijinxiu->data['0']->id);
		}
		$zhuankehuli = $this->getServiceMethod('channel','query',array('shortname'=>'zhuankehuli'));//取护士进修
		if(!empty($zhuankehuli->data)){
			$this->smarty->assign('zhuankehuliid',$zhuankehuli->data['0']->id);
		}
		$xinxigongkai = $this->getServiceMethod('channel','query',array('shortname'=>'xinxigongkai'));//取护士进修
		if(!empty($xinxigongkai->data)){
			$xinxiarticles = $this->getServiceMethod('channelArticle','query',array('channel_id'=>$xinxigongkai->data['0']->id));//获取医院文化文章
			$this->smarty->assign('xinxigongkaiid',$xinxigongkai->data['0']->id);
			$this->smarty->assign('xinxiarticle',$xinxiarticles->data);
		}
		$guanlizhidu = $this->getServiceMethod('channel','query',array('shortname'=>'guanliguifan'));//取护士进修
		if(!empty($guanlizhidu->data)){
			$guanliarticles = $this->getServiceMethod('channelArticle','query',array('channel_id'=>$guanlizhidu->data['0']->id));//获取医院文化文章
			$this->smarty->assign('guanlizhiduid',$guanlizhidu->data['0']->id);
			$this->smarty->assign('guanliarticle',$guanliarticles->data);
		}
		$dashiji = $this->getServiceMethod('channel','query',array('shortname'=>'dashiji'));//取护士进修
		if(!empty($dashiji->data)){
			$dashijiarticles = $this->getServiceMethod('channelArticle','query',array('channel_id'=>$dashiji->data['0']->id));//获取医院文化文章
			$this->smarty->assign('dashijiid',$dashiji->data['0']->id);
			$this->smarty->assign('dashijiarticles',$dashijiarticles->data);
		}
		$banshizhinan = $this->getServiceMethod('channel','query',array('shortname'=>'banshizhinan'));//取护士进修
		if(!empty($banshizhinan->data)){
			$banshizhinanarticles = $this->getServiceMethod('channelArticle','query',array('channel_id'=>$banshizhinan->data['0']->id));//获取医院文化文章
			$this->smarty->assign('banshizhinanid',$banshizhinan->data['0']->id);
			$this->smarty->assign('banshizhinanarticles',$banshizhinanarticles->data);
		}
		$xiazaizhongxin = $this->getServiceMethod('channel','query',array('shortname'=>'xiazaizhongxin'));//取护士进修
		if(!empty($xiazaizhongxin->data)){
			$xiazaiarticles = $this->getServiceMethod('channelArticle','query',array('channel_id'=>$xiazaizhongxin->data['0']->id));//获取医院文化文章
			$this->smarty->assign('xiazaizhognxinid',$xiazaizhongxin->data['0']->id);
			$this->smarty->assign('xiazaiarticles',$xiazaiarticles->data);
		}
		
		
		
		$this->smarty->assign('environment',$environment->data);
		$this->smarty->display( 'Introduce/index' . TPLSUFFIX );
	}
	
	/**
	 * 
	 * 获取医院介绍详细信息
	 */
	public function getInfo() {
		$this->smarty->assign( 'data' , $this->result->data );
		//取疾病列表
		$diseases = $this->getServiceMethod('disease','query',array());
		//取医生
		$doctors  = $this->getServiceMethod('doctor','query',array());
		//取特色技术
		$technologys  = $this->getServiceMethod('technology','query',array());	
		//取先进设备
		$devices  = $this->getServiceMethod('device','query',array());		
		//取医院新闻
		$news  = $this->getServiceMethod('news','query',array());	

		//取广告图
		$mobileAd =$this->getServiceMethod('MobilePicManager','getByFlag','mobile_ad');
		$this->smarty->assign('mobileAd',$mobileAd->data);
		//手机模板自定义导航注入		
        $mobileNav= $this->queryByFlag('mobile_nav');
        $this->smarty->assign('mobileNav',$mobileNav);
        
		$this->smarty->assign('diseases',$diseases->data);
		$this->smarty->assign('doctors',$doctors->data);
		$this->smarty->assign('technologys',$technologys->data);
		$this->smarty->assign('devices',$devices->data);
		$this->smarty->assign('news',$news->data);
		
		$seo = $this->getServiceMethod('Seo','query',array("flag" => "introduce"));
		$this->smarty->assign('seo',$seo->data[0]);
		$this->smarty->display( 'Introduce/index' . TPLSUFFIX );
	}
}

new introduceMobile();
?>