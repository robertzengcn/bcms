<?php

/**
 * 联系方式DAO
 *
 * @author Administrator
 *
 */
class ContactDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_CONTACT;
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     *            return object $arr
     */
    public function query($where) {
        DTExpression::like('name', $where);
        DTExpression::eq('is_retain', $where);
         
        return $this->getByComposite(ORMMap::$classes[$this->tableName], DTExpression::$sql . DTOrder::$sql . DTExpression::$limit);
    }

    /**
     * 批量删除
     *
     * @param unknown $ids
     */
    public function deleteBatch($ids) {
        $contacts = $this->getBatch($ids);
        foreach ($contacts as $key) {
            if ($key->id == 0) {
                return new Result(false, 78, ErrorMsgs::get(78), NULL);
            }
            if ($key->is_retain == 1) {
                return new Result(false, 18, ErrorMsgs::get(18), NULL);
            }
        }
        R::trashAll($contacts);

        return new Result(true, 0, '', NULL);
    }

    public function getContact($flag) {
    	$array=array('flag'=>$flag);
        $result = R::findOne($this->tableName, "flag=:flag",$array);
        $contacts = new Contact();
        $contacts->generateFromRedBean($result);

        return $contacts;
    }
    
    /**
     * 更新微博app key
     * 
     * */
    public function updateweiappkey($arr){
    	return R::exec("update ".$this->tableName." set val=:val where flag='weibo_appkey'",$arr);
    }
    
    /**
     * 更新微博app secret
     * */    
    public function updateweiappsecret($arr){
    	return R::exec("update ".$this->tableName." set val=:val where flag='weibo_appsecret'",$arr);
    }
    
    /**
     *获取app key 
     * */
    public function getappkey(){
       $result=R::findOne($this->tableName,"flag='weibo_appkey'");
       $contacts = new Contact();
       $contacts->generateFromRedBean($result);       
       return $contacts;
    }
    
    /**
     *更新app code
     * */
    public function updateweibocode($arr){
    	return R::exec("update ".$this->tableName." set val=:val where flag='weibo_code'",$arr);
    }
    
    /**
     * 获取app secret
     * */
    public function getappsecret(){
    	$result=R::findOne($this->tableName,"flag='weibo_appsecret'");
    	$contacts = new Contact();
    	$contacts->generateFromRedBean($result);
    	return $contacts;
    }
    
    /**
     * 获取app code
     * */
    public function getappcode(){
    	$result=R::findOne($this->tableName,"flag='weibo_code'");
    	$contacts = new Contact();
    	$contacts->generateFromRedBean($result);
    	return $contacts;
    }
    
    /**
     * 更新短信接口url
     * */
    public function updatemsg_url($arr){
    	return R::exec("update ".$this->tableName." set val=:val where flag='msg_url'",$arr);
    }
    
    /**
     * 更新短信接口cid
    * */
    public function updatemsg_cid($arr){
    	return R::exec("update ".$this->tableName." set val=:val where flag='msg_cid'",$arr);
    }
    
    /**
     * 更新短信接口cid
    * */
    public function updatemsg_pwd($arr){
    	return R::exec("update ".$this->tableName." set val=:val where flag='msg_pwd'",$arr);
    }
    
    /**
     * 更新短信接口cell
    * */
    public function updatemsg_cell($arr){
    	return R::exec("update ".$this->tableName." set val=:val where flag='msg_cell'",$arr);
    }
    
    /**
     * 获取短信接口url
     * */
    public function getmsgurl(){
    	$result=R::findOne($this->tableName,"flag='msg_url'");
    	$contacts = new Contact();
    	$contacts->generateFromRedBean($result);
    	return $contacts;
    }
    
    /**
     * 获取短信接口cid
    * */
    public function getmsgcid(){
    	$result=R::findOne($this->tableName,"flag='msg_cid'");
    	$contacts = new Contact();
    	$contacts->generateFromRedBean($result);
    	return $contacts;
    }
    
    /**
     * 获取短信接口pwd
    * */
    public function getmsgpwd(){
    	$result=R::findOne($this->tableName,"flag='msg_pwd'");
    	$contacts = new Contact();
    	$contacts->generateFromRedBean($result);
    	return $contacts;
    }
    
    /**
     * 获取短信接口cell
    * */
    public function getmsgcell(){
    	$result=R::findOne($this->tableName,"flag='msg_cell'");
    	$contacts = new Contact();
    	$contacts->generateFromRedBean($result);
    	return $contacts;
    }
    
    /**
     * 获取邮件接口smtpusername
     * */
    public function getsmtpusername(){
    	$result=R::findOne($this->tableName,"flag='smtpusername'");
    	$contacts = new Contact();
    	$contacts->generateFromRedBean($result);
    	return $contacts;
    }
    
    /**
     * 获取邮件接口smtppass
     * */
    public function getsmtppass(){
    	$result=R::findOne($this->tableName,"flag='smtppass'");
    	$contacts = new Contact();
    	$contacts->generateFromRedBean($result);
    	return $contacts;
    }
    
    
    /**
     * 获取邮件接口smtpport
     * */
    public function getsmtpport(){
    	$result=R::findOne($this->tableName,"flag='smtpport'");
    	$contacts = new Contact();
    	$contacts->generateFromRedBean($result);
    	return $contacts;
    }
    
    /**
     * 获取邮件接口smtphost
     * */
    public function getsmtphost(){
    	$result=R::findOne($this->tableName,"flag='smtphost'");
    	$contacts = new Contact();
    	$contacts->generateFromRedBean($result);
    	return $contacts;
    }
    
    
    /**
     *更新udesk url
     * */
    public function updateudesk($arr){
    	return R::exec("update ".$this->tableName." set val=:val where flag='udesk'",$arr);
    }
    
    /**
     * 获取无线未来短信接口ip
     * */
    public function getwuxianip(){
    	$result=R::findOne($this->tableName,"flag='wuxian_ip'");
    	$contacts = new Contact();
    	$contacts->generateFromRedBean($result);
    	return $contacts;
    } 
    
    /**
     * 获取无线未来短信接口ip
    * */
    public function getwuxianaccount(){
    	$result=R::findOne($this->tableName,"flag='wuxian_account'");
    	$contacts = new Contact();
    	$contacts->generateFromRedBean($result);
    	return $contacts;
    }
    
    /**
     * 获取无线未来短信接口密码
    * */
    public function getwuxianpassword(){
    	$result=R::findOne($this->tableName,"flag='wuxian_password'");
    	$contacts = new Contact();
    	$contacts->generateFromRedBean($result);
    	return $contacts;
    }
    
    /**
     * 更新短信接口url
    * */
    public function updatewuxian_url($arr){
    	return R::exec("update ".$this->tableName." set val=:val where flag='wuxian_ip'",$arr);
    }
    /**
     * 更新短信接口账号
    * */
    public function updatewuxian_account($arr){
    	return R::exec("update ".$this->tableName." set val=:val where flag='wuxian_account'",$arr);
    }
    /**
     * 更新短信接口密码
    * */
    public function updatewuxian_pass($arr){
    	return R::exec("update ".$this->tableName." set val=:val where flag='wuxian_password'",$arr);
    }
    

    
}
