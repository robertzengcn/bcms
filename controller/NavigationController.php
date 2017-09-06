<?php

class NavigationController extends Controller {

    private $service;

    /**
     * 构造函数 初始化service
     */
    function __construct() {
        $this->service = new NavigationService();
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
     * 删除数据
     */
    public function del() {
        // 是否单笔删除还是批量删除
        if (is_array($_REQUEST['id'])) {
            $navigations = $_REQUEST['id'];
        } else {
            $navigations = array(
                $_REQUEST['id']
            );
        }
        $result = $this->service->deleteBatch($navigations);

        echo json_encode($result);
    }

    /**
     * 获得查询的grid数据
     */
    public function query() {
        $result = $this->service->query($_REQUEST);
        $totalRows = $this->service->totalRows($_REQUEST);

        echo json_encode(array(
            'rows' => $result->data,
            'ttl' => $totalRows->data
        ));
    }

    /**
     * 获得单笔
     */
    public function get() {
        $this->blindParams($navigation = new Navigation());
        $result = $this->service->get($navigation);
    	if( $result->data->pic != '' ){
			$result->data->src  = UPLOAD . $result->data->pic;
		}
		if( $result->data->pid != 0 ){		 		    
		    $nav = new Navigation();
		    $nav->id = $result->data->pid;
		    $res = $this->service->get($nav);
		    $result->data->pidname  = $res->data->subject;
		}else{
		    $result->data->pidname = '无';
		}
        echo json_encode($result);
    }

    /**
     * 获取所有
     */
    public function getNavigation() {
        $result = $this->service->getNavigation();

        echo json_encode($result);
    }
    
    
    /**
     * 获取第一层导航所有
     */
    public function getNavigationBycate() {
        $result = $this->service->query($_REQUEST);
        echo json_encode($result);
    }

    
    
    /**
     * 获取各个层级导航所有树状图
     */
    public function getNavSubTree() {
        $result = $this->service->querySub($_REQUEST);
        if(count($result->data) >0){
            $html = '<option value="" selected="selected">请选择</option>';
            foreach ($result->data as $value){
                $html .= "<option value='".$value->id."' >".$value->subject."</option>";
                $where = array();
                $where['pid'] =  $value->id;
                $res = $this->service->querySub($where);
                if(count($res->data)>=1){
                    foreach ($res->data as $v){
                        $html.= "<option value='".$v->id."'>"."&nbsp;&nbsp;|-".$v->subject."</option>";
                        $where = array();
                        $where['pid'] =  $v->id;
                        $res1 = $this->service->querySub($where);
                        if(count($res1->data)>=1){
                            foreach ($res1->data as $v1){
                                $html.= "<option value='".$v1->id."'>"."&nbsp;&nbsp;&nbsp;&nbsp;|-".$v1->subject."</option>";
                            }
                            
                        }
                    }
                    
                }
              
            }
        }else{
            $html = '';
        }
        echo json_encode($html);
    }
    
    
    
    /**
     * 编辑
     */
    public function edit() {
        $this->blindParams($navigation = new Navigation());
        $result = $this->service->update($navigation);

        echo json_encode($result);
    }

    /**
     * 添加
     */
    public function add() {
        $this->blindParams($navigation = new Navigation());
        $result = $this->service->save($navigation);

        echo json_encode($result);
    }

    /**
     * 获取静态url列表
     */
    public function getHtmlUrl() {
        $result = $this->service->getHtmlUrl();

        echo json_encode($result);
    }

    /**
     * 获取静态url列表
     */
    public function getHtmlUrlByPara() {
        $result = $this->service->getHtmlUrlByPara();

        echo json_encode($result);
    }
}

