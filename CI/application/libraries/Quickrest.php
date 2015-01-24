<?php

class Quickrest {

    var $baseurl;

    var $decoder = 'json_decode';
    var $encoder = 'json_encode';

    function __construct($baseurl) {
        $this->baseurl = $baseurl;
    }

    function getUrl($resource) {
        return $this->baseurl.$resource;
    }

    function setDecoder($decoder) {
        $this->decoder = $decoder;
    }

    function setEncoder($encoder) {
        $this->encoder = $encoder;
    }

    function request($method, $resource, $data = null) {
	    $http = array();
	    $http['method'] = $method;
	    
	    if($data !== null) {
		    $encoder = $this->encoder;
		    $http['content'] = $encoder($data);
		    $http['header'] = "Content-type: application/x-www-form-urlencoded\r\n"
                . "Content-Length: " . strlen($http['content']) . "\r\n";
		}
	    
        $context = stream_context_create(array(
        	'http' => $http
        ));
        
        $ret = file_get_contents($this->getUrl($resource), false, $context);
        if(empty($this->decoder)) return $ret;
        $decoder = $this->decoder;
        return $decoder($ret);
    }

    function get($resource) {
        return $this->request('GET', $resource);
    }

    function post($resource, $data) {
        return $this->request('GET', $resource, $data);
    }

    function delete($resource) {
        return $this->request('DELETE', $resource);
    }
}
