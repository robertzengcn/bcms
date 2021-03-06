<?php

class MediaReportService extends BaseService {

    /**
     * 构造函数
     */
    public function __construct() {
        $this->dao = new MediaReportDAO();
    }

    /**
     * 批量删除
     *
     * @param array $arr(id,...)
     * @return boolean
     */
    public function deleteBatch($ids) {
        Entity::isIds($ids); // 验证ids是否合法

        $mediaReports = $this->dao->getBatch($ids);
        $recommendListDAO = new RecommendListDAO();
        $files = array();
        foreach ($mediaReports as $mediaReport) {
            $filename = GENERATEPATH . 'mediareport/' . $mediaReport->id . '.html';
            if ($mediaReport->id == 0) {
                throw new ValidatorException(78);
            }
            $files[] = $filename;
            $recommendListDAO->deleteById('media_id', $mediaReport->id);
        }

        foreach ($files as $file) {
            if (file_exists($file)) {
                unlink($file);
            }
        }

        return $this->dao->deleteBeans($mediaReports);
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     * @return Result
     */
    public function query($where) {
        $mediaReports = $this->dao->query($where);
        foreach ($mediaReports as $key => $value) {
            $value->plushtime = date('Y-m-d', $value->plushtime);
        }

        return $this->success($mediaReports);
    }

    /**
     * 获得一条数据
     *
     * @param Entity $mediaReport
     * @return Result
     */
    public function get($mediaReport) {
        $this->dao->get($mediaReport->id, $mediaReport);
        if ($mediaReport->pic) {
            $mediaReport->src = UPLOAD . $mediaReport->pic;
        }

        $tagsService = new TagService();
        $mediaReport->tags = $tagsService->getTags($mediaReport->plushtime);

        $recommend = new RecommendListService();
        $result = $recommend->getById('media_id', $mediaReport->id);
        $mediaReport->recommend = $result;
        return $this->success($mediaReport);
    }

    /**
     * 保存数据
     *
     * @param Entity $mediaReport
     * @return Result
     */
    public function save($mediaReport) {
        $mediaReport->plushtime = time();
        $mediaReport->updatetime = time();
        $mediaReport->validate(); // 数据验证
        $mediaReport->click_count = rand(30, 1000);
        $tagsService = new TagService();
        $tagsService->tagsSave($mediaReport->plushtime);
        // 获取class对象并插入数据
        $this->dao->save($mediaReport);
        
        $is_tomobile = isset($_REQUEST['is_tomobile']) ? $_REQUEST['is_tomobile'] : '1';
        if (! empty($_REQUEST['recommendposition'])) {
            $recommendList = new RecommendListService();
            foreach ($_REQUEST['recommendposition'] as $value) {
                $recommend = new RecommendList();
                $recommend->recommendposition_id = $value;
                $recommend->media_id = $mediaReport->id;
                $recommend->is_tomobile = $is_tomobile;
                $recommendList->save($recommend);
            }
        }
        
        return $this->success();
    }

    /**
     * 更改数据
     *
     * @param Entity $mediaReport
     * @return Result
     */
    public function update($mediaReport) {
        $mediaReport->updatetime = time();
        $mediaReport->validate();

        $tagsService = new TagService();
        $tagsService->tagsClear($mediaReport->plushtime);
        $tagsService->tagsSave($mediaReport->plushtime);
        
        $is_tomobile = isset($_REQUEST['is_tomobile']) ? $_REQUEST['is_tomobile'] : '1';
        if (! empty($_REQUEST['recommendposition'])) {
            $recommendList = new RecommendListService();
            $recommendList->deleteById('media_id', $mediaReport->id);
            foreach ($_REQUEST['recommendposition'] as $value) {
                $recommend = new RecommendList();
                $recommend->recommendposition_id = $value;
                $recommend->media_id = $mediaReport->id;
                $recommend->is_tomobile = $is_tomobile;
                $recommendList->save($recommend);
            }
        }
        return $this->dao->update($mediaReport);
    }
}
