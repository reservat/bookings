<? 

namespace Bookings\Core;

class Elastic {

	public function __construct($details){
		$params = ['hosts' => ['http://'.$details['user'].':'.$details['pass'].'@'.$details['host']]];
		var_dump($params);
    	$this->_client = new \Elasticsearch\Client($params);
	}

	public function client(){
		return $this->_client;
	}

}