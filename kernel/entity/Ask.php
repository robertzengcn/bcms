<?php

/**
 * ask数据实体类
 * @author Administrator
 */
require_once ENTITYPATH . '/Entity.php'; // 引入数据实体基类
class Ask extends Entity {

    public $id; // 主键id
    public $plushtime; // 提问时间
    public $name; // 姓名
    public $subject; // 标题
    public $status; // 状态，1正常，0已删除
    public $answertime; // 回答时间
    public $ip; // 提问者ip(可用于提问者来源获取)
    public $isanswer; // 是否回答,0为未回答,1为已回答
    public $user_id; // 发布者id(指前台用户)
    public $department_id; // 科室id
    public $disease_id; // 疾病id
    public $userID; // 发布者id(指前台用户)
    public $departmentID; // 科室id
    public $diseaseID; // 疾病id
    public $department; // 接受总控传入的科室id(后续使用)
	public $departname; // 接受总控传入的科室中文名称(后续使用)
	public $isdisplay; //是否显示（手机端后续使用）
	public $user_alis;//总控的用户别名
	
	/**
	 * 显示位置：1(pc), 2(手机网页), 3(app), 4(微站)
	 *
	 * 格式：1,2,3,4
	 * 注：等于1，则只在pc端口显示
	 *    等于0，所有显示位均可显示，默认
	 * */
	public $show_position;
	
    /**
     * 数据验证debug
     *
     * @see kernel/entity/Entity::validate()
     */
    public function validate() {
        if ($this->name == '' || ! isset($this->name)) {
            throw new ValidatorException(19);
        }
        if ($this->subject == '' || ! isset($this->subject)) {
            throw new ValidatorException(6);
        }
        if ($this->plushtime == '' || strlen($this->plushtime) == 0) {
            $this->plushtime = time();
        }
        
        if ($this->show_position == '' || strlen($this->show_position) == 0) {
            $this->show_position = '0';
        }
    }
}