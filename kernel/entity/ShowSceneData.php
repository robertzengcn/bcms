<?php
require_once ENTITYPATH . '/Entity.php';

class ShowSceneData extends Entity {

    var $id;

    var $sceneid_bigint;

    var $pageid_bigint;

    var $elementid_int;

    var $elementtitle_varchar;

    var $elementtype_int;

    var $userid_int;
	
    public function validate() {
    }
}
