<?php
/**
 * 
 * Tag标签生成抽象类
 * @author Administrator
 *
 */
abstract class CommonTag {
	
	#.定义服务层句柄
	protected $service = null;
	#.定义smarty句柄
	protected $smarty  = null;
	
	/**
	 * 
	 * 构造方法,实例化smary并获取该tag的配置信息
	 * @param $tagName 
	 */
	public function __construct( $tagName = '' ) {
		#.伪tag名称
		$tagRename = str_replace('Service', '', get_class($this->service) );
		#.读取配置文件
		$tagName = $tagName != '' ? str_replace('Tag', '', $tagName ) : $tagRename;
		$this->getTagConfig( $tagName );
	}
	
	/**
	 * 联系信息 条件查询
	 *
	 * @param string $order 排序字符串
	 * @param string $limit 条数
	 * @param array $where  条件   	
	 * @param string $field 需要查询的字段    	
	 * @return Ambigous <multitype:, multitype:Ambigous <RedBean_OODBBean, mixed, multitype:RedBean_OODBBean > >
	 */
	public function getLimit($order, $limit, $where, $field) {
		return $this->service->getLimit ( $order, $limit, $where, $field );
	}
	
	/**
	 * 
	 * 根据条件查询单条信息
	 * @param array $where 条件
	 * @param string $field 字段
	 */
	public function findOne($where, $field) {
		return $this->service->findOne ( $where, $field );
	}
	
	
	/**
	 * 特色技术 列表分页
	 *
	 * @param string $field        	
	 * @param array $where        	
	 * @param string $limit        	
	 * @param string $order        	
	 *
	 */
	public function getPage($field, $where, $limit, $order) {
	   
		return $this->service->getPage ( $field, $where, $limit, $order );
	}
	
	/**
	 * 按条件查询 获取单条记录
	 *
	 * @param array $where 条件
	 * @param string $field 字段    	
	 * @return Ambigous <multitype:, multitype:Ambigous <RedBean_OODBBean, mixed, multitype:RedBean_OODBBean > >
	 */
	public function find($where, $field) {
		return $this->service->find ( $where, $field );
	}
	
	/**
	 * 
	 * 根据标识符获取对应的配置文件，包含每页条数等等
	 * @param string $handler 标识符
	 */
	public function getTagConfig( $handler = '' ) {
		#.组合
		$handler = ucfirst( $handler ) . 'Tag';
		#.默认模版路径
		$currentUsed = file_get_contents(TEMPDIR.'/config.json');
		$array = json_decode($currentUsed,true);
		$pulugin_tpl = $array[0]['currentUsed'] ? $array[0]['currentUsed'] : 'boyi';
		#.获取配置文件
		$pagesizeJson = TEMPDIR . $pulugin_tpl . '/makehtml.json';
		$pageArrays   = json_decode( $this->delBom( file_get_contents($pagesizeJson) ) );
		#.遍历
		$config   = array();
		$isconfig = false;
		if( isset( $pageArrays ) && is_array( $pageArrays ) ){
			foreach( $pageArrays as $key => $value ) {
				if( $value->tag == $handler ) {
					if( count( $value ) >= 1 ) {
						foreach( $value as $k => $v ) {
							$config[$k] = $value->$k;
						}
						$this->tagConfig = $config;
						$isconfig = true;
					}
				}
			}
		}
		if(!$isconfig){
			$this->tagConfig['pageSize'] = 8;
		}
	}
	
	/**
	 * 检测是否存在bom头,并自动去除
	 * @param unknown $contents
	 * @return string|unknown
	 */
	private function delBom($contents){
		$charset = array();
		$charset[1]=substr($contents,0,1);
		$charset[2]=substr($contents,1,1);
		$charset[3]=substr($contents,2,1);
		if(ord($charset[1])==239 && ord($charset[2])==187 && ord($charset[3])==191){
			return substr($contents,3);
		}
		return $contents;
	}

