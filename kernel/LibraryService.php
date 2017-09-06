<?php

class LibraryService extends BaseService {

    /**
     * 构造函数
     */
    public function __construct() {
        $this->dao = new LibraryDAO();
    }

    /**
     * 根据Name获得数据
     *
     * @param array $where
     *            查询条件
     * @return Result
     */
    public function query($where) {
        $librarys = $this->dao->query($where);
        return $this->success($librarys);
    }

    /**
     * 获取一条数据
     *
     * @param Entity $contact
     * @return Result
     */
    public function get($libaray) {
        if (! $libaray->id) {
            throw new ValidatorException(7);
        }
        $this->dao->get($libaray->id, $libaray);

        return $this->success($libaray);
    }


    /**
     * 保存数据
     *
     * @param Entity $contact
     * @return Result
     */
    public function save($libaray) {
        $libaray->validate();
        // 获取class对象并插入数据
        $this->dao->save($libaray);

        return $this->success();
    }

    /**
     * 更改数据
     *
     * @param Entity $contact
     * @return Result
     */
    public function update($libaray) {
        $libaray->validate();
        if (! $libaray->id) {
            throw new ValidatorException(7);
        }
        return $this->dao->update($libaray);
    }

    /**
     * 批量删除
     *
     * @param array $arr(id,...)
     * @return boolean
     */
    public function deleteBatch($ids) {
        return $this->dao->deleteBatch($ids);
    }

    /**
     * 删除数据
     *
     * @param Entity $contact
     * @return Result
     */
    public function delete($library) {
        if (! $library->id) {
            throw new ValidatorException(7);
        }
        $this->dao->get($library->id, $library);
        if ($library->id == 0) {
            throw new ValidatorException(16);
        }
        $this->dao->delete($library->id);
        return $this->success();
    }
    
    /**
     * 
     * 获取当前正在运行的数据库名称
     */
    public function get_data(){
    	return $this->dao->get_data();
    }
    
    /**
     * 
     * 获取当前正在运行的数据表列表
     */
    public function get_table(){
    	return $this->dao->get_table();
    }
    
    public function get_field(){
    	return $this->dao->get_field();
    }
    
    public function replace(){
    	return $this->dao->replace();
    }
    
}
