<?php

class TopicService extends BaseService {

    private $diseaseDAO;

    private $picManagerDAO;

    private $recommendListDAO;

    /**
     * 构造函数
     */
    public function __construct() {
        $this->dao = new TopicDAO();
    }

    /**
     * 批量删除
     *
     * @param array $arr(id,...)
     * @return boolean
     */
    public function deleteBatch($ids) {
        Entity::isIds($ids); // 验证ids是否合法

        $topics = $this->dao->getBatch($ids);
        $files = array();
        $this->dao->beginTrans();
        $userVar = new UserVarDAO();
        try {
            $recommendListDAO = new RecommendListDAO();
            foreach ($topics as $topic) {
                $filename = GENERATEPATH . 'topic/' . $topic->id . '.html';
                if ($topic->id == 0) {
                    throw new ValidatorException(78);
                }
                $files[] = $filename;
                if ($topic->is_tpl == 3) { // 动态的专题
                    $userVar->clearByPid($topic->id, 2);
                }
                $recommendListDAO->deleteById('topic_id', $topic->id);
                $this->delTopic( $topic );
            }

            foreach ($files as $file) {
                if (file_exists($file)) {
                    unlink($file);
                }
            }

            $this->dao->deleteBeans($topics);
            $this->dao->commitTrans();
        } catch (Exception $e) {
            $this->dao->rollbackTrans();
            return $this->fail(0, $e->getMessage());
        }

        return $this->success();
    }

    /**
     * 获取一条数据
     *
     * @param Entity $topic
     * @return Result
     */
    public function get($topic) {
        $this->dao->get($topic->id, $topic);

        if ($topic->pic) {
            $topic->src = UPLOAD . $topic->pic;
        }
        $recommendListDAO = new RecommendListDAO();
        $topic->recommendlist = $recommendListDAO->getById('topic_id', $topic->id);

        $tagService = new TagService();
        $topic->tags = $tagService->getTags($topic->plushtime);
        $txlist = explode(',', $topic->effect);
        $picManagerDAO = new PicManagerDAO();
        foreach ($txlist as $k) {
            if ($k != '') {
                $effect = $picManagerDAO->getEffectByFlag($k);
                $topic->txlist[] = $effect->name;
            }
        }

        return $this->success($topic);
    }