	/**
	 * 
	 * 根据分页信息获取分页html
	 * @param int $current 当前页
	 * @param int $pageSize 每页条数
	 * @param int $count 总条数
	 * @param string $dir html存放文件夹
	 * @param string $pageHtml 分页模版文件(默认采取index模版分页模式)
	 */
	public function setPageHtml($current,$pageSize,$count,$dir = '',$pageHtml = 'index') {
			#.实例化smarty
		$this->smarty = Tags::instance('Template');
		#.分页导航允许条数
		$pageMaxNav = 7;
		#.总页数
		$pageCount = ceil($count / $pageSize);
		$current  += 1;
		#.上一页
		$pre     = $current > 1 ? ($current - 1) : 1;
		#.下一页
		$next    = ( $current + 1 < $pageCount ) ? ($current+1) : $pageCount;
		#.计算开始&结束页码
		if( $pageCount <= $pageMaxNav ){
			$start = 1;$end   = $pageCount;
		}else{
			#.计算开始
			if( $current <= 4 ){
				$start = 1;$end   = $pageMaxNav;
			}else{
				$start = $current - 3;$end   = $current + 3;
				if( $end >= $pageCount ) {
					$start = $pageCount - $pageMaxNav + 1;$end   = $pageCount;
				}
			}
		}
		#.分页基础模版
		$currentUsed = file_get_contents(TEMPDIR.'/config.json');
		$array = json_decode($currentUsed,true);
		$pulugin_tpl = $array[0]['currentUsed'];
		$file = TEMPDIR . $pulugin_tpl . '/common/page/' . $pageHtml . ".html";
		#.注入数据并返回解析后的html
		$this->smarty->assign ( 'count', $count );
		$this->smarty->assign ( 'pageCount', $pageCount );
		$this->smarty->assign ( 'page', $current );
		$this->smarty->assign ( 'current', $current );
		$this->smarty->assign ( 'pre', $pre );
		$this->smarty->assign ( 'next', $next );
		$this->smarty->assign ( 'end', $end );
		$this->smarty->assign ( 'start', $start );
		$this->smarty->assign ( 'dir' , $dir );
		if($pageCount ==1){ return; }
		return $this->smarty->fetch($file);
	}
	
    /**
     *
     * 根据多name或id获取对应的集合信息
     * {{$DoctorTag->in('15,16,17')}}
     * {{$DoctorTag->in('陈晶晶,工要要')')}}
     * @param $valArray 数据
     * @return array
     *
     */
    public function inBase($valArray,$entity) {
        $valArrays = explode(',',$valArray);
        foreach( $valArrays as $key => $value ){
        	if(is_numeric($value)){
            	$flag='id';
            }else{
                $flag='name';break;
            }
        }
        $string  = $flag." in (";
        $sql     = implode("','", $valArrays);
        $string .="'$sql'";
        $string .= ")";
        $entity = ucfirst( $entity );//首字母大写
        return $this->service->in( $string , $entity );
    }
    
	/**
	 * 
	 * 根据当前页唯一id获得上一条信息与下一条信息
	 * {{$data = $tagOb->getPreNext($id)}} 获取
	 * {{$data['next']->subject}} 下一篇
	 * {{$data['pre']->subject}} 上一篇
	 * @param int $id 唯一id
	 */
	public function getPreNext( $id ) {
		$id = (int)$id <= 0 ? 0 : (int)$id;
		$data['next'] = $this->service->getPreOne( $id );
		$data['pre']  = $this->service->getLastOne( $id );
		foreach($data as $key=>$value) {
			if( is_null( $value ) ) {
				$data[$key]['id'] = 0;
				$data[$key] = (object)$data[$key];
			}
		}
		return $data;
	}
	
	/**
	 * 
	 * 获取随机的limit篇文章(资讯),但不包含id本篇
	 * @param int $id 文章id
	 * @param int $limit 限制条数
	 * @return array&object 返回对象数组
	 */
	public function getByRelation( $id , $limit = 6 ) {
		$result = $this->getLimit( "id" , 20 , array() , "*" );
		$data   = array();
		$i      = 1;
		foreach( $result as $key => $value ) {
			if( $value->id != $id && $i <= $limit ) {
				$data[] = $value;
				$i++;
			}
		}
		shuffle( $data );
		return $data;
	}
	
    /**
     * 
     * 递归方法(通过索引id,反向递归其族谱树id)
     * @param array $diseases 数据数组
     * @param int $id 索引id
     * @param array $data 用户递归叠加的数据
     */
    public function getParListIds($diseases,$id,$data = array()){
    	foreach($diseases as $key => $value){
    		if($value->id == $id){
    			$data[] = array('id'=>$value->id,'url'=>$value->url);
    			if( $value->parent_id != 0 ) {
    				return $this->getParListIds($diseases, $value->parent_id,$data);
    			}
    		}
    	}
    	return $data;
    }

}


















