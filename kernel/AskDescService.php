<?php

/**
 * 在线问答模块(详情)service服务层
 * @author Administrator
 *
 */
class AskDescService extends BaseService {

    /**
     * 构造方法
     * 实例化基类并实例化dao数据表处理层,并将其赋值给dao属性
     */
    public function __construct() {
        parent::__construct();
        $this->dao = new AskDescDAO();
    }

    /**
     * 在线问答（详情）添加方法
     * 在线问答详情数据添加方法，本方法由ask服务层调用;
     *
     * @param
     *            object askdesc数据实体对象
     */
    public function save($askDesc) {
        // 数据补充
        $this->dataSupply($askDesc);
        // 数据实体对象数据验证
        $askDesc->validate();
        // 在线提问详情数据入库
        $this->dao->save($askDesc);
        // 回执
        return $this->success();
    }

    /**
     *
     *
     * 获取单条数据
     *
     * @param object $askDesc
     */
    public function get($askDesc) {
        $this->dao->get($askDesc->askID, $askDesc);
        return $askDesc;
    }

    /**
     * 在线问题添加方法(desc数据补充)
     *
     * @param object $askAssay
     *            数据实体对象
     */
    private function dataSupply($askDesc) {
        $askDesc->clickCount = mt_rand(10, 100); // 补充页面点击量
        $askDesc->city = '福州'; // 提问者所在城市,通过提交ip获取
        $askDesc->pic2 = ''; // 化验单图/其他图2
        $askDesc->pic3 = ''; // 化验单图/其他图3
        //$askDesc->doctor = ''; // 患者想咨询的医师
    }
    
    public function getaskbyid($id){
    	$askDesc=new AskDesc();
    	$askDesc->askID=$id;
    	$this->dao->get($askDesc->askID, $askDesc);
    	return $askDesc;
    	
    }
}