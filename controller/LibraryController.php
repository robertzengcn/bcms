<?php

class LibraryController extends Controller {

    private $service;
    
    private $articleInterUrl = 'http://www.boyicms.com';

    /**
     * 构造函数 初始化service
     */
    function __construct() {
        parent::__construct();
        $this->service = new LibraryService();
    }

    /**
     * 过滤(non-PHPdoc)
     *
     * @see Controller::filter()
     */
    function filter() {
        $filterService = new FilterService();
        $filterService->addFunc($filterService::$SQLINJECTION);
        $filterService->addFunc($filterService::$WORKERISLOGIN);
        $filterService->addFunc($filterService::$WORKERLOGHISTORY);

        return $filterService->execute();
    }
    
    /**
     * 获得查询的grid数据
     */
    public function query() {
    	$result = $this->service->query($_REQUEST);
    	$totalRows = $this->service->totalRows($_REQUEST);
    	foreach ($result->data as $key => $value){
    		$result->data[$key]->plushtime = date('Y-m-d H:i:s',$value->plushtime);
    	}
    	die( json_encode( array('rows' => $result->data,'ttl' => $totalRows->data) ) );
    }
    
    public function search_begin() {
    	$keyword_one = isset($_REQUEST['keyword_one']) ? $_REQUEST['keyword_one'] : '';
    	$keyword_two = isset($_REQUEST['keyword_two']) ? $_REQUEST['keyword_two'] : '';
    	#.暂时模拟返回数据
    	$keyword_one = urlencode( $keyword_one );
    	$keyword_two = urlencode( $keyword_two );
    	$url    = $this->articleInterUrl . '/interface/hwibs/article/ArticleInterface.php?action=list&keyword_one='.$keyword_one.'&keyword_two='.$keyword_two . '&' . $this->formatApiTokenQry('list');
    	$result = file_get_contents($url);
    	$data   = array();
    	if( $result != '' ){
    		$data = json_decode($result,true);
    		foreach ($data['data'] as $key => $value){
    			if( $value['title'] != '' && $value['subject'] == '' ){
    				$data['data'][$key]['subject'] = $value['title'];
    			}
    			if( trim( $value['description'] ) == '' ){
    				$data['data'][$key]['description'] = '暂无文章简介';
    			}else{
    				$data['data'][$key]['description'] = mb_substr($data['data'][$key]['description'], 0,24,'utf-8').'...';
    				$data['data'][$key]['description'] = ltrim( $data['data'][$key]['description'] );
    			}
    			$data['data'][$key]['plushtime']   = date('Y-m-d H:i:s',time() - ( $key+1 ) );
    		}
    		die( json_encode( array('statu'=>true,'rows' => $data['data'],'ttl' => count($data)) ) );
    	}else{
    		die( json_encode( array('statu'=>false,'rows' => array(),'ttl' => 0) ) );
    	}
    }
    
    public function check_search_allow(){
    	#.暂时模拟允许搜索
    	die( json_encode( array('statu'=>true,'msg'=>'允许搜索','count'=>6) ) );
    }
    
    public function search_view(){
    	#.暂时模拟远程搜索单文章并导入到数据库
    	$article_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
    	$url    = $this->articleInterUrl . '/interface/hwibs/article/ArticleInterface.php?action=detail&id='.$article_id . '&' . $this->formatApiTokenQry('detail');;
    	$result = file_get_contents($url);
    	$result = json_decode($result,true);
    	if( count( $result['data'] ) >= 1 ){
    		$data = $result['data'][0];
    		if( $data['title'] != '' && $data['subject'] == '' ){
    			$data['subject'] = $data['title'];
    		}
    		die( json_encode( array('statu'=>true,'msg'=>'预览成功','data'=>$data) ) );
    	}else{
    		die( json_encode( array('statu'=>false,'msg'=>'预览失败','data'=>null) ) );
    	}
    }
    
    public function search_download(){
    	#.暂时模拟远程搜索单文章并导入到数据库
    	$article_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
    	#.远程取数据..
    	$url    = $this->articleInterUrl . '/interface/hwibs/article/ArticleInterface.php?action=detail&id='.$article_id. '&' . $this->formatApiTokenQry('detail');;
    	$result = file_get_contents($url);
    	$result = json_decode($result,true);
    	if( count( $result['data'] ) >= 1 ){
    		$data = $result['data'][0];
    		if( $data['title'] != '' && $data['subject'] == '' ){
    			$data['subject'] = $data['title'];
    		}
    		#.导入数据
    		$articleService = new ArticleService();
    		$article = new Article();
    		$article->subject 		= $data['subject'];//
    		$article->content 		= $data['content'];//
    		$article->plushtime 	= $data['plushtime'];//
    		$article->pic     		= isset($data['pic']) ? $data['pic'] : '';//...
    		$article->source  		= isset($data['source']) ? $data['source'] : '';;//...
    		$article->title   		= isset($data['title']) ? $data['title'] : '';;//...
    		$article->keywords 		= isset($data['keywords']) ? $data['keywords'] : '';;//...
    		$article->description 	= isset($data['description']) ? $data['description'] : '';;//...
    		$article->click_count   = rand(15,105);
    		$article->isbidding     = 0;
    		$article->department_id = 1;
    		$article->disease_id    = 1;
    		$article->doctor_id		= 0;
    		$article->category_id 	= 0;
    		$article->is_top 		= 0;
    		$article->worker_id 	= 1;
    		$article->relation 		= '';
    		$article->updatetime 	= time();
    		$article->tags          = '文章库,博医CMS';
    		$result = $articleService->save($article);
    		if( $result->statu == 1 ){
    			die( json_encode( array('statu'=>true,'msg'=>'下载成功') ) );
    		}else{
    			die( json_encode( array('statu'=>false,'msg'=>'下载失败') ) );
    		}
    	}else{
    		die( json_encode( array('statu'=>false,'msg'=>'下载失败') ) );
    	}
    }
    
    /**
     * 
     * 获取当前正在运行的数据库名称
     */
    public function get_data(){
    	die( json_encode( $this->service->get_data() ) );
    }
    
    public function get_table(){
    	$data = $this->service->get_table();
    	$html = '';
    	$datas= array();
    	$allow_table = array('article','channelarticle','device','doctor','honor','mediareport','movie','news','success','technology','navigation','navgroup','answer','ask','askaddto','askdesc');
    	$table_cname = array('article'=>'疾病资讯','answer'=>'问答回复','ask'=>'问答问题','askaddto'=>'问答追问','askdesc'=>'问答详情','channelarticle'=>'个性频道','device'=>'医院设备','doctor'=>'医生信息','honor'=>'医院荣誉','mediareport'=>'媒体报道','movie'=>'医院视频','news'=>'医院新闻','success'=>'成功案例','technology'=>'特色技术','navigation'=>'网站导航','navgroup'=>'自定义导航组');
    	foreach( $data as $key => $value ){
    		if( in_array( strtolower( $value['table_name'] ) , $allow_table ) ){
    			$html .= "<option value='".$value['table_name']."'>".$table_cname[$value['table_name']]."</option>";
    			$datas[] = $value;
    		}
    	}
    	die( json_encode( new Result(true, 0, '', array('list'=>$html,'first'=>$datas[0]['table_name']) ))  );
    }
    
    public function get_field(){
    	$data = $this->service->get_field();
    	$html = '';
    	$allow_field = array('subject','title','content','info','keywords','description','link','pic','url');
    	$field_cname = array('subject'=>'标题/名称','title'=>'SEO标题','content'=>'资讯正文','info'=>'问答回复','keywords'=>'关键词','description'=>'内容简介','link'=>'视频链接','pic'=>'缩略图地址','url'=>'导航链接');
    	foreach( $data as $key => $value ){
    		if( $key != 'Field' ){
    			if( in_array( strtolower( $value['Field'] ) , $allow_field ) ){
    				$html .= "<option value='".$value['Field']."'>".$field_cname[$value['Field']]."</option>";
    			}
    		}
    	}
    	die( json_encode( new Result(true, 0, '', $html  ) ));
    }
    
    public function replace(){
    	$firm_num = $this->service->replace();
    	die( json_encode( new Result(true, 0, '', $firm_num  ) ));
    }

    /**
     * 删除
     */
    public function del() {
        $this->blindParams($library = new Library());
        $result = $this->service->delete($library);

        echo json_encode($result);
    }

    /**
     * 批量删除
     */
    public function delBatch() {
        $result = $this->service->deleteBatch($_REQUEST['id']);

        echo json_encode($result);
    }

    /**
     * 添加
     */
    public function save() {
        $this->blindParams($libaray = new Library());
        $result = $this->service->save($libaray);
        echo json_encode($result);
    }

    /**
     * 编辑
     */
    public function get() {
        $this->blindParams($libaray = new Library());
        $result = $this->service->get($libaray);

        echo json_encode($result);
    }

    /**
     * 更改
     */
    public function update() {
        $this->blindParams($libaray = new Library());
        $result = $this->service->update($libaray);

        echo json_encode($result);
    }
}

?>
