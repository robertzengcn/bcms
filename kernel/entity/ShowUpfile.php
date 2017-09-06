<?php
require_once ENTITYPATH . '/Entity.php';

class ShowUpfile extends Entity {

    var $id;

    var $userid_int;

    var $filetype_int;

    var $filesrc_varchar;

    var $create_time;

	var $sizekb_int;
	
    var $filethumbsrc_varchar;

    var $biztype_int;
	
	var $ext_varchar;
	
    var $filename_varchar;

    var $eqsrc_varchar;
	
	var $tagid_int;
	
    var $delete_int;
	
    public function validate() {
        if (!empty($this->tagid_int)) {
            $this->tagid_int = 0;
        }
        if (!empty($this->delete_int)) {
            $this->delete_int = 0;
        }
    }
}
