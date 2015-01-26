<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class tracker extends REST_Controller
{
	function __construct()
    {
        // Construct our parent class
        parent::__construct();
        
        // Configure limits on our controller methods. Ensure
        // you have created the 'limits' table and enabled 'limits'
        // within application/config/rest.php
        $this->methods['user_get']['limit'] = 500; //500 requests per hour per user/key
        $this->methods['user_post']['limit'] = 100; //100 requests per hour per user/key
        $this->methods['user_delete']['limit'] = 50; //50 requests per hour per user/key
    }
    
    function mobil_get()
    {
        if(!$this->get('Callsign'))
        {
        	$this->response(NULL, 400);
        }
		
        if(!empty($this->get('lat')) && !empty($this->get('lon')) && !empty($this->get('acc')))
        {
            $this->response(array(), 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'Manglende data'), 404);
        }
    }

}

function le9ko_createPIN() {
	return substr(str_shuffle(MD5(microtime())), 0, 10);
}
