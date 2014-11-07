<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class GroupsController extends ControllerBase
{

	public function initialize(){
		GLOBAL $requestId,$responseMessage,$api,$logger;
		$api				=  	$this->apifunctionlib;
        $requestId			=	$api->getRequestId();
        $responseMessage 	= 	DefaultConstant::getResponseCode();
        $logger 			= 	new \Phalcon\Logger\Adapter\File("../app/logs/error.log");
		
	}
	
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }
    
     /**
     * Get action
     * 	sample input data = 
     			{"clientId": "90794e3b050f815354e3e29e977a88ab", "clientToken": "123", "conditions" : [ {"field" : "code", "filter" : "=", "value" : "silver"},{"field" : "type", "filter" : "=", "value" : "Silver Reseller"}],"sortBy" : [{"field" : "code", "value" : "asc"}]}
		sample return 
				{"requestId":"4e0928de075538c593fbdabb0c5ef2c3","responseCode":200,"responseCodeDescription":"OK","groups":[{"groupId":"1","groupCode":"silver"}]}
     */
    public function getAction()
    {
    	GLOBAL $api, $requestId,$responseMessage,$logger;
    	try{
			$param	= $this->request->getPost("data");
	    	$data	= $this->validatelib->validateRequestContent($param);
	    	$conditions	= array();
			$bind		= array();
			if( isset($data->conditions) ){
				$i=1;
				foreach($data->conditions as $k => $v){
					if(isset($v->field)){
						$conditions[]	= $v->field."".$v->filter." ?$i";
						$bind[$i]		= $v->value;
		            	$i++;
		           	}
		           	
	            }
			}
	        $conditionSyntax	= count($conditions)>0 ? implode(" AND ",$conditions) : "";
	        
	        $sortBy	= array();
	        if( isset($data->sortBy) ){
	            foreach($data->sortBy as $k => $v){
		            if(isset($v->field))
	            		$sortBy[]	=  $v->field. " ".$v->value ;
	            }
	        }		            
	        $sortBySyntax	= count($sortBy)>0 ? implode(", ",$sortBy) : "";
	        
	        $parameter	= array(
	    								"columns"		=> "id AS groupId, code AS groupCode",
									    "conditions" 	=> $conditionSyntax,
									    "bind"       	=> $bind,
									    "order"			=> $sortBySyntax
									);
			#$logger->log( print_r($parameter,true));
			#error nya 
	        $rs 		= Groups::find($parameter);
			#$logger->log( print_r($rs,true));	
			#$logger->log("count : ".count($rs));					
	    	$response			= array('data'	=> array(
						        					'requestId'					=> $requestId,
						        					'responseCode'				=> DefaultConstant::RCODE_OK,
													'responseCodeDescription'	=> DefaultConstant::RCODE_OK_MESSAGE,
						        					'groups'					=> $rs->toArray()
						        					)
									);
		}catch( \Exception $e ){
    		$response	= array('data'	=> array(
							    				'requestId'					=> $requestId,
							    				'responseCode'				=> DefaultConstant::RCODE_UNKNOWN,
							    				'responseCodeDescription'	=> DefaultConstant::RCODE_UNKNOWN_MESSAGE.": ".$e->getMessage(),
							    				'groups'					=> array()
    											)
    							);
    	}
								
		$this->view->data	= $response['data'];								
    }

}
