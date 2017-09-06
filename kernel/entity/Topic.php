<?php
require_once ENTITYPATH . '/Entity.php';

class Topic extends Entity {

    var $id;

    var $subject;

    var $pic;

    var $link;

    var $url;

    var $content;

    var $title;

    var $keywords;

    var $description;

    var $plushtime;

    var $is_tpl;

    var $effect;

    var $topiclistid;

    var $disease_id;

    var $tpl;
    

    
    /**
     * 显示位置：1(pc), 2(手机网页), 3(app), 4(微站)
     *
     * 格式：1,2,3,4
     * 注：等于1，则只在pc端口显示
     *    等于0，所有显示位均可显示，默认
     * */
    var $show_position;



    public function validate() {
        if (strlen($this->subject) == 0) {
            throw new ValidatorException(79);
        }

        if (strlen($this->link) == 0) {
            throw new ValidatorException(88);
        }
        
        if ($this->show_position == '' || strlen($this->show_position) == 0) {
            $this->show_position = '0';
        }

        /*
         * if (! $this->isUrl ( $this->url )) { throw new ValidatorException ( 120 ); }
         */
    }
}