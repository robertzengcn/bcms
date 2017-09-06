<?php
require_once ENTITYPATH . '/Entity.php';

class ResSchedule extends Entity {

    var $id;
    
    var $date;
    
    var $morning;

    var $afternoon;
    
    var $night;
    
    var $type;
    
    var $doctor_num;
    
    var $tem_id;
    
    var $num;
        

 //   var $doctor_id;

//    var $along;

//     var $morning;

//     var $afternoon;

//     var $night;

//     var $date;

    // 验证字段
    public function validate() {


        
        if (! strlen($this->type)) {
        	throw new ValidatorException(160);
        }
        

        if (! strlen($this->date)) {
            throw new ValidatorException(162);
        }
        
        if(! strlen($this->tem_id)){
        	
        	throw new ValidatorException(163);
        }
        

//         if (! strlen($this->along)) {
//             throw new ValidatorException(133);
//         }

//         if (! strlen($this->date)) {
//             throw new ValidatorException(134);
//         }

//         if ($this->morning) {
//             $arr = explode('-', $this->morning);
//             foreach ($arr as $v) {
//                 if (strlen($v)) {
//                     if (! $this->isHours($v)) {
//                         throw new ValidatorException(132);
//                     }
//                 }
//             }
//         }

//         if ($this->afternoon) {
//             $arr = explode('-', $this->afternoon);
//             foreach ($arr as $v) {
//                 if (strlen($v)) {
//                     if (! $this->isHours($v)) {
//                         throw new ValidatorException(132);
//                     }
//                 }
//             }
//         }

//         if ($this->night) {
//             $arr = explode('-', $this->night);
//             foreach ($arr as $v) {
//                 if (strlen($v)) {
//                     if (! $this->isHours($v)) {
//                         throw new ValidatorException(132);
//                     }
//                 }
//             }
//         }
     }
     
     public function  validate_tem_id(){
     	        if (! strlen($this->type)) {
     	            throw new ValidatorException(160);
     	        }
     	        if(! strlen($this->tem_id)){
     	        	 
     	        	throw new ValidatorException(163);
     	        }
     	        
     	        
     	
     }
     
     public function checktime($time){
     	if($time){
     		            $arr = explode('-', $time);
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
}