<?php
require_once '../InterfaceAbstract.php';
/**
 * HM患者管理接口
 * 
 * @author Administrator
 * 
 */
class Patientmanagers extends InterfaceAbstract {
	
	public function __construct(){
		parent::__construct(true);
	}

	public function _begin() {
	    if( isset( $_REQUEST['method'] ) && method_exists( $this ,  '__'.trim( strtolower( $_REQUEST['method'] ) ) ) ) {
	        $method = '__'.trim( strtolower( $_REQUEST['method'] ) );
	        $this->$method();
	    }else{
	        $this->msgPut(false, '缺少method参数或method参数不正确', null, 1);
	    }
	}
	
	/**
	 * 取患者病历列表
	 * 
	 * http://网站/interface/hm/patientmanager.php
	 * @param $_Request['token]: 管理员token
	 * @param $_Request['method']:patientcase 
	 * @param $_Request['case_number']
	 * @param $_Request['type']: 1 初诊,2复诊
	 * @param $_Request['pid']:  0为顶级
	 * 
	 * @example 取患者病历列表则 $_Request['type']=1,$_Request['pid']=0
	 * 
	 * 
	* */
	protected function __patientcase(){
		$case_number=$this->getRequest('case_number',null);
		$type=$this->getRequest('type',1);
		$pid=$this->getRequest('pid',0);
		if(!$case_number){
			$this->msgPut(false,'病例号有误','2',null);
		}
        
		$page=$this->getRequest('page',1);
		$size=$this->getRequest('size',10);
		$patientserviceser=new PatientService();
		
		$result=$patientserviceser->getListPatientCase(array('fcase_number'=>$case_number,'type'=>$type,'pid'=>$pid,'page'=>$page,'size'=>$size));
	
		if(!empty($result['rows'])){
			$this->msgPut(true,null,$result,0);
		}
		$this->msgPut(false,'没有数据',null,'1');
	}
	
	
	/**
	 * 取具体就诊事项
	 * 
	 * http://网站/interface/hm/patientmanager.php
	 * @param case_id
	 * @param $_Request['case_id']
	 * @param $_Request['type]  1为初诊 2为复诊
	 * @param $_Request['pid']: 0为 这个case_id的初诊信息 
	 * @param $_Request['case_number'] 
	 * @return json
	 * 
	 * */
	protected function __getdetailbycase(){
		$case_id=(int)($this->getRequest('case_id',null));
		if(!$case_id){
			$this->msgPut(false,'case_id不正确',null,'16');
		}
		$case_number=$this->getRequest('case_number',"");
		$type=$this->getRequest('type',1);
		$pid=(int)($this->getRequest('pid',0));
		$page=$this->getRequest('page',1);
		$size=$this->getRequest('size',10);
		if($type==2){//复诊
			$pid=$case_id;
		}
		
		$patientserviceser=new PatientService();
		$patientcheckserviceser=new PatientCheckService();
		if($type!=0){
		$result=$patientserviceser->getListPatientCase(array('fcase_number'=>$case_number,'case_id'=>$case_id,'pid'=>$pid,'type'=>$type,'page'=>$page,'size'=>$size));
		}else{
			$result=$patientserviceser->getListPatientCase(array('fcase_number'=>$case_number,'case_id'=>$case_id,'page'=>$page,'size'=>$size,'type'=>$type,));
		}
				if(!empty($result['rows'])){
					foreach($result['rows'] as $key=>$val){
						
						if($val['pic']){
							$result['rows'][$key]['pic']=UPLOAD.$val['pic'];
						}
						$result['rows'][$key]['medical']=$patientserviceser->getPrescriptionsByDetailId($val['detail_id']);
						$result['rows'][$key]['checklist']=$patientcheckserviceser->query(array('pid'=>$val['detail_id']))->data;
					}

					
			$this->msgPut(true,null,$result,0);
		}
		$this->msgPut(false,'没有数据',null,'1');
	}
	
    /**
     * 患者管理密
     * */
    public function __checkPatient() {
		$password=$this->getRequest('password',null);
		if(!$password){
			$this->msgPut(false, '密码不能为空', null);
		}
        $file = ABSPATH . '/hcc/plugin/plugins/patient/password.txt';
        $pwd = trim(file_get_contents($file));
        $flag = false;
        $msg='';        
        if (empty($pwd)) {
            //未设置密码，则默认管理员登陆密码
            $login_id = $_COOKIE['login_id'];
			$patientserviceser=new PatientService();
            $flag = $patientserviceser->checkPwdById($login_id, trim($password));
        } else {
            $flag = md5(trim($password)) == $pwd ? true : false;
        }
        
        if ($flag) {
        	//写入密码文件
        	file_put_contents($file, md5(trim($password)));
        } else {
            $msg = '密码有误';
        }
        
        $this->msgPut($flag, $msg, null);
    }
	
	
}
new Patientmanagers();