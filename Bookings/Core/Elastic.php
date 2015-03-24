<? 

namespace Bookings\Core;

class Elastic {

	public function __construct($details){
		$params = ['hosts' => ['http://'.$details['user'].':'.$details['pass'].'@'.$details['host']]];
    	$this->_client = new \Elasticsearch\Client($params);
	}

	public function getClient(){
		return $this->_client;
	}

}