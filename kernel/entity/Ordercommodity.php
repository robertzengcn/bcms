<?php
require_once ENTITYPATH . '/Entity.php';

class Ordercommodity extends Entity {

	var $id;
	
	var $order_id;

	var $member_id;

	var $commodity_id;

	var $commodity_name;
	
	var $final_price;
	
	var $commodity_price;
	
	var $commodity_quantity;
	
	var $final_score;
	
	var $commodity_score;
	

	




	public function validate() {
// 		if (strlen($this->subject) == 0) {
// 			throw new ValidatorException(6);
// 		}
		
// 		if (strlen($this->quantity) == 0) {
// 			throw new ValidatorException(172);
// 		}

/* 		if (strlen($this->content) == 0) {
			throw new ValidatorException(5);
		}

 		if (strlen($this->isbidding) == 0) {
			throw new ValidatorException(8);
		} 
 		if ($this->plushtime == '' || strlen($this->plushtime) == 0) {
			$this->plushtime = time();
		}
		if ($this->updatetime == '' || strlen($this->updatetime) == 0) {
			$this->updatetime = time();
		}  */
	}
}