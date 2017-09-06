<?php

class HomeDAO extends DBBaseDAO{
    function __construct(){
        parent::__construct();
    }

    /**
     * @param $tableNames
     * @return array
     *
     * 通用方法 获取大部分表是否存在数据
     *
     */
    public function getHealths($tableNames){
            $count=array();
            foreach($tableNames as $key => $value){
                $Num =  R::count($value, '', array());
                if( $Num==0 || $Num==''){
                    $count[$key] = '0';   //如果数据为0 对应的表查询 赋值为0.
                }else{
                    $count[$key] = '1';   //如果数据为0 对应的表查询 赋值为1.
                }
            }
            return $count;
    }

    /**
     * @param $table
     * @param $flag
     * @return array
     *
     * 获取网站logo是否填写
     */

    public function getLogo($table,$flag){
       $result = R::findOne($table,"flag='$flag'");
       $log = new PicManager();
       $log->generateFromRedBean($result);
       $is_log=array();
       if(isset($log->flag)){
           $is_log[$flag]= '1';
       }else{
           $is_log[$flag]= '0';
       }
       return $is_log;
    }

    /**
     * 获取腾讯通是否填写
     * @param $table
     * @param $flag
     * @return array
     *
     */

    public function getSWT($table,$flag){

        $result = R::findOne($table, "flag='$flag'");
        $contacts = new Contact();
        $contacts->generateFromRedBean($result);
        $swt=array();
        if(strlen(trim($result->val))!=0){
            $swt[$flag] = '1';
        }else{
            $swt[$flag] = '0';
        }
        return $swt;
    }

    /**
     * @param $table
     * @return array
     * 判断默认联系方式是否填写
     */

    public function getContent($table){
        $result = R::findAll($table);
        $arr = array();
        foreach($result as $key=>$value){
            $contacts = new Contact();
            $contacts->generateFromRedBean($value);
            if(strlen(trim($contacts->val)) == 0){
                $arr['contact']='0';
                return $arr;
            }
        };
        $arr['contact']='1';
        return $arr;
    }

    /**
     * @param $table
     * @return array
     * 判断默认seo是否填写完整
     */
    public function getSeo($table){
        $result = R::findAll($table);
        $arr = array();
        foreach($result as $key=>$value){
            $seo = new Seo();
            $seo->generateFromRedBean($value);
            if(strlen(trim($seo->title)) == 0){
                $arr['seo']='0';
                return $arr;
            }
        };
        $arr['seo']='1';
        return $arr;
    }

    /**
     * @param $table
     * @return array
     * 判断医院简介是否填写
     */
    public function getIntroduce($table){
        $result = R::findOne($table);
        $introduce = new Introduce();
        $introduce->generateFromRedBean($result);
        $swt=array();
        $if = mb_strlen(trim($result->content),'utf8')>100 ? false:true;
        if($if){
            $swt['introduce'] = '0';
        }else{
            $swt['introduce'] = '1';
        }
        return $swt;
    }
}