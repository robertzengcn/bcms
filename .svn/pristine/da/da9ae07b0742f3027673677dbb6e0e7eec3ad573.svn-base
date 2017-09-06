<?php
require_once ENTITYPATH . '/Entity.php';

class ShowShare extends Entity {

	  var $id;
	  
	  var $scene_id;
	  
	  var $timeline;
	  
	  var $appmessage;
	  
	  var $qq;

	  var $weibo;

	  var $qzone;

	  var $other;
	  
    public function validate() {
		if($this->timeline ==''){
			$this->timeline = 0;
		}
		if($this->appmessage ==''){
			$this->appmessage = 0;
		}
		if($this->qq ==''){
			$this->qq = 0;
		}
		if($this->weibo ==''){
			$this->weibo = 0;
		}
		if($this->qzone ==''){
			$this->qzone = 0;
		}
		if($this->other ==''){
			$this->other = 0;
		}
    }
}
