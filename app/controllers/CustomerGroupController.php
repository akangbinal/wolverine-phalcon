<?php
 
use Phalcon\Mvc\Model\Criteria;

class CustomerGroupController extends ControllerBase
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
     * @Route("/set", name="_customer_group_set", options={"expose"=true})
     * @Template()
     * 	sample input data = 
     			{"clientId": "90794e3b050f815354e3e29e977a88ab", "clientToken": "123", "customerId": "1", "groupId" : "2"}
		sample return 
				{"requestId":"a597e50502f5ff68e3e25b9114205d4a","responseCode":200,"responseCodeDescription":"OK"}
     */
    public function setAction()
    {
    	GLOBAL $api, $requestId,$responseMessage,$logger,$param,$data;
    	try{
    		$rs_cg	= CustomerGroups::find("customer_id = '".$data->customerId."' AND group_id = '".$data->groupId."'");
    		$rs_c	= Customers::findByid($data->customerId);
    		$rs_g	= Groups::findByid($data->groupId);
    		if( !$rs_c->count() ){
				throw new \Exception($responseMessage[DefaultConstant::RCODE_RECORD_NOTFOUND].": customerId", DefaultConstant::RCODE_RECORD_NOTFOUND);
			}elseif( !$rs_g->count()){
				throw new \Exception($responseMessage[DefaultConstant::RCODE_RECORD_NOTFOUND].": groupId", DefaultConstant::RCODE_RECORD_NOTFOUND);
			}elseif( !$rs_cg->count() ){
				$customer 	= $this->customerlib->addCustomerGroup($data);
				$response	= array('data'	=> array(
									    			'requestId'					=> $requestId,
									    			'responseCode'				=> DefaultConstant::RCODE_OK,
									    			'responseCodeDescription'	=> DefaultConstant::RCODE_OK_MESSAGE,
									    			'customerId'				=> $customer->getId()
	    											)
	    							);
			}else{
				throw new \Exception($responseMessage[DefaultConstant::RCODE_RECORD_EXIST], DefaultConstant::RCODE_RECORD_EXIST);
			}
	    	$response	= array('data'	=> array(
								    			'requestId'					=> $requestId,
								    			'responseCode'				=> DefaultConstant::RCODE_OK,
								    			'responseCodeDescription'	=> DefaultConstant::RCODE_OK_MESSAGE,
								    			'customerId'				=> $customer->getId()
												)
								);
    	}catch( \Exception $e ){
			$response	= array('data'	=> array(
					        					'requestId'					=> $requestId,
					        					'responseCode'				=> $e->getCode(),
					        					'responseCodeDescription'	=> $e->getMessage(),
					        					'customerId'				=> NULL
	        									)
	        					);	
	    }
	    $this->view->data	= $response['data'];
    }

	/**
     * @Route("/get", name="_customer_group_get", options={"expose"=true})
     * @Template()
     * 	sample input data = 
     			{"clientId": "90794e3b050f815354e3e29e977a88ab", "clientToken": "123", "conditions" : [ {"field" : "customerId", "filter" : "=", "value" : "1"},{"field" : "groupId", "filter" : "=", "value" : "2"}],"sortBy" : [{"field" : "customerId", "value" : "asc"},{"field" : "groupId", "value" : "desc"}], "limit" : "5"}
		sample return 
				{"requestId":"285e19f20beded7d215102b49d5c09a0","responseCode":200,"responseCodeDescription":"OK","customerGroups":[{"groupId":"2","customerId":"1"}]}
     */
    public function getAction()
    {
    GLOBAL $api, $requestId,$responseMessage,$logger,$param,$data;
    	try{
    		$data->limit	= isset($data->limit) ? 5 : $data->limit;
			$conditions		= array();
			$bind			= array();
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
	    								"columns"		=> "customer_id AS customerId, group_id AS groupId",
									    "conditions" 	=> $conditionSyntax,
									    "bind"       	=> $bind,
									    "order"			=> $sortBySyntax,
									    "limit"			=> $data->limit
									);
			$rs 		= CustomerGroups::find($parameter);
			$response	= array('data'	=> array(
						        					'requestId'					=> $requestId,
						        					'responseCode'				=> DefaultConstant::RCODE_OK,
													'responseCodeDescription'	=> DefaultConstant::RCODE_OK_MESSAGE,
						        					'customerGroups'			=> $rs->toArray()
						        					)
									);
		}catch( \Exception $e ){
    		$response	= array('data'	=> array(
							    				'requestId'					=> $requestId,
							    				'responseCode'				=> DefaultConstant::RCODE_UNKNOWN,
							    				'responseCodeDescription'	=> DefaultConstant::RCODE_UNKNOWN_MESSAGE.": ".$e->getMessage(),
							    				'customerGroups'			=> array()
    											)
    							);
    	}
								
		$this->view->data	= $response['data'];
		
	}
	
}
