<?php
/**
 * 患者管理-患者诊疗详情
 * */
require_once ENTITYPATH . '/Entity.php';
class PatientDiagnosisDetail extends Entity{
    /**
     * @param $id
     * 主键id
     * */
	var $id;
	
	/**
	 * @param $type
	 * 诊疗类型 1初诊 2复诊
	 * */
	var $type;
	
	/**
	 * @param $case_id
	 * 事件id
	 * */
	var $case_id;
	
	/**
	 * @param $case_number
	 * 病历号
	 * */
	var $case_number;
	
	/**
	 * @param $pid
	 * 上级诊断id
	 * */
	var $pid;
	
	/**
	 * @param $pic
	 * 检查报告单
	 * */
	var $pic;
	
	/**
	 * @param $check
	 * 检验化验
	 * */
	var $check;
	
	/**
	 * @param $doctor_id
	 * 主治医生
	 * */
	var $doctor_id;
	
	/**
	 * @param $examine_items
	 * 诊疗项目
	 * */
	var $examine_items;
	
	/**
	 * @param $therapeutic
	 * 诊疗方案
	 * */
	var $therapeutic;
	
	/**
	 * @param $advice
	 * 医嘱
	 * */
	var $advice;
	
	/**
	 * @param $department
	 * 承接科室
	 * */
	var $department;
	
	/**
	 * @param $disease_type
	 * 病症分类
	 * */
	var $disease_type;
	
	/**
	 * @param $advise
	 * 患者建议
	 * */
	var $advise;
	
	/**
	 * @param $untoward_effect
	 * 不良反应
	 * */
	var $untoward_effect;
	
	/**
	 * @param $remark
	 * 备注
	 * */
	var $remark;
	
	/**
	 * @param $visit_time
	 * 就诊时间
	 * */
	var $visit_time;
	
	/**
	 * @param $visit_time_field
	 * 就诊时间段：1上午 2下午  3晚上
	 * */
	var $visit_time_field;
	
	/**
	 * @param $return_time
	 * 约定复诊时间
	 * */
	var $return_time;
	
	/**
	 * @param $return_time_field
	 * 约定复诊时间段：1上午 2下午  3晚上
	 * */
	var $return_time_field;
	
	/**
	 * @param $return_items
	 * 复诊项目
	 * */
	var $return_items;
	
	/**
	 * @param $receptionist_id
	 * 前台接待员id
	 * */
	var $receptionist_id;
	
	/**
	 * @param $reception_records
	 * */
	var $reception_records;
	
	/**
	 * @param $receptionist_records
	 * 前台接待备注
	 * */
	var $receptionist_records;
	
	public function validate(){
		if (!$this->visit_time) {
		    throw new Exception('请选择就诊时间');
		}
		if (!$this->receptionist_id) {
			throw new Exception('请选择前台接待人员');
		}
	} 
}