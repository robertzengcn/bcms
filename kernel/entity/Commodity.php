<?php
require_once ENTITYPATH . '/Entity.php';

class Commodity extends Entity {

	var $id;

	var $subject;

	var $counts;

	var $exchange;

	var $price;

	var $start_time;

	var $end_time;
	
	var $score;
	
	var $types;
	
	var $discount;
	
	var $quantity;
	
	var $status;
	
	var $limit;
	
	var $pic;
		
	var $get;

	var $categories_id;

	var $description;

	var $piclist;
	
	var $subtitle;
	
	public function validate() {
		if (strlen($this->subject) == 0) {
			throw new ValidatorException(6);
		}
		
		if (strlen($this->quantity) == 0) {
			throw new ValidatorException(172);
		}

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