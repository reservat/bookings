<?

namespace Bookings\Mapper;

class ESCoreMapper {

	public function putMapping($client){

		try {
			$this->deleteMapping($client);
		} catch (\Exception $e) {
			var_dump($e->getMessage());
		}

		$params['index'] = $this->getIndex();
        $params['body']['mappings'][$this->getType()] = $this->getMapping();

        try {
        	$client->indices()->create($params);
    	} catch (\Exception $e) {
    		var_dump($e->getMessage());
    	}

	}

	public function deleteMapping($client){
		$params['index'] = $this->getIndex();
		$client->indices()->delete($params);
	}

}