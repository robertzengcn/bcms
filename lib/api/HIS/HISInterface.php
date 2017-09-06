<?php
interface HISInterface
{
    /**
     * 基础查询-医院信息查询
     * */
    public function QueryHospital();
    
    /**
     * 基础查询-科室信息查询
     * */
	public function QueryBaseDept($data = array());
	
	/**
	 * 基础查询-医生信息查询
	 * */
	public function QueryBaseDoctor($data = array());
	
	/**
	 * 门诊资源-查询门诊科室
	 * */
	public function QueryClinicDept($data = array());
	
	/**
	 * 门诊资源-查询门诊医生（排班信息）
	 * */
	public function QueryClinicDoctor($data = array());
	
	/**
	 * 门诊资源-查询号源信息
	 * */
	public function QueryNumbers($data = array());
	
	/**
	 * 预约功能-锁号
	 * */
	public function LockOrder($data = array());
	
	/**
	 * 预约功能-释号
	 * */
	public function Unlock($orderId);
	
	/**
	 * 预约功能-挂号
	 * */
	public function BookService($data = array());
	

	/**
	 * 预约功能-退号
	 * */
	public function YYCancel($data = array());
	
	/**
	 * 预约功能-预约信息查询
	 * */
	public function QueryRegInfo($data = array());
	
	//public function bookService();
}