<?php

class CustomerController extends \Phalcon\Mvc\Controller
{
	public function initialize(){
		GLOBAL $requestId,$responseMessage,$api,$logger,$param,$data;
		$api				= $this->apifunctionlib;
        $requestId			= $api->getRequestId();
        $responseMessage 	= DefaultConstant::getResponseCode();
        $param				= $this->request->getPost("data");
    	$data				= $this->validatelib->validateRequestContent($param);	
    	$logger 			= new Phalcon\Logger\Adapter\File("../app/logs/debug.log");
	}
	
    public function indexAction()
    {

    }

	/**
     * @Route("/set", name="_customer_set", options={"expose"=true})
     * @Template()
     * 	sample input data = 
     			{"clientId": "90794e3b050f815354e3e29e977a88ab", "clientToken": "123", "firstName": "Joko", "lastName": "Widodo", "termConditionAggrementDate": "2014-10-10 10:10:10", "lastActivity" : "2014-10-09 10:12:12", "termConditionAggrementIP": "203.190.241.151","lastLogin": "2014-10-09 09:09:09",  "birthDate": "1980-10-10", "status": "1", "note": "note saja"}
		sample return 
				{
				requestId: "90794e3b050f815354e3e29e977a88ab",
				responseCode: 200,
				responseCodeDescription: "OK",
				customerId: 12
				}
     */
    public function setAction()
    {
    	GLOBAL $api, $requestId,$responseMessage,$logger,$param,$data;
    	try{
    		$customer	= $this->customerlib->addCustomer($data);
    		$logger->log( print_r($data,1)); 
	    	$response	= array('data'	=> array(
								    			'requestId'					=> $requestId,
								    			'responseCode'				=> DefaultConstant::RCODE_OK,
								    			'responseCodeDescription'	=> DefaultConstant::RCODE_OK_MESSAGE,
								    			'customerId'				=> $customer->getId()
	    										)
	    						);
	    						
	   	}catch(\Doctrine\ORM\ORMException $e){
	   		$response	= array('data'	=> array(
	        					'requestId'					=> $requestId,
	        					'responseCode'				=> DefaultConstant::RCODE_FAILED_ORM,
	        					'responseCodeDescription'	=> $responseMessage[DefaultConstant::RCODE_FAILED_ORM].": ".$e->getMessage(),
	        					'customerId'				=> NULL
	        					));
		}catch( \Exception $e ){
			$response	= array('data'	=> array(
	        					'requestId'					=> $requestId,
	        					'responseCode'				=> $e->getCode(),
	        					'responseCodeDescription'	=> $e->getMessage(),
	        					'customerId'				=> NULL
	        					));
			        					
	    }
	    	
    	$this->view->data	= $response['data'];
    }
}

