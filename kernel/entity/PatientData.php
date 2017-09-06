<?php
require_once ENTITYPATH . '/Entity.php';

class PatientData extends Entity {

  var $id;
  
  /**
   * 上午-男
   * */
  var $day_1_sex_1;
  
  /**
   * 下午-男
   * */
  var $day_2_sex_1;
  
  /**
   * 晚上-男
   * */
  var $day_3_sex_1;
  
  /**
   * 上午-女
   * */
  var $day_1_sex_2;
  
  /**
   * 下午-女
   * */
  var $day_2_sex_2;
  
  /**
   * 晚上-女
   * */
  var $day_3_sex_2;
  
  /**
   * 新客户-男
   * */
  var $customer_1_sex_1;
 
  /**
   * 新客户-女
   * */
  var $customer_1_sex_2;
    
  /**
   * 老客户-男
   * */
  var $customer_2_sex_1;
  
  /**
   * 老客户-女
   * */
  var $customer_2_sex_2;
  
  /**
   * 新客户id
   * */
  var $pids_1;
  
  /**
   * 老客户id
   * */
  var $pids_2;
  
  /**
   * 到诊统计
   * */
  var $visit_num;
    
  /**
   * 总人次
   * */
  var $total_num;
  
  /**
   * 总金额
   * */
  var $total_money;
  
  /**
   * 前台接待
   * */
  var $reception;
  
  /**
   * 来源统计
   * */
  var $source;

  /**
   * 科室统计
   * */
  var $department;
  
  /**
   * 诊疗项目统计
   * */
  var $project;
  
  /**
   * 疾病统计
   * */
  var $disease;
  
  /**
   * 医生统计
   * */
  var $doctor;

  /**
   * 年龄统计-男
   * */
  var $age_1;
  
  /**
   * 年龄统计-女
   * */
  var $age_2;
  
  /**
   * 星期
   * */
  var $week;
  
  /**
   * 日期
   * */
  var $daytime;
  
  /**
   * 数据的md5值（统计更新时用）
   * */
  var $data_md5;
   
    public function validate() {
    }
}
