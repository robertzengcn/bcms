<?php
require_once ENTITYPATH . '/Entity.php';

class ResVation extends Entity {

    var $id;

    var $department_id;

    var $doctor_id;

    var $morning_source;  //早班号源资源
    
    var $afternoon_source; //下午排班资源

    var $night_source; //晚班排班资源
    
    var $morning;
    
    var $state;

    var $afternoon;

    var $night;

    var $date;    
    
    var $time_point;//总可预约时间点
    
    var $morning_point;//早班可预约时间点
    
    var $after_point;//下午可预约时间点
    
    var $night_point;//晚班可预约时间点
   
    var $mark;//已预约人数
    // 验证字段
    public function validate() {
        if (! strlen($this->department_id)) {
            throw new ValidatorException(72);
        }
        
        if (! strlen($this->mark)) {
        	$this->mark=0;
        }

        if (! strlen($this->doctor_id)) {
            throw new ValidatorException(127);
        }

        if (! strlen($this->date)) {
            throw new ValidatorException(134);
        }		
        
        if ($this->morning) {
            $arr = explode('-', $this->morning);
            foreach ($arr as $v) {
                if (strlen($v)) {
                    if (! $this->isHours($v)) {
                        throw new ValidatorException(132);
                    }
                }
            }
        }

        if ($this->afternoon) {
            $arr = explode('-', $this->afternoon);
            foreach ($arr as $v) {
                if (strlen($v)) {
                    if (! $this->isHours($v)) {
                        throw new ValidatorException(132);
                    }
                }
            }
        }

        if ($this->night) {
            $arr = explode('-', $this->night);
            foreach ($arr as $v) {
                if (strlen($v)) {
                    if (! $this->isHours($v)) {
                        throw new ValidatorException(132);
                    }
                }
            }
        }
    }


    public function isHours($hours) {
        $pattern = '/^[0-9]{1,2}\:[0-9]{2}$/';
        return preg_match($pattern, $hours);
    }
    
    /**
     * 校验日期格式是否正确
     *
     * @param string $date 日期
     * @param string $formats 需要检验的格式数组
     * @return boolean
     */
    function checkDateIsValid($date, $formats = array("Y-m-d", "Y/m/d")) {
    	$unixTime = strtotime($date);
    	if (!$unixTime) { //strtotime转换不对，日期格式显然不对。
    		return false;
    	}
    
    	//校验日期的有效性，只要满足其中一个格式就OK
    	foreach ($formats as $format) {
    		if (date($format, $unixTime) == $date) {
    			return true;
    		}
    	}
    
    	return false;
    }
}