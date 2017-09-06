<?php

class NetworkPicService extends BaseService {

    /**
     * 构造函数
     */
    public function __construct() {
        $this->dao = new NetworkPicDAO();
    }

    /**
     * 添加数据
     *
     * @param string $path;
     */
    public function add($path) {
        $netWorkPic = new NetworkPic();

        $netWorkPic->pic = $path;
        $netWorkPic->updatetime = time();

        $netWorkPic->validate(); // 数据验证

        $id = $this->dao->save($netWorkPic);

        return $this->success($id);
    }

    /**
     * 获得图片
     *
     * @param array $where
     *            查询条件
     */
    public function query($where) {
        $netWorkPics = $this->dao->query($where);

        foreach ($netWorkPics as $key => $value) {
            $value->src = UPLOAD . $value->pic;
        }

        return $this->success($netWorkPics);
    }

    /**
     * 获得数目
     *
     * @param array $where
     *            查询条件
     */
    public function totalRows($where) {
        $totalRows = $this->dao->totalRows($where);

        return $this->success($totalRows);
    }

    /**
     * 删除图片
     */
    public function del() {
        $ids = array(
            $_REQUEST['id']
        );
        $networkPic = $this->dao->getBatch($ids);
        $filename = '';
        foreach ($networkPic as $value) {
            $filename = ABSPATH . '/upload/' . $value->pic;
        }
        $this->dao->deleteBeans($networkPic);
        if (file_exists($filename)) {
            unlink($filename);
        }

        return $this->success();
    }
}
