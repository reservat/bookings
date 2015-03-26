<?

namespace Bookings\Mapper;

use Bookings\Core\Log;
use Bookings\Interfaces\EntityInterface;

class ESDataMapper
{

	protected $_client;

	public function __construct($client){
		$this->_client = $client;
	}

	public function putMapping($client)
	{
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

	public function deleteMapping($client)
	{
		$params['index'] = $this->getIndex();
		$client->indices()->delete($params);
	}

	public function getMapping()
	{
		return $this->_mapping;
	}

	public function getIndex()
	{
		return $this->_index;
	}

	public function getType()
	{
		return $this->_type;
	}

    public static function getId(){
        return static::$_id;
    }

    public function insert(EntityInterface $entity)
    {
    	$this->save($entity);
    }

    public function update(EntityInterface $entity)
    {
    	$this->save($entity);
    }

    public function save(EntityInterface $entity)
    {
    	$params = [];
		$params['body']  = $entity->toArray();

		$params['index'] = $this->_index;
		$params['type']  = $this->_type;
		$params['id']    = $entity->getId();

		$ret = $this->_client->index($params);

		if($ret['created']){
			return true;
		} else {
			throw new \Exception('Could not create booking');
		}
    }

    public function delete(EntityInterface $entity)
    {

    }

}