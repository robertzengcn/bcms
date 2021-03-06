<?php

abstract class Entity {

    /**
     * get ID
     *
     * @return number
     */
    public function getID() {
        return intval($this->id);
    }

    /**
     * set ID
     *
     * @param unknown $id
     */
    public function setID($id) {
        $this->id = $id;
    }

    /**
     * class 转 bean
     *
     * @param unknown $entity
     */
    public function generateRedBean($entity) {
        foreach ($this as $key => $value) {
            if ($key == 'id' && isset($entity->id)) {
                $this->id = $entity->id;
                continue;
            }

            $entity->$key = $value;
        }
    }

    /**
     * bean 转 class
     *
     * @param unknown $rbEntity
     */
    public function generateFromRedBean($rbEntity) {
    	
        if (is_object($rbEntity)) {
            foreach ($rbEntity as $key => $value) {
                $this->$key = str_replace('\\', '', $value);
            }
        }
    }

    /**
     * json
     *
     * @return string
     */
    public function toJSON() {
        return json_encode($this);
    }

    abstract function validate();

    /**
     * 验证是否是邮箱
     */
    public function isEmail($email) {
        $pattern = '/^[_\.0-9a-zA-Z-]+@([0-9a-z][0-9a-zA-Z]+)\.[a-zA-Z]{2,3}$/';
        return preg_match($pattern, $email);
    }

    /**
     * 验证是否是数字
     */
    public function isNum($num) {
        $pattern = '/^[0-9]+$/';
        return preg_match($pattern, $num);
    }

    /**
     * 验证是不是URL地址
     */
    public function isUrl($url) {
        $pattern = '/^((http|https):\/\/)?' . '(([0-9]{1,3}\.){3}[0-9]{1,3}' .         // IP形式的URL
        '|' .         // 允许IP和DOMAIN（域名）
        '([0-9a-z_!~*\'()-]+\.)*' .         // 三级域验证
        '([0-9a-z][0-9a-z-]{0,61})?([0-9a-z]\.)*' .         // 二级域验证
        '[a-z]{2,10})' .         // 顶级域验证
        '(:[0-9]{1,4})?' . '((\/\?)|' . '(\/[0-9a-zA-Z_!~\*\'\(\)\.;\?:@&=\+\$,%#-\/]*)?)$/';
        return preg_match($pattern, trim($url));
    }

    /**
     * 验证是不是手机号
     */
    public function isMobile($mobile) {
        $pattern = '/^(134|135|136|137|138|139|150|151|152|157|158|159|187|188|130|131|132|155|156|185|186|133|153|180|189)[0-9]{8}$/';
        return preg_match($pattern, $mobile);
    }

    public static function isIds($ids) {
        if (is_array($ids)) {

            foreach ($ids as $id) {
                if (strlen($id) == 0) {
                    throw new ValidatorException(7);
                }

                if (! preg_match('/^[1-9][0-9]*$/', $id)) {
                	
                    throw new ValidatorException(131);
                }
            }
        } else {
            throw new ValidatorException(130);
        }
    }

    public function isSetHttp($url) {
        $pattern = '/^(http|https):\/\//'; // 正则，匹配以http://开头的字符串
        return preg_match($pattern, trim($url));
    }
    

}