    /**
     * 获取一条数据
     *
     * @param Entity $topic
     * @return Result
     */
    public function getOne($where, $field) {
        $topic = new Topic();
        $topic->id = $_REQUEST['id'];
        $this->dao->get($topic->id, $topic);

        return $topic;
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     * @return Result
     */
    public function query($where) {
        $topics = $this->dao->query($where);
        $diseaseDAO = new DiseaseDAO();
        foreach ($topics as $key => $value) {
            $value->plushtime = date('Y-m-d', $value->plushtime);
            $value->disease = $diseaseDAO->getDiseaseById($value->disease_id);
        }

        return $this->success($topics);
    }
    /**
     * 获得url
     */
    public function getUrls() {
        $topics = $this->dao->getUrls();
		$array = array();
		foreach($topics as $key=>$value){
				$array->$key = $value;			
				$array[$key]['id'] = $value->id;
				$array[$key]['subject'] = $value->subject;
				$array[$key]['link'] = $value->link;
				$array[$key]['url'] = $value->url;
		}
        return $this->success($array);		
	}
    /**
     * 保存数据
     *
     * @param Entity $topic
     * @return Result
     */
    public function save($topic) {
        $topic->validate();
        
        //文件夹是否存在
        if( is_dir( GENERATEPATH . 'topic/' . $topic->url ) ) {
        	return $this->fail( 158 , ErrorMsgs::get( 158 ) );
        }
        
        if (! isset($topic->is_tpl) || $topic->is_tpl == '') {
            $topic->is_tpl = 1;
        }
        if ($topic->is_tpl == 2) {
            $where = array(
                '79' => 'subject',
                '88' => 'link'
            );
        } else {
            $where = array(
                '79' => 'subject'
            );
        }
        // $this->_required ( $where );

        $topic->plushtime = time();
        if ($topic->link != '') {
            $topic->link = str_replace(".html", '', $topic->link);
            $topic->link .= ".html";
        }

        $this->dao->beginTrans();
        try {
            $tagsService = new TagService();
            $tagsService->tagsSave($topic->plushtime);

            // 获取class对象并插入数据
            $this->dao->save($topic);

            // 复制专题模版
            $this->copyTopic($topic);
            
            // 将正文内容填充到模版
            $this->updateTplContent( GENERATEPATH . 'topic/' . $topic->url . '/index.htpl' , $topic );
            
            if (isset($_REQUEST['recommendposition'])) {
                $is_tomobile = isset($_REQUEST['is_tomobile']) ? $_REQUEST['is_tomobile'] : '1';
                $recommendposition = $_REQUEST['recommendposition'];
                foreach ($recommendposition as $val) {
                    if (is_numeric($val)) {
                        $recommendlist = new RecommendList();
                        $recommendlist->is_top = $_REQUEST['is_top'];
                        $recommendlist->recommendposition_id = $val;
                        $recommendlist->topic_id = $topic->id;
                        $recommendlist->is_tomobile = $is_tomobile;
                        $recommendDao = new RecommendListDAO();
                        $recommendDao->save($recommendlist);
                    }
                }
            }
            $this->dao->commitTrans();
        } catch (Exception $e) {
            $this->dao->rollbackTrans();
            return $this->fail(0, $e->getMessage());
        }

        return $this->success();
    }
    
    public function updateTplContent($tplUrl,$topic){
    	$topic_list = $this->getpicList();
    	foreach ($topic_list as $key => $value){
    		if( $value['id'] == $topic->topiclistid ){
    			$url = explode('/', $value['url']);
    			$topic->content = str_replace('/upload/topic/'.$url[2].'/','/topic/'.$topic->url.'/', $topic->content);
    			$topic->content = preg_replace('#<title>.*</title>#iUs', '<title>{{$SEO_TITLE}}</title>', $topic->content);
    			$topic->content = preg_replace('/ \&nbsp; \&nbsp;/', '', $topic->content);		//过滤ueditor编辑器产生的空格与换行
    			$topic->content = preg_replace('/<p><\/p>/', '', $topic->content);
    			break;
    		}
    	}
    	file_put_contents($tplUrl, html_entity_decode(stripslashes($topic->content)));
    }
    
    /**
     * 复制专题模版
     * @param object $topic 提交数据对象
     */
    public function copyTopic($topic){
    	$topHtpl  = $this->gethtml($topic->topiclistid);
    	$topIcDir = GENERATEPATH . 'topic/' . $topic->url;
    	require_once GENERATEPATH . 'lib/io.php';
    	if( ! is_dir( $topIcDir ) ){
    		@mkdir( $topIcDir );
    	}
    	$htplDir  = GENERATEPATH . dirname( $topHtpl );
    	@Io::DirCopy($htplDir, $topIcDir);
    	@unlink($topIcDir.'/config.xml');
    }
    
    /**
     * 删除专题模版
     */
    public function delTopic($topic){
    	$topHtpl  = $this->gethtml($topic->topiclistid);
    	$topIcDir = GENERATEPATH . 'topic/' . $topic->url;
    	require_once GENERATEPATH . 'lib/io.php';
    	if( is_dir( $topIcDir ) ){
    		Io::DirDelete( $topIcDir );
    	}
    }
    
    /**
     * 更新专题模版
     */
    public function updateTopic($topic){
    	//根据$topic->id获取当前数据库中专题模版ID
    	$tp = new Topic();
    	$this->dao->get($topic->id, $tp);
    	require_once GENERATEPATH . 'lib/io.php';
    	//如果路径被改变,则改变当前的文件夹名称
    	if($topic->url != $tp->url){
    		if( is_dir( GENERATEPATH . 'topic/' . $topic->url ) ) {
    			return false;
    		}
    		@rename( GENERATEPATH . 'topic/' . $tp->url ,  GENERATEPATH . 'topic/' . $topic->url );
    	}
    	//比较模版ID(如果相同,则证明没有重新选择模版)
    	if($topic->topiclistid != $tp->topiclistid){
    		$this->copyTopic($topic);
    	}
    	return true;
    }
    
    /**
     * 添加特制技术
     */
    public function addCustom($topic) {
        $topic->validate();
        $topic->is_tpl = 3;
        $result = $this->save($topic);
        if ($result->statu) {
            $id = $topic->id;
            $userVarService = new UserVarService();
            foreach ($_REQUEST['special'] as $key => $val) {
                $userVar = new UserVar();
                $userVar->pid = $id;
                $userVar->name = $val[0];
                $userVar->var_name = $key;
                $userVar->val = $val[1];
                $userVar->kind = 2;
                $userVar->type = $val[2];

                $userVarService->save($userVar);
            }
        }

        return $result;
    }

    /**
     * 获取用户自建字段
     */
    public function getVar() {
        $userVarService = new UserVarService();
        $result = $userVarService->getUserVar();

        return $result;
    }

    /**
     * 获取预置特效列表
     */
    public function getEffect() {
        $picManagerDAO = new PicManagerDAO();
        return $picManagerDAO->getEffect();
    }

    /**
     * 编辑动态专题
     */
    public function editCustom($topic) {
        $topic->validate();

        if ($topic->link != '' && $topic->is_tpl == 2) {
            $topic->link = str_replace(".html", '', $topic->link);
            $topic->link .= ".html";
        }

        $this->dao->beginTrans();
        try {
            $recommendListDAO = new RecommendListDAO();
            $tagsService = new TagService();
            $tagsService->tagsClear($topic->plushtime);
            $tagsService->tagsSave($topic->plushtime);

            // 获取class对象并插入数据
            $result = $this->dao->update($topic);
            
            $recommendListDAO->deleteById('topic_id', $topic->id);

            if (isset($_REQUEST['recommendposition'])) {
                $is_tomobile = isset($_REQUEST['is_tomobile']) ? $_REQUEST['is_tomobile'] : '1';
                $recommendposition = $_REQUEST['recommendposition'];
                foreach ($recommendposition as $val) {
                    if (is_numeric($val)) {
                        $recommendlist = new RecommendList();
                        $recommendlist->is_top = $_REQUEST['is_top'];
                        $recommendlist->recommendposition_id = $val;
                        $recommendlist->topic_id = $topic->id;
                        $recommendlist->is_tomobile = $is_tomobile;
                        $recommendListDAO->save($recommendlist);
                    }
                }
            }

            // 修改变量配置
            $userVarService = new UserVarService();
            foreach ($_REQUEST['special'] as $value) {
                $userVarService->mdfVar($value);
            }
            $this->dao->commitTrans();
        } catch (Exception $e) {
            $this->dao->rollbackTrans();
            return $this->fail(0, $e->getMessage());
        }

        return $this->success();
    }

    /**
     * 更新数据
     *
     * @param Entity $topic
     * @return Result
     */
    public function update($topic) {
        $topic->validate();
        
        if ($topic->link != '' && $topic->is_tpl == 2) {
            $topic->link = str_replace(".html", '', $topic->link);
            $topic->link .= ".html";
        }

        $this->dao->beginTrans();
        try {
            $recommendListDAO = new RecommendListDAO();
            $tagsService = new TagService();
            $tagsService->tagsClear($topic->plushtime);
            $tagsService->tagsSave($topic->plushtime);
            
            // 更新专题模版
            if( ! $this->updateTopic( $topic ) ){
            	$this->dao->rollbackTrans();
            	return $this->fail( 158 , ErrorMsgs::get( 158 ) );
            }
            
            // 将正文内容填充到模版
            $this->updateTplContent( GENERATEPATH . 'topic/' . $topic->url . '/index.htpl' , $topic );
            
            // 获取class对象并插入数据
            $result = $this->dao->update($topic);
            
            $recommendListDAO->deleteById('topic_id', $topic->id);

            if (isset($_REQUEST['recommendposition'])) {
                $recommendposition = $_REQUEST['recommendposition'];
                foreach ($recommendposition as $val) {
                    if (is_numeric($val)) {
                        $recommendlist = new RecommendList();
                        $recommendlist->is_top = $_REQUEST['is_top'];
                        $recommendlist->recommendposition_id = $val;
                        $recommendlist->topic_id = $topic->id;

                        $recommendListDAO->save($recommendlist);
                    }
                }
            }
            $this->dao->commitTrans();
        } catch (Exception $e) {
            $this->dao->rollbackTrans();
            return $this->fail(0, $e->getMessage());
        }

        return $result;
    }

    /**
     * 根据id数组获取数据
     *
     * @return Result
     */
    public function getByIds() {
        $topics = $this->dao->getByIds();

        $diseaseDao = new DiseaseDAO();
        foreach ($topics as $key => $value) {
            $value->plushtime = date('Y-m-d H:i:s', $value->plushtime);
            $value->disease = $diseaseDao->getDiseaseById($value->disease_id);
        }
        return $this->success($topics);
    }

    /**
     * 获取专题模板列表
     *
     */
    public function getpicList(){
        return $this->dao->getpicList();
    }

    /**
     * @param $topicid
     * @return mixed
     * 获取模板路径
     */
    public  function gethtml($topicid){
        return $this->dao->gethtml($topicid);
    }
    
    /**
     * 
     * 删除专题模版
     * @param int $topicid
     */
	public function deleteHtml($topicid){
		return $this->dao->deleteHtml( $topicid );
	}
    
    /**
     * 保存专题模板文件
     *
     */
    public function uploadTpl($filepath,$filename){
        return $this->dao->uploadTpl($filepath,$filename);
    }
}
