<?php
 
use Phalcon\Mvc\Model\Criteria;

class GroupController extends ControllerBase
{

	public function initialize(){
		GLOBAL $requestId,$responseMessage,$api,$logger,$param,$data;
		$api				=  	$this->apifunctionlib;
        $requestId			=	$api->getRequestId();
        $responseMessage 	= 	DefaultConstant::getResponseCode();
        $param				= $this->request->getPost("data");
    	$data				= $this->validatelib->validateRequestContent($param);	
    	$logger 			= new Phalcon\Logger\Adapter\File("../app/logs/debug.log");
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
    	GLOBAL $api, $requestId,$responseMessage,$logger,$param,$data;
    	try{
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
			#$logger->log( print_r($parameter,1));										
			$rs 		= Groups::find($parameter);
			$response	= array('data'	=> array(
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
    
    /**
     * @Route("/set", name="_group_set", options={"expose"=true})
     * @Template()
     * 	sample input data = 
     			{"clientId": "90794e3b050f815354e3e29e977a88ab", "clientToken": "123", "code": "silver", "type": "Silver Reseller"}
		sample return 
				{
				requestId: "90794e3b050f815354e3e29e977a88ab",
				responseCode: 200,
				responseCodeDescription: "OK",
				groupId: 12
				}
     */
    public function setAction()
    {
    	GLOBAL $api, $requestId,$responseMessage,$logger,$param,$data;
    	try{
	    	$parameter	= array(
	    						"conditions"	=> "type= ?1 AND code= ?2 ",
	    						"bind"			=> array(
	    												1	=> $data->type,
	    												2	=> $data->code
	    												)
								);
			#$logger->log( print_r($parameter,1));								
			$rs 		= Groups::find($parameter);
			if( !$rs->count() ){
				$group	 			= $this->customerlib->addGroup($data);
    		}else{
    			throw new \Exception($responseMessage[DefaultConstant::RCODE_RECORD_EXIST], DefaultConstant::RCODE_RECORD_EXIST);
    		}
			$response	= array('data'	=> array(
								    			'requestId'					=> $requestId,
								    			'responseCode'				=> DefaultConstant::RCODE_OK,
								    			'responseCodeDescription'	=> DefaultConstant::RCODE_OK_MESSAGE,
								    			'groupId'					=> $group->getId()
	    										)
	    						);
		}catch( \Exception $e ){
			$response	= array('data'	=> array(
					        					'requestId'					=> $requestId,
					        					'responseCode'				=> $e->getCode(),
					        					'responseCodeDescription'	=> $e->getMessage(),
					        					'groupId'					=> NULL
	        									)
	        					);
			        					
	    }
	    $this->view->data	= $response['data'];
    }

}
