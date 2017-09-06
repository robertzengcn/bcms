<?php
/**
 * 
 * 医院联系方式tag标签
 * @author Administrator
 *
 */
class ContactTag extends CommonTag {
	
	/**
	 * 
	 * 构造方法
	 */
    function __construct() {
        $this->service = new ContactService ();
        parent::__construct( get_class() );
    }

    /**
     * 根据flag获取对应数据
     * 并返回val值
     * @param $flag
     * @return mixed
     */
    public function get($flag){
        $value = $this->service->getContact($flag);
        return $value->data->val;
    }

}