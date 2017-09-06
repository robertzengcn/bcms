<?php

class SpiteIPController extends Controller {

    private $service;

    public function __construct() {
        $this->service = new SpiteIPService();
    }

    public function filter() {
        $filterService = new FilterService();
        $filterService->addFunc($filterService::$SQLINJECTION);
        $filterService->addFunc($filterService::$WORKERISLOGIN);
        $filterService->addFunc($filterService::$FILERPLUSHTIME);
        $filterService->addFunc($filterService::$WORKERLOGHISTORY);
        return $filterService->execute();
    }

    /**
     * 获取恶意IP...
     */
    public function getSpite() {
        $IPs = $this->service->getSpite();
        echo json_encode($IPs);
    }
}