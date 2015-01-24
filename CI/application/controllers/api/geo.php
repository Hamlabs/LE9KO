<?php

require(APPPATH.'libraries/REST_MQ_Controller.php');
require(APPPATH.'libraries/Quickrest.php');

class Geo extends REST_MQ_Controller {
	
	var $zmq_queue_type = ZMQ::SOCKET_PUSH;
	var $zmq_queue_addr = 'tcp://127.0.0.1:31336';

	var $es_base = 'http://frankie.bzzt.no:9200/';
	var $es;

    public function __construct($config = 'rest') {
        parent::__construct($config); // pass variable to parent class
		date_default_timezone_set('UTC');

		$this->es = new Quickrest($this->es_base);
	}

	protected function getESIndex($minutestrail) {
		$start = time() - 60*$minutestrail;	
		$end = time();
		$startindex = strftime('aprs-%Y.%m.%d', $start);
		$endindex = strftime('aprs-%Y.%m.%d', $end);
		if($startindex == $endindex) return $endindex;
		return "$startindex,$endindex";
	}

    public function trail_get() {
	    $q = new stdClass();
	    
	    $q->from = 0;
	    $q->size = 20;
	    $q->sort['@timestamp'] = 'desc';
	    $q->query->term->srccallsign = $this->get('id');
	    #$q->query->bool->must[]->match->_type = 'location';
	    #$q->query->bool->must[]->match->srccallsign = $this->get('id');
	    
	    if($this->get('showq') == 'yes') {
		    $this->response($q); return;
		}
	    
	    $es_result = $this->es->post($this->getESIndex(60).'/_search', $q);
	    
		$this->response($es_result);    
    }

    public function radius_get() {
	    $q = new stdClass();

		$timelimit = strftime('%Y/%m/%d %H:%M:%S', time()-60*$this->get('minutes'));

	    $q->from = 0;
	    $q->size = 1000;
	    $q->sort['@timestamp'] = 'desc';
	    $q->query->filtered->query->match_all = new stdClass();
 	    $tsfield = '@timestamp';
  	    $q->query->filtered->filter->and[0]->range->$tsfield->lte = 'now';
  	    $q->query->filtered->filter->and[0]->range->$tsfield->gte = $timelimit;
  	    $q->query->filtered->filter->and[1]->geo_distance->distance = $this->get('radius').'km';
  	    $q->query->filtered->filter->and[1]->geo_distance->geo_location->lat = $this->get('lat');
  	    $q->query->filtered->filter->and[1]->geo_distance->geo_location->lon = $this->get('lon');
	    	    
	    if($this->get('showq') == 'yes') {
		    $this->response($q); return;
		}

	    if($this->get('history') == 'yes') {
		    $history = true;
		} else {
			$history = false;
		}
	    
	    $es_result = $this->es->post($this->getESIndex(60).'/_search', $q);

		$result = new stdClass();
		
		$stations = array();
		
		//$result->hits = $es_result->hits->total;
		foreach($es_result->hits->hits as $hit) {
			switch($hit->_source->type) {
				case 'object':
					$call = $hit->_source->objectname;
					break;
				case 'item':
					$call = $hit->_source->itemname;
					break;
				default:
					$call = $hit->_source->srccallsign;
			}
			if($history) {
				$stations[$call][] = $hit->_source;
			} else {
				if(!isset($stations[$call])) {
					$stations[$call] = $hit->_source;
				}
			}
		}
		//var_dump($stations);
		foreach(array_keys($stations) as $call) {
			$result->$call = $stations[$call];
		}
	    
		$this->response($result);    
    }

}

//     "filtered" : {
//         "query" : {
//             "match_all" : {}
//         },
//         "filter" : {
//             "geo_distance" : {
//                 "distance" : "200km",
//                 "pin.location" : {
//                     "lat" : 40,
//                     "lon" : -70
//                 }
//             }
//         }
//     }
