<?php
require_once ENTITYPATH . '/Entity.php';

class CommodityKey extends Entity {
	var $id;
	
	var $user_id;
	
 	var $remember_key;
	
	var $lose_time;
	
 	public function validate() {
		if (strlen($this->user_id) == ''|| strlen($this->user_id) == 0) {
			throw new ValidatorException(6);
		}
		if (strlen($this->remember_key) == ''|| strlen($this->remember_key) == 0) {
			throw new ValidatorException(172);
		}
		if (strlen($this->lose_time) == ''|| strlen($this->lose_time) == 0) {
			throw new ValidatorException(5);
		}
	}
}