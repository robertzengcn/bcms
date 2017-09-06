<?php
require_once ENTITYPATH . '/Entity.php';

class CommodityLog extends Entity {

	var $id;

	var $uid;

	var $totalscore;

	var $totalcash;

	var $gid;

	var $buytime;

 	var $orders;

	var $status;

	var $taketime;
	
	var $num;
	
	var $qrcode;
	
 	public function validate() {
		if (strlen($this->uid) == ''|| strlen($this->uid) == 0) {
			throw new ValidatorException(6);
		}
		if (strlen($this->totalscore) == ''|| strlen($this->totalscore) == 0) {
			throw new ValidatorException(5);
		}		
		if (strlen($this->gid) == ''|| strlen($this->gid) == 0) {
			throw new ValidatorException(172);
		}
		if (strlen($this->order) == ''|| strlen($this->order) == 0) {
			throw new ValidatorException(172);
		}
		if (strlen($this->qrcode) == ''|| strlen($this->qrcode) == 0) {
			throw new ValidatorException(8);
		}
	}
}