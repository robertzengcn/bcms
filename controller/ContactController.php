<?php

class ContactController extends Controller {

    private $service;

    /**
     * 构造函数 初始化service
     */
    function __construct() {
        parent::__construct();
        $this->service = new ContactService();
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
     * 根据名称查找
     */
    public function getByName() {
        $result = $this->service->query($_REQUEST);

        echo json_encode(array(
            'rows' => $result->data,
            'ttl' => ''
        ));
    }

    /**
     * 删除
     */
    public function del() {
        $this->blindParams($contact = new Contact());
        $result = $this->service->delete($contact);

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
        $this->blindParams($contact = new Contact());
        $result = $this->service->save($contact);

        echo json_encode($result);
    }

    /**
     * 编辑
     */
    public function get() {
        $this->blindParams($contact = new Contact());
        $result = $this->service->get($contact);

        echo json_encode($result);
    }

    /**
     * 更改
     */
    public function update() {
        $this->blindParams($contact = new Contact());
        $result = $this->service->update($contact);

        echo json_encode($result);
    }

    /**
     * 通过flag来获取联系信息
     */
    public function getContacts() {

        $flag = $_REQUEST['flag'];
        $result = $this->service->getContact($flag);
        echo json_encode ($result);
    }
    
    /*
     * 更新udeks url
     * */
    public function updatedesk(){
    	$result =$this->service->updateudesk(array('val'=>$_REQUEST['val']));
    	echo json_encode ($result);
    }

    
    
}

?>
