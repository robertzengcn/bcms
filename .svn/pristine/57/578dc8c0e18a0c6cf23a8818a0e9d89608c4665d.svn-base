<?php

class MovieService extends BaseService {

    /**
     * 构造函数
     */
    public function __construct() {
        $this->dao = new MovieDAO();
    }

    /**
     * 批量删除
     *
     * @param array $arr(id,...)
     * @return boolean
     */
    public function deleteBatch($ids) {
        Entity::isIds($ids); // 验证ids是否合法

        $movies = $this->dao->getBatch($ids);

        $files = array();
        foreach ($movies as $movie) {
            $filename = GENERATEPATH . 'movie/' . $movie->id . '.html';
            if ($movie->id == 0) {
                throw new ValidatorException(78);
            }
            $files[] = $filename;
        }

        foreach ($files as $file) {
            if (file_exists($file)) {
                unlink($file);
            }
        }

        return $this->dao->deleteBeans($movies);
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     * @return Result
     */
    public function query($where) {
        $movies = $this->dao->query($where);
        foreach ($movies as $key => $value) {
            $value->plushtime = date('Y-m-d', $value->plushtime);
        }

        return $this->success($movies);
    }

    /**
     * 获得一条数据
     *
     * @param Entity $movie
     * @return Result
     */
    public function get($movie) {
        $this->dao->get($movie->id, $movie);
        if ($movie->pic) {
            $movie->src = UPLOAD . $movie->pic;
        }

        return $this->success($movie);
    }

    /**
     * 保存数据
     *
     * @param Entity $movie
     * @return Result
     */
    public function save($movie) {
        $movie->plushtime = time();
        $movie->updatetime = time();
        $movie->validate();
		$movie->click_count = rand(30,1000);
        // 获取class对象并插入数据
        $this->dao->save($movie);

        return $this->success();
    }

    /**
     * 更改数据
     *
     * @param Entity $movie
     * @return Result
     */
    public function update($movie) {
        $movie->updatetime = time();
        $movie->validate();

        return $this->dao->update($movie);
    }
}
