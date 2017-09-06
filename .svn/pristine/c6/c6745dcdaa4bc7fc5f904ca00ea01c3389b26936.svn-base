<?php
require_once ENTITYPATH . '/Entity.php';

class ShowScenePage extends Entity {

    var $id;

    var $sceneid_bigint;

    var $scenecode_varchar;

    var $pagecurrentnum_int;

    var $createtime_time;

    var $content_text;

    var $pagename_varchar;
	
    var $userid_int;

    var $properties_text;

    var $mytypl_id;

    public function validate() {
        if ($this->pagecurrentnum_int =='') {
            $this->pagecurrentnum_int = 1;
        }
        if ($this->mytypl_id =='') {
            $this->mytypl_id = 0;
        }		
    }
}
