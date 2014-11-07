<?php

class ApiFunctionLib {
    /**
     * get requestId, still in dummy
     *
     * @param nothing
     * @return string
     */
    public static function getRequestId() {
        return md5(rand(0,1000));
    }
    
    /**
     * get ResponseCodeDescription, still in dummy
     *
     * @param string
     * @return string
     */
    public static function getResponseCodeDescription($code){
    	$responseCode	= DefaultConstant::getResponseCode();
    	
    	return $responseCode[$code];
    }
    
    public static  function safeSQL($string) {
        $string = stripslashes($string);
        $string = strip_tags($string);
        $string = mysql_real_escape_string($string);
        return $string;
	}
	
    public static function debug($var){
    	echo "<pre>".print_r($var)."</pre>";
    }

}