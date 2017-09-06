<?php
require_once ENTITYPATH . '/Entity.php';

class ShowScene extends Entity {

	  var $id;
	  
	  var $scenecode_varchar;
	  
	  var $scenename_varchar;
	  
	  var $scenetype_int;
	  
	  var $userid_int;
	  
	  var $hitcount_int;
	  
	  var $createtime_time;
	  
	  var $musicurl_varchar;
	  
	  var $videocode_varchar;
	  
	  var $showstatus_int;
	  
	  var $thumbnail_varchar;
	  
	  var $movietype_int;
	  
	  var $desc_varchar;
	  
	  var $ip_varchar;
	  
	  var $delete_int;
	  
	  var $tagid_int;
	  
	  var $sourceId_int;
	  
	  var $biztype_int;
	  
	  var $eqid_int;
	  
	  var $eqcode;
	  
	  var $datacount_int;
	  
	  var $musictype_int;
	  
	  var $usecount_int;
	  
	  var $fromsceneid_bigint;
	  
	  var $publish_time;
	  
	  var $update_time;
	  
	  var $rank;
	  
	  var $shenhe;
	  
	  var $isadvanceduser;
	  
	  var $hideeqad;
	  
	  var $lastpageid;
	  
	  var $is_tpl;
	  
	  var $is_public;

    public function validate() {
        if ($this->hitcount_int =='') {
            $this->hitcount_int = 0;
        }
        if ($this->showstatus_int=='') {
            $this->showstatus_int = 1;
        }
        if ($this->movietype_int =='') {
            $this->movietype_int = 0;
        }
        if ($this->delete_int=='') {
            $this->delete_int = 0;
        }
        if ($this->tagid_int=='') {
            $this->tagid_int = 0;
        }
        if ($this->sourceId_int=='') {
            $this->sourceId_int = 0;
        }
        if ($this->biztype_int=='') {
            $this->biztype_int = 1;
        }
        if ($this->datacount_int=='') {
            $this->datacount_int = 1;
        }
        if ($this->musictype_int=='') {
            $this->musictype_int = 3;
        }
        if ($this->usecount_int=='') {
            $this->usecount_int = 0;
        }
        if ($this->fromsceneid_bigint=='') {
            $this->fromsceneid_bigint = 0;
        }
        if ($this->publish_time=='') {
            $this->publish_time = 0;
        }
        if ($this->update_time=='') {
            $this->update_time = 0;
        }
        if ($this->rank=='') {
            $this->rank = 0;
        }
        if ($this->shenhe=='') {
            $this->shenhe = 1;
        }
        if ($this->isadvanceduser=='') {
            $this->isadvanceduser = 0;
        }
        if ($this->hideeqad=='') {
            $this->hideeqad = 0;
        }
        if ($this->is_tpl=='') {
            $this->is_tpl = 0;
        }
        if ($this->is_public=='') {
            $this->is_public = 1;
        }		
    }
}
