<?php
require_once ENTITYPATH . '/Entity.php';
class MediaId extends Entity{
	var $id;
	var $type;
	var $title;
	var $digest;
	var $filename;
	var $media_id;
	var $thumb_media_id;
	var $video_media_id;
	var $created_at;
	var $tag;
	var $flag;
	
	public function validate(){
		if (strlen($this->type) == 0){
			throw new Exception('请选择类型');
		}
		if (strlen($this->created_at) == 0){
			throw new Exception('添加时间不能为空');
		}else{
			$re = $this->isNum($this->created_at);
			if(!$re){
				throw new Exception('添加时间格式错误');
			}
		}
	}
}