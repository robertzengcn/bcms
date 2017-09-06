<?php
/**
 * 
 * 网站地图tag标签
 * @author Administrator
 *
 */
class SiteMapTag extends CommonTag {
	
	/**
	 * 
	 * 构造方法
	 */
	function __construct() {
		$this->service = null;
		parent::__construct( get_class() );
	}
	
	/**
	 * 
	 * 获取头部导航
	 */
	public function getHeadAdv() {
		$navigationTag = new NavigationTag();
		$header = $navigationTag->getTop();
		foreach( $header as $key => $value ) {
			$header[$key] = (object)$header[$key];
			$header[$key]->lastmod    = date('Y-m-d',time());
			$header[$key]->changefreq = 'daily';
			$header[$key]->priority   = '1.0';
		}
		return $header;
	}
	
	/**
	 * 获取所有科室列表
	 */
	public function getDepartment() {
		//科室
		$departmentService = new DepartmentService();
		$departmentArray   = $departmentService->getListAll()->data;
		foreach( $departmentArray as $key => $value ) {
			$departmentArray[$key]->lastmod    = date('Y-m-d',time());
			$departmentArray[$key]->changefreq = 'daily';
			$departmentArray[$key]->priority   = '1.0';
		}
		//疾病分组
		$diseaseService        = new DiseaseService();
		$diseaseArray          = $diseaseService->query( array() )->data;
		$this->diseaseArrays   = array();
		foreach( $diseaseArray as $key => $value ) {
			$this->diseaseArrays[ $value->department_id ][] = (array) $value; 
		}
		return $departmentArray;
	}
	
	/**
	 * 获取所有疾病列表
	 */
	public function getDiease($id) {
		$diseaseArray = $this->diseaseArrays[ (int)$id ];
		foreach( $diseaseArray as $key => $value ) {
			$diseaseArray[$key] = (object)$diseaseArray[$key];
			$diseaseArray[$key]->lastmod    = date('Y-m-d',time());
			$diseaseArray[$key]->changefreq = 'daily';
			$diseaseArray[$key]->priority   = '1.0';
		}
		return $diseaseArray;
	}
	
	public function getByDisease($id){
	    $ArticleService = new ArticleService();
	    $artArray =  $ArticleService->getByDisease($id);
	    return $artArray->data;
	}
	
	public function getNews(){
	    $newsService = new NewsService();
	    $newsArray =  $newsService->query(array());
	    return $newsArray->data;
	}
	
	public function getMedia(){
	    $Service = new MediaReportService();
	    $array =  $Service->query(array());
	    return $array->data;
	}
	public function getMovie(){
	    $Service = new MovieService();
	    $array =  $Service->query(array());
	    return $array->data;
	}	
	public function getTechnology(){
	    $Service = new TechnologyService();
	    $array =  $Service->query(array());
	    return $array->data;
	}	
	public function getSuccess(){
	    $Service = new SuccessService();
	    $array =  $Service->query(array());
	    return $array->data;
	}	
	
	public function getDevice(){
	    $Service = new DeviceService();
	    $array =  $Service->query(array());
	    return $array->data;
	}	
	
	public function getHonor(){
	    $Service = new HonorService();
	    $array =  $Service->query(array());
	    return $array->data;
	}	
	public function getEnvironment(){
	    $Service = new EnvironmentService();
	    $array =  $Service->query(array());
	    return $array->data;
	}	
	public function getDoctor(){
	    $Service = new DoctorService();
	    $array =  $Service->query(array());
	    return $array->data;
	}	
	
}


