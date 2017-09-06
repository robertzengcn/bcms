<?php

class HomeController extends Controller {

    private $service;

    /**
     * 构造函数 初始化service
     */
    function __construct() {
        parent::__construct();
        $this->service = new HomeService();

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
     * 系统消息
     */
    public function getMsg() {
        $readme = (isset($_COOKIE['readme']) ? false : true);
        $configFile = ABSPATH . '/hcc/readme.html';
        if (! file_exists($configFile)) {
            exit(json_encode(new Result(false, 33, ErrorMsgs::get(33), null)));
        }

        $content = file_get_contents($configFile);
        echo json_encode(new Result($readme, 33, $content, Null));
    }

    /**
     * 不再提示
     */
    public function setMsg() {
        setcookie("readme", "true", time() + 9999999);
    }

    /**
     * 系统健康体检
     * 返回值为json格式:{相关检测对象：0（1）;}
     *
     */
    public function health() {

        $tableNames = $_REQUEST['tableNames'];
        $tableNames = explode(',',$tableNames);
        $res = array();
        foreach($tableNames as $key =>$value){
            switch($value){
                case '':
                    break;
                case 'undefined':
                    break;
                case 'cloudsync':
                    break;
                case 'logo':
                    $logo = $this->service->getLogo('logo');       //判断网站logo是否以存在
                    break;
                case 'swt':
                    $swt =  $this->service->getSWT('swt');          //判断网站商务通是否存在
                    break;
                case 'contact':
                    $content = $this->service->getContent('contact'); //判断联系方式是否已经填写
                    break;
                case 'seo':
                    $seo = $this->service->getSeo('seo');             //判断SEO是否填写
                    break;
                case 'introduce':
                    $introduce = $this->service->getIntroduce('introduce');  //判断医院简介是否填写
                    break;
                default:
                    $res[$value] = $value;

            }
        }

        $reslut = $this->service->getHealths($res);
        $all = array_merge($introduce,$seo,$content,$logo,$swt,$reslut);
        echo json_encode($all);
    }
}
?>

