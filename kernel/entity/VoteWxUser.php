<?php
require_once ENTITYPATH . '/Entity.php';

class VoteWxUser extends Entity {

  var $id;
  
  var $nickname;
  
  var $sex;
  
  var $city;
  
  var $province;
  
  var $country;
  
  var $headimgurl;
  
  var $openid;
  
  var $subscribe;
  
  var $subscribe_time;
  
    public function validate() {
    }
}
