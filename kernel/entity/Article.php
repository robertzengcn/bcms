<?php
require_once ENTITYPATH . '/Entity.php';

class Article extends Entity {

    var $id;

    var $subject;

    var $pic;

    var $source;

    var $content;

    var $click_count;

    var $title;

    var $keywords;

    var $description;

    var $plushtime;

    var $updatetime;

    var $isbidding;

    var $department_id;

    var $disease_id;

    var $doctor_id;

    var $is_top;

    var $worker_id;

    var $relation;
    
    /**
     * 显示位置：1(pc), 2(手机网页), 3(app), 4(微站)
     * 
     * 格式：1,2,3,4
     * 注：等于1，则只在pc端口显示
     *    等于0，所有显示位均可显示，默认
     * */
    var $show_position;

    public function validate() {
        if ($this->subject == '' || strlen($this->subject) == 0) {
            throw new ValidatorException(6);
        }
        if ($this->content == '' || strlen($this->content) == 0) {
            throw new ValidatorException(5);
        }
        if (! $this->isNum($this->isbidding) || strlen($this->isbidding) == 0) {
            throw new ValidatorException(8);
        }
        if (! $this->isNum($this->department_id) || strlen($this->department_id) == 0) {
            throw new ValidatorException(72);
        }
        if (! $this->isNum($this->disease_id) || strlen($this->disease_id) == 0) {
            throw new ValidatorException(59);
        }
        if ($this->plushtime == '' || strlen($this->plushtime) == 0) {
            $this->plushtime = time();
        }
        if ($this->updatetime == '' || strlen($this->updatetime) == 0) {
            $this->updatetime = time();
        }
        
        if ($this->show_position == '' || strlen($this->show_position) == 0) {
            $this->show_position = '0';
        }
    }
}
