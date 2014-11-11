<?php
 
use Phalcon\Mvc\Model\Criteria;

class CredentialController extends ControllerBase
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
	
	public function indexAction(){
    GLOBAL $requestId;
    	$response	= array('data'	=> array(
							    			'requestId'					=> $requestId,
							    			'responseCode'				=> DefaultConstant::RCODE_API_UNAUTHORIZED_CLIENTID,
							    			'responseCodeDescription'	=> DefaultConstant::RCODE_API_UNAUTHORIZED_CLIENTID_MESSAGE,
				    						)
				    		);
    	$this->view->data	= $response['data'];
    }
    
    
    
    /**
     * @Route("/add", name="_credential_add", options={"expose"=true})
     * @Template()
     * 	sample input data = 
     			{"clientId": "90794e3b050f815354e3e29e977a88ab", "clientToken": "123", "customerId": "1", "email": "abdul.aziz@bilna.com", "password" : "asdasd", "salt" : "12312312", "type" : "1", "token" : "xxx", "tokenExpiredDate" : "2014-10-30 10:10:10", "forceChangePassword" : "1"}
		sample return 
				{
				requestId: "90794e3b050f815354e3e29e977a88ab",
				responseCode: 200,
				responseCodeDescription: "OK",
				customerId: 1,
				credentialId: 1
				}
     */
    public function addAction()
    {
    	GLOBAL $api, $requestId,$responseMessage,$logger,$param,$data;
    	try{
    		$rs = $this->customerlib->checkCredential($data->type, $data->email, $data->password);
	    	if( !$rs->count() ){
    			$credential = $this->customerlib->addCredential($data);
    		}else{
    			throw new \Exception($responseMessage[DefaultConstant::RCODE_RECORD_EXIST], DefaultConstant::RCODE_RECORD_EXIST);
    		}
    		
	    	$response	= array('data'	=> array(
								    			'requestId'					=> $requestId,
								    			'responseCode'				=> DefaultConstant::RCODE_OK,
								    			'responseCodeDescription'	=> DefaultConstant::RCODE_OK_MESSAGE,
								    			'customerId'				=> $data->customerId,
								    			'credentialId'				=> $credential->getId()
	    										)
	    						);

		}catch( \Exception $e ){
    		$response	= array('data'	=> array(
							    				'requestId'					=> $requestId,
							    				'responseCode'				=> DefaultConstant::RCODE_UNKNOWN,
							    				'responseCodeDescription'	=> DefaultConstant::RCODE_UNKNOWN_MESSAGE.": ".$e->getMessage(),
							    				'emails'					=> array()
    											)
    							);
    	}
	    $this->view->data	= $response['data'];
    }
    
    /**
     * @Route("/get", name="_credential_get", options={"expose"=true})
     * @Template()
     * 	sample input data = 
     			{"clientId": "90794e3b050f815354e3e29e977a88ab", "clientToken": "123", "conditions" : [ {"field" : "email", "filter" : "=", "value" : "abdul.aziz@bilna.com"},{"field" : "type", "filter" : "=", "value" : "1"}],"sortBy" : [{"field" : "type", "value" : "ASC"}], "limit" : "5"}
		sample return 
				{"requestId":"41ae36ecb9b3eee609d05b90c14222fb","responseCode":200,"responseCodeDescription":"OK","credentials":[{"credentialId":2,"type":1,"email":"abdul.aziz@bilna.com"},{"credentialId":4,"type":1,"email":"abdul.aziz@bilna.com"},{"credentialId":5,"type":1,"email":"abdul.aziz@bilna.com"}]}
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
	    								"columns"		=> "id AS credentialId, type, email",
									    "conditions" 	=> $conditionSyntax,
									    "bind"       	=> $bind,
									    "order"			=> $sortBySyntax,
									    "limit"			=> $data->limit
									);
			$rs 		= Credentials::find($parameter);
			$response	= array('data'	=> array(
						        					'requestId'					=> $requestId,
						        					'responseCode'				=> DefaultConstant::RCODE_OK,
													'responseCodeDescription'	=> DefaultConstant::RCODE_OK_MESSAGE,
						        					'credentials'				=> $rs->toArray()
						        					)
									);
									
									
    	}catch( \Exception $e ){
    		$response	= array('data'	=> array(
							    				'requestId'					=> $requestId,
							    				'responseCode'				=> $e->getCode(),
							    				'responseCodeDescription'	=> $e->getMessage(),
							    				'credentials'				=> array()
    											)
    							);
    	}
		
		$this->view->data	= $response['data'];
    }
    
    /**
     * @Route("/update", name="_credential_update", options={"expose"=true})
     * @Template()
     * 	sample input data = 
     			{"clientId": "90794e3b050f815354e3e29e977a88ab", "clientToken": "123", "customerId": "1", "credentialId" : "2", "email" : "abdul.aziz@bilna.com", "verifyPassword": "123456", "password" : "123456", "salt" : "1234", "type" : "1", "token" : "123", "tokenExpiredDate" : "2014-10-10 19:10:10", "forceChangePassword": false}
		sample return 
				{"requestId":"b6edc1cd1f36e45daf6d7824d7bb2283","responseCode":200,"responseCodeDescription":"OK","customerId":"1","credentialId":"2"}
     */
    public function updateAction()
    {
    	GLOBAL $api, $requestId,$responseMessage,$logger,$param,$data;
    	try{
    		if($data->verifyPassword == $data->password){
	    		$rs	= $this->customerlib->updateCredential($data);
		    	
	    	}else{
	    		throw new \Exception($responseMessage[DefaultConstant::RCODE_INPUT_VALUE].": verifyPassword is not match with Password", DefaultConstant::RCODE_INPUT_VALUE);
	    	}
	    	
            $response	= array('data'	=> array(
					        					'requestId'					=> $requestId,
					        					'responseCode'				=> DefaultConstant::RCODE_OK,
												'responseCodeDescription'	=> DefaultConstant::RCODE_OK_MESSAGE,
					        					'customerId'				=> $data->customerId,
					        					'credentialId'				=> $data->credentialId
												)
								);
								
    	}catch( \Exception $e ){
    		$response	= array('data'	=> array(
							    				'requestId'					=> $requestId,
							    				'responseCode'				=> $e->getCode(),
							    				'responseCodeDescription'	=> $e->getMessage(),
							    				'credentials'				=> array()
    											)
    							);
    	}
		
		$this->view->data	= $response['data'];
    }
}
