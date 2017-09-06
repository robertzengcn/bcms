<?php
require_once ENTITYPATH . '/Entity.php';

class VoteItem extends Entity {

  var $id;
  var $vid;
  var $item;
  var $dcount;
  var $vcount;
  var $startpicurl1;
  var $startpicurl2;
  var $startpicurl3;
  var $startpicurl4;
  var $startpicurl5;
  var $phone;
  var $rank;
  var $intro;
  var $status;
  var $wechat_id;
  var $addtime;
  var $lockinfo;
  var $ed_dcount;
    public function validate() {
    }
}
