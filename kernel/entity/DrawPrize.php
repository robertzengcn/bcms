<?php
require_once ENTITYPATH . '/Entity.php';

class DrawPrize extends Entity {

	var $id;
	
	var $name;
	
	var $prize_count;
	
	var $prize_every;
	
	var $prize_percent;
	
	var $prize_position;
	
	var $drawid;
	
	var $img;
	
	var $takeway;
	
	var $type;
	





	public function validate() {
		if (strlen($this->name) == 0) {
			throw new ValidatorException(6);
		}
		
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