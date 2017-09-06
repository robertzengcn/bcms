<?php
require_once ENTITYPATH . '/Entity.php';

class ResVationData extends Entity {

  var $id;
  
  /**
   * 上午-已约
   * */
  var $day_1_state_1;
  
  /**
   * 下午-已约
   * */
  var $day_2_state_1;
  
  /**
   * 晚上-已约
   * */
  var $day_3_state_1;
  
  /**
   * 上午-未约
   * */
  var $day_1_state_2;
  
  /**
   * 下午-未约
   * */
  var $day_2_state_2;
  
  /**
   * 晚上-未约
   * */
  var $day_3_state_2;
  
  
  /**
   * 科室统计
   * */
  var $department;

  
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
