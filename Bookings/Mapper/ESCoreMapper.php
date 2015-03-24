<?

namespace Bookings\Mapper;

use Bookings\Core\Log;

class ESCoreMapper {

	public function putMapping($client){

		try {
			$this->deleteMapping($client);
		} catch (\Exception $e) {
			Log::addError($e->getMessage());
		}

		$params['index'] = $this->getIndex();
        $params['body']['mappings'][$this->getType()] = $this->getMapping();

        try {
        	$client->indices()->create($params);
    	} catch (\Exception $e) {
    		Log::addError($e->getMessage());
    	}

	}

	public function deleteMapping($client){
		$params['index'] = $this->getIndex();
		$client->indices()->delete($params);
	}

	public function getMapping(){
		return $this->_mapping;
	}

	public function getIndex(){
		return $this->_index;
	}

	public function getType(){
		return $this->_type;
	}

}