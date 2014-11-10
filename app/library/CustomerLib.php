<?php


class CustomerLib {
    protected $securityContext;
    protected $validatorService;

	public function setEntityManager(EntityManager $em){
		$this->em = $em;
	}

	public function setValidator($validator){
		$this->validator = $validator;
	}
	
	public function setRouter(Router $router){
		$this->router = $router;
	}

    public function setValidatorService(ValidatorService $validatorService){
		$this->validatorService = $validatorService;
    }
	
    public function addCustomer($data){
    	try{
    		
	    	$responseMessage 	= DefaultConstant::getResponseCode();
	    	$customer 			= new Customers();
			
			#$validate	= $customer->validate($data);
			
			$customer->setFirstName($data->firstName);
	    	$customer->setLastName($data->lastName);
	    	$customer->setTermConditionAggrementDate($data->termConditionAggrementDate);
	    	$customer->setTermConditionAggrementIP($data->termConditionAggrementIP);
	    	$customer->setBirthDate($data->birthDate);
	    	$customer->setNote($data->note);
	    	$customer->setlastActivity($data->lastActivity);
	    	$customer->setStatus($data->status);
	    	$customer->setNote($data->note);
	    	$customer->save();
			
			return $customer;
		}catch( \Exception $e ){
			
			if($e->getCode() == 403){
				throw new \Exception($e->getMessage(), $e->getCode());
			}else{
    			throw new \Exception($responseMessage[DefaultConstant::RCODE_INPUT_TYPE], DefaultConstant::RCODE_INPUT_TYPE);
			}
		}
    }
    
    public function addCustomerGroup($data){
    	try{
    		
	    	$responseMessage = DefaultConstant::getResponseCode();
	    	
	    	$customer 	= new CustomerGroup();
			
			$validate	= $customer->validate($data);
			
			$customer->setType($data->type);
	    	$customer->setCode($data->code);
	    	$this->em->persist($customer);
			$this->em->flush($customer);
			return $customer;
			
		}catch( \Exception $e ){
			
			if($e->getCode() == 403){
				throw new \Exception($e->getMessage(), $e->getCode());
			}else{
    			throw new \Exception($responseMessage[DefaultConstant::RCODE_INPUT_TYPE], DefaultConstant::RCODE_INPUT_TYPE);
			}
		}
    }
    
    public function addEmail($data){
    	try{
    		$responseMessage = DefaultConstant::getResponseCode();
	    	$customer 		= new Email();
			$validate		= $customer->validate($data);
			
	        
			$customerId 	= $this->em->getReference('Bilna\ApiBundle\Entity\Customer\Customer', $data->customerId);
			$ips			= array(
									'whitelistIPs'	=> $data->ips->whitelistIPs, 
									'graylistIPs' 	=> $data->ips->graylistIPs, 
									'blacklistIPs' 	=> $data->ips->blacklistIPs
									);
			$customer->setCustomerId( $customerId );
	    	$customer->setEmail($data->email);
	    	$customer->setVerify($data->verify);
	    	$customer->setVerifyDate($data->verifyDate);
	    	$customer->setSubscribe($data->subscribe);
	    	$customer->setSubscribeDate($data->subscribeDate);	    		    	
	    	$customer->setIPs( json_encode($ips) );
	    	
	    	#$validator 		= $this->get('validator');
   			#$errors 		= $validator->validate($customer);
   			
	    	$this->em->persist($customer);
			$this->em->flush($customer);
			return $customer;
			
		}catch( \Exception $e ){
			
			if($e->getCode() == 403){
				throw new \Exception($e->getMessage(), $e->getCode());
			}else{
    			throw new \Exception($responseMessage[DefaultConstant::RCODE_INPUT_TYPE], DefaultConstant::RCODE_INPUT_TYPE);
			}
		}
    }
    
    public function addGroup($data){
    	try{
    		
	    	$responseMessage = DefaultConstant::getResponseCode();
	    	$customer 		= new Groups();
			#$validate		= $customer->validate($data);
			$customer->setCode($data->code);
	    	$customer->setType($data->type);
	    	$customer->save();
			return $customer;
			
		}catch( \Exception $e ){
			
			if($e->getCode() == 403){
				throw new \Exception($e->getMessage(), $e->getCode());
			}else{
    			throw new \Exception($responseMessage[DefaultConstant::RCODE_INPUT_TYPE], DefaultConstant::RCODE_INPUT_TYPE);
			}
		}
    }
    
    //
    public function addCredential($data){
    	try{
    		
	    	$responseMessage 	= DefaultConstant::getResponseCode();
	    	$customer 			= new Credential();
			$validate			= $customer->validate($data);
			
			$cust 			= $this->em->getReference('Bilna\ApiBundle\Entity\Customer\Customer', $data->customerId);
			$customer->setCustomerId($cust);
	    	$customer->setEmail($data->email);
	    	$customer->setPassword($data->password);
	    	$customer->setSalt($data->salt);
	    	$customer->setType($data->type);
	    	$customer->setToken($data->token);
	    	$customer->setTokenExpiredDate($data->tokenExpiredDate);
	    	$customer->setForceChangePassword($data->forceChangePassword);
	    	$this->em->persist($customer);
			$this->em->flush($customer);
			return $customer;
			
		}catch( \Exception $e ){
			
			if($e->getCode() == 403){
				throw new \Exception($e->getMessage(), $e->getCode());
			}else{
    			throw new \Exception($responseMessage[DefaultConstant::RCODE_INPUT_TYPE], DefaultConstant::RCODE_INPUT_TYPE);
			}
		}
    }
    
    public function checkCredential($type, $email, $pwd)
    {
    	$responseMessage 	= DefaultConstant::getResponseCode();
    	$rs 				= $this->em->createQueryBuilder()
							 	->select('IDENTITY(c.customerId) AS customerId, c.forceChangePassword, c.tokenExpiredDate')
							 	->from('BilnaApiBundle:Customer\Credential','c')
							 	->where("c.type=?1 AND c.email=?2 AND c.password=?3")
								->setParameter(1, $type)
								->setParameter(2, $email)
								->setParameter(3, $pwd)
								->setMaxResults(1)
								->getQuery()
								->getArrayResult();
								
        return $rs;
    }
    
    public function updateCredential($data)
    {
    	try{
    		$responseMessage 	= DefaultConstant::getResponseCode();
	    	$rs	= $this->em->getRepository('BilnaApiBundle:Customer\Credential')
		    							->findOneBy(
		    										array(	
		    												'id' 			=> $data->credentialId,
		    												'customerId'	=> $data->customerId
		    												)
		    										);
	    	if($rs){
	    		$rs->setEmail($data->email);
	    		$rs->setPassword($data->password);
	    		$rs->setSalt($data->salt);
	    		$rs->setType($data->type);
	    		$rs->setToken($data->token);
	    		$rs->setTokenExpiredDate($data->tokenExpiredDate);
	    		$rs->setForceChangePassword($data->forceChangePassword);
	    		$this->em->persist($rs);
				$this->em->flush($rs);
	    	}else{
	    		throw new \Exception($responseMessage[DefaultConstant::RCODE_RECORD_NOTFOUND], DefaultConstant::RCODE_RECORD_NOTFOUND);
	    	}
			
		}catch( \Exception $e ){
			
			if($e->getCode() == 403){
				throw new \Exception($e->getMessage(), $e->getCode());
			}else{
    			throw new \Exception($responseMessage[DefaultConstant::RCODE_INPUT_TYPE], DefaultConstant::RCODE_INPUT_TYPE);
			}
		}
    }
    
    

}