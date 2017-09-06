<?php

class IntroduceService extends BaseService {

    /**
     * 构造函数
     */
    public function __construct() {
        $this->dao = new IntroduceDAO();
    }

    /**
     * 获得1条数据
     *
     * @return Result
     */
    public function get() {
        $result = $this->dao->get();
        if ($result->pic != '') {
            $result->src = UPLOAD . $result->pic;
        }

        return $this->success($result);
    }

    /**
     * 更改数据
     *
     * @param Entity $introduce
     * @return Result
     */
    public function update($introduce) {
        $introduce->validate();
        if (! $introduce->id) {
            throw new ValidatorException(7);
        }
        return $this->dao->update($introduce);
    }
}
