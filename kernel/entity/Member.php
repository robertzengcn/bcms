<?php
require_once ENTITYPATH . '/Entity.php';

class Member extends Entity {

	var $id;
	
	var $username;
	
	var $telephone;
	
	var $ownscore;
	
	var $user_alis;
	





	public function validate() {
// 		if (strlen($this->name) == 0) {
// 			throw new ValidatorException(6);
// 		}
		
// 		if (strlen($this->descript) == 0) {
// 			throw new ValidatorException(176);
// 		}
		
// 		if(strlen($this->score)==0){
// 			throw new ValidatorException(177);
// 		}
		
// 		if(strlen($this->limit)==0){
// 			throw new ValidatorException(178);
// 		}
		
// 		if(strlen($this->type)==0){
// 			throw new ValidatorException(160);
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