<?php

/**
 * 自定义频道DAO
 *
 * @author Administrator
 *
 */
class ChannelDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_CHANNEL;
    }

    /**
     * 条件查询
     *
     * @param unknown $where
     *            查询条件
     * @return multitype:unknown
     */
    public function query($where) {
        DTExpression::like('name', $where);
        DTExpression::like('shortname', $where);
        DTExpression::eq('id', $where);
        DTExpression::page($where);

        if (isset($where['order']) &&  $where['order']) {
            DTOrder::$sql = $where['order'];
        } else {
            DTOrder::desc('id');
        }
        
        return $this->getByComposite(ORMMap::$classes[$this->tableName], DTExpression::$sql . DTOrder::$sql . DTExpression::$limit);
    }

    /**
     * 获得总数
     *
     * @param array $where
     *            查询条件
     *            return object $arr
     */
    public function totalRows($where) {
        DTExpression::like('name', $where);
        DTExpression::like('shortname', $where);

        return $this->getRecordCount(DTExpression::$sql, DTExpression::$params);
    }

    /**
     * 删除
     *
     * @param int $id
     */
    public function delete($id) {
        $channel = new Channel();
        $channel->id = $id;
        $this->get($channel->id, $channel);

        if ($channel->id == 0) {
            return new Result(false, 78, ErrorMsgs::get(78), NULL);
        }

        R::exec(ORMMap::$sqlMap['deleteChannelArticleByChannelId'], array(
            ':channel_id' => $id
        ));

        $filename = GENERATEPATH . $channel->shortname;
        $this->deldir($filename);
        if($channel->tplurl != ''){
        	@unlink(GENERATEPATH.$channel->tplurl);
        }
    	if($channel->detailtplurl != ''){
        	@unlink(GENERATEPATH.$channel->detailtplurl);
        }

        $channelBean = R::load($this->tableName, $id);
        R::trash($channelBean);
    }

    /**
     * 批量删除
     *
     * @see DBBaseDAO::deleteBatch()
     */
    public function deleteBatch($ids) {
        $channels = $this->getBatch($ids);
        foreach ($channels as $key) {
            if ($key->id == 0) {
                return new Result(false, 78, ErrorMsgs::get(78), NULL);
            }
            $userVarDAO = new UserVarDAO();
            $userVarDAO->clearByPid($key->id, 3);

            R::exec(ORMMap::$sqlMap['deleteChannelArticleByChannelId'], array(
                ':channel_id' => $key->id
            ));

            $filename = GENERATEPATH . $key->shortname;
            $this->delDir($filename);
            if ($key->tplurl != ''){
            	@unlink(GENERATEPATH.$key->tplurl);
            }
        	if ($key->detailtplurl != ''){
            	@unlink(GENERATEPATH.$key->detailtplurl);
            }
        }
        R::trashAll($channels);

        return new Result(true, 0, '', NULL);
    }

    /**
     * 删除文件及文件夹
     *
     * @param unknown $dir
     * @return boolean
     */
    private function delDir($dir) {
        if (file_exists($dir)) {
            // 先删除目录下的文件：
            $dh = opendir($dir);
            while ($file = readdir($dh)) {
                if ($file != "." && $file != "..") {
                    $fullpath = $dir . "/" . $file;
                    if (! is_dir($fullpath)) {
                        unlink($fullpath);
                    } else {
                        $this->delDir($fullpath);
                    }
                }
            }

            closedir($dh);
            // 删除当前文件夹：
            rmdir($dir);
        }
    }
    /**
     * 通过id查询数据
	 * @return array
     */	
    public function getChanneInfo($channelId) {
        $data[0] = R::getRow( "SELECT * FROM ".$this->tableName." WHERE id=".$channelId." LIMIT 1 " );				
		return	$data;
	}
    /**
     * 获得所有个性的id
	 * @return array
     */	
    public function getAllChanneId() {
        $data = R::getAll( "SELECT id FROM ".$this->tableName." WHERE 1=1" );
		return	$data;
	}
}
