<?php

class  HomeService extends BaseService{
    function __construct(){
            $this->dao = new HomeDAO();
    }

    /**
     * @param $tableNames
     * @return array
     *
     */

    public function getHealths($tableNames){
        return $this->dao->getHealths($tableNames);
    }

    /**
     * @param $flag
     * @return array
     *
     */

    public function getLogo($flag){
        return $this->dao->getLogo('picmanager',$flag);
    }

    /**
     * @param $flag
     * @return array
     */
    public function getSWT($flag){
        return $this->dao->getSWT('contact',$flag);
    }

    /**
     * 判断联系方式是否填写
     */

    public function getContent($content){
       return  $this->dao->getContent($content);
    }

    /**
     * @param $seo
     * @return array
     * 判断seo是否填写
     */
    public function getSeo($seo){
        return  $this->dao->getSeo($seo);
    }

    /**
     * @param $flag
     * @return array
     * 判断医院简介是否填写
     */
    public function getIntroduce($flag){
        return $this->dao->getIntroduce($flag);
    }

}