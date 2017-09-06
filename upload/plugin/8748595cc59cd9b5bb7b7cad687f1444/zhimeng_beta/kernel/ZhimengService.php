<?php

class ZhimengService extends BaseService {

    /**
     * 构造函数
     */
    public function __construct() {
        $this->dao = new ZhimengDAO();
        
    }
    
    /**
     * 判断用户之前是否有保存数据库信息 ...
     */
    public function haveMsg(){
    	if(isset($_COOKIE['mysqlMsg'])){
    		return $this->success($_COOKIE['mysqlMsg']);//感觉这里很不合理啊
    	}else{
    		return $this->fail('','');
    	}
    }

    /**
     * 设置数据库的信息...
     */
    public function addDatabase(){
    	
    	if(isset($_REQUEST['isremmenber']) && $_REQUEST['isremmenber'] != ''){
    		setcookie('mysqlMsg[url]',$_REQUEST['url'],time()+7200);
    		setcookie('mysqlMsg[name]',$_REQUEST['name'],time()+7200);
    		setcookie('mysqlMsg[user]',$_REQUEST['username'],time()+7200);
    		setcookie('mysqlMsg[pwd]',$_REQUEST['password'],time()+7200);
    		setcookie('mysqlMsg[isremmenber]',$_REQUEST['isremmenber'],time()+7200);
  		
    	}else{
    		setcookie('mysqlMsg[url]',$_REQUEST['url'],time()-7200);
    		setcookie('mysqlMsg[name]',$_REQUEST['name'],time()-7200);
    		setcookie('mysqlMsg[user]',$_REQUEST['username'],time()-7200);
    		setcookie('mysqlMsg[pwd]',$_REQUEST['password'],time()-7200);
    		setcookie('mysqlMsg[isremmenber]',$_REQUEST['isremmenber'],time()-7200);
    	}
    	return $this->success();
    }
    
    /**
     * 清空本地数据库...
     */
    public function clearTable(){
    	$re = $this->dao->clearTable();
    	return $this->success();
    }
    
    /**
     * 保存织梦数据...
     */
    public function saveZmdata($entity){
    	$sql = $this->dao->saveZmdata($entity);
    	return $this->success();
    }
    
    /**
     * 获取zmdata表中数据 ...
     */
    public function getZmDatas($where){
    	$data = $this->dao->getZmDatas($where);
    	return $this->success($data);
    }
    
    /**
     * 获取zmdata表中的总数 ...
     */
    public function getZmdataCount(){
    	$count = $this->dao->getZmdataCount();
    	return $this->success($count);
    }
    
    /**
     * 同步疾病seo信息 ...
     */
    public function synDiseaseSeo($id){
   		$typeDatas = unserialize($_SESSION['typenamedata']);
    	//获取疾病名称
    	$diease_id = $id;
    	$diseaseS = new DiseaseService();
    	$disease = new Disease();
    	$disease->id = $diease_id;
    	$diseaseData = $diseaseS->get($disease);
    	$diseaseName = $diseaseData->data->name;
    	$disease = $diseaseData->data;
    	foreach ($typeDatas as $types){
    		if($types['typename'] == $diseaseName){
    			$disease->title = $types['seotitle'];
    			$disease->keywords = $types['keywords'];
    			$disease->description = $types['description'];
    			$diseaseS->update($disease);
    		}
    	}
    }
    
    /**
     * 将数据保存到本地  ...
     */
    public function saveDataLocal(){
    	if($_REQUEST['disease_id'] == ''){
    		throw new Exception('请选择要移动到栏目');
    	}
    	$disease_id = (int)$_REQUEST['disease_id'];
    	//同步疾病的seo信息
    	$this->synDiseaseSeo($disease_id);    	
    	//同步文章信息
    	$data = $_REQUEST['data'];
    	$disease = new Disease();
    	$disease->id=$disease_id;
    	$diseaseservice=new DiseaseService();
    	$diseaseresult=$diseaseservice->get($disease);
    	$department_id=$diseaseresult->data->department_id;
    	$articleservice=new ArticleService();
    
    	
    	
    	
    	
    	
    	foreach ($data as $value){
    		
    		
    		$res=$this->dao->getsidedate(array('id'=>(int)$value));
    		
 		
    		$article = new Article();
    		//$article->id = $value['id'];
    		$article->subject     	= $res->title;
    		$article->content 	  	= $res->body;
    		$article->title       	= $res->title;
    		$article->keywords    	= $res->keywords;
    		$article->description 	= $res->description;
    		$article->disease_id  	= (int)$_REQUEST['disease_id'];
    		$article->department_id = $department_id;
    		$article->isbidding		= 0;
    		//$article->plushtime 	= time();
       	 	//$article->updatetime 	= time();
       	 	//$article->click_count 	= rand(30, 100);
        	//$article->worker_id 	= $_SESSION['id'];
        	$article->pic			= $res->litpic;
        	$article->doctor_id		= 0;
        	$article->is_top		= 0;
        	
    		//$re = $this->addDataLoca($article);
        	$articleservice->save($article);
        	
        	$this->dao->delete((int)$value);

     	}
     	
//      	$array = array('stute'=>true, 'msg'=>null, 'code'=>null, 'data'=>null);
//      	echo json_encode($array);

    }
    
    /**
     * 添加数据到article表 ...
     */
    public function addDataLoca($entity){
    	$result = $this->dao->addDataLoca($entity);
    	return $result;
    }
    
    /*
     * 根据id取数据库里的信息
     * */
    public function getdetailbyid($id){
    	
    }
    
    
    /**
     * 更新文章信息 ...
     */
    public function updateArticle($entity){
    	$articleS = new ArticleService();
    	$result = $articleS->update($entity);
    	return $result;
    }
}
