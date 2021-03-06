<?php

class replyaskobserver  extends Controller{
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

		$controller->attach($this, array('NOTIFY_ASK_SAVE'));
		$controller->attach($this, array('NOTIFY_ASK_ADDTO'));
	}
	
	function update(&$class, $eventID, $paramArray) {
		
		if(isset($paramArray['push'])&&$paramArray['push']){//如果开启推送
			
		$askid=isset($paramArray['askid'])&&$paramArray['askid']?$paramArray['askid']:0;
		$type=isset($paramArray['type'])&&$paramArray['type']?$paramArray['type']:1;
		$content=isset($paramArray['content'])&&$paramArray['content']?$paramArray['content']:'';
		$askser=new AskService();
		$theask=$askser->getAsk($askid);
		
			$question = R::findOne(TABLENAME_INTERFACE_ASK,'ask_id = '.$askid);
			
			if( ! is_object( $question ) ){
				return false;
			}

			$askser->askjspush($theask->user_alis,$question->question_id,$type);			    
		}
	}


}