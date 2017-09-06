<?php
require_once ENTITYPATH . '/Entity.php';

class CommodityDescript extends Entity {

	var $id;

    var $product_descript;
    
    var $product_id;


	public function validate() {
		if (strlen($this->product_descript) == 0) {
			throw new ValidatorException(173);
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