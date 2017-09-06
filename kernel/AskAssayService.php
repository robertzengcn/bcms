<?php

/**
 * 在线问答模块(化验单)service服务层
 * @author Administrator
 *
 */
class AskAssayService extends BaseService {

    /**
     * 构造方法
     * 实例化基类并实例化dao数据表处理层,并将其赋值给dao属性
     */
    public function __construct() {
        parent::__construct();
        $this->dao = new AskAssayDAO();
    }

    /**
     * 在线问答（详情）添加方法
     * 在线问答详情数据添加方法，本方法由ask服务层调用;
     *
     * @param
     *            object askdesc数据实体对象
     */
    public function save($askAssay) {
        // 数据格式化,目的将对应的数据转换成字符串保存到数据库
        $this->dataFormat($askAssay);
        // 数据实体对象数据验证
        $askAssay->validate();
        // 在线提问详情数据入库
        $this->dao->save($askAssay);
        // 回执
        return $this->success();
    }

    /**
     *
     *
     * 将前端提交数据格式化成数据库接受的集合
     *
     * @param object $askAssay
     *            数据实体对象
     */
    private function dataFormat($askAssay) {
        $items = array(); // 初始化项目集合
        $consults = array(); // 初始化参考值集合
        $units = array(); // 初始化单位集合
        $finallys = array(); // 初始化结果集合
                             // 外层检验项目检查
        if (isset($askAssay->item) && count($askAssay->item) >= 1) {
            foreach ($askAssay as $key => $value) {
                if (is_array($askAssay->$key)) {
                    foreach ($askAssay->$key as $k => $v) {
                        $v = '{' . $v . '}';
                        switch (strtolower($key)) {
                            case 'item':
                                $items[] = $v;
                                break;
                            case 'consult':
                                $consults[] = $v;
                                break;
                            case 'unit':
                                $units[] = $v;
                                break;
                            case 'finally':
                                $finallys[] = $v;
                                break;
                        }
                    }
                }
            }
        }
        // 数据组合排列
        $askAssay->item = implode('', $items);
        $askAssay->consult = implode('', $consults);
        $askAssay->unit = implode('', $units);
        $askAssay->finally = implode('', $finallys);
    }

    /**
     *
     *
     * 获取单条数据
     *
     * @param object $askAssay
     * @return object 数据对象
     */
    public function get($askAssay) {
        $this->dao->get($askAssay->askID, $askAssay);
        return $askAssay;
    }
}