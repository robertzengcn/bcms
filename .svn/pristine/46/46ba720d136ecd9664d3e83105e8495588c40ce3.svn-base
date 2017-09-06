<?php

/**
 * 意见建议模块service服务层
 * @author Administrator
 *
 */
class PhysicalexamService extends BaseService {

    /**
     * 构造方法
     * 实例化基类并实例化dao数据表处理层,并将其赋值给dao属性
     */
    public function __construct() {
        parent::__construct();
        $this->dao = new PhysicalexamDAO();
        $this->limitCount = 50; // 每小时ip设定提交次数
    }
    
    /**
     * 获取意见建议信息
     */
    public function query($param) {
    	$result = $this->dao->query($param);
    	
    	return $this->success($result);
    }
    
    /**
     * 获取条数
     */
    public function totalRows($param) {
    	$result = $this->dao->totalRows($param);
    	
    	return $this->success($result);
    }
    
    /**
     * 获得一条数据
     *
     * @param Entity $feedback
     * @return Result
     */
    public function get($feedback) {
    	if (! $feedback->id) {
    		throw new ValidatorException(7);
    	}
    
    	$this->dao->get($feedback->id, $feedback);
    
    	return $this->success($feedback);
    }
    
    /**
     * 保存数据
     *
     * @param Entity $feedback
     * @return Result
     */
    public function save($feedback) {
    	$feedback->plushtime = time();
    	$feedback->validate();
    	// 获取class对象并插入数据
    	$this->dao->save($feedback);
    
    	return $this->success();
    }
    
    /**
     * 批量删除
     *
     * @param array $arr(id,...)
     * @return boolean
     */
    public function deleteBatch($ids) {
    	Entity::isIds($ids); // 验证ids是否合法
    
    	$devices = $this->dao->getBatch($ids);
    
    	$files = array();
    	foreach ($devices as $device) {
    		$filename = GENERATEPATH . 'device/' . $device->id . '.html';
    		if ($device->id == 0) {
    			throw new ValidatorException(78);
    		}
    		$files[] = $filename;
    	}
    
    	foreach ($files as $file) {
    		if (file_exists($file)) {
    			unlink($file);
    		}
    	}
    
    	return $this->dao->deleteBeans($devices);
    }
    
    /**
     * 更改数据
     *
     * @param Entity $feedback
     * @return Result
     */
    public function update($feedback) {
    	$feedback->validate();
    	if (! $feedback->id) {
    		throw new ValidatorException(7);
    	}
    	return $this->dao->update($feedback);
    }
    
}