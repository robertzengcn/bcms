<?php

class clientfocuspushobserver  extends Controller{
	/* (non-PHPdoc)
	 * @see Controller::filter()
	*/
	public function filter() {
		// TODO Auto-generated method stub
		$filterService = new FilterService();
		$filterService->addFunc($filterService::$SQLINJECTION);
		$filterService->addFunc($filterService::$FILERPLUSHTIME);

		return $filterService->execute();
	
	}
	
	public function __construct() {
      global $controller;

      $controller->attach($this, array('NOTIFY_CLIENT_SAVE'));
	}
	
	function update(&$class, $eventID, $paramArray) {
		
		if(isset($paramArray['push'])&&$paramArray['push']){//如果开启推送

			
			    
		}
	}


}