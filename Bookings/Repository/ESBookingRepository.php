<?

namespace Bookings\Repository;

use Bookings\Repository\Interfaces\RepositoryInterface;
use Bookings\Repository\Interfaces\ESBookingRepositoryInterface;
use Bookings\Mapper\ESBookingMapper;
use Elasticsearch\Client;

class ESBookingRepository implements RepositoryInterface, ESBookingRepositoryInterface
{
	protected $client = null;

	public function __construct(Client $client){
		$this->client = $client;
	}

	public function getById($id)
	{

	}

	public function getAll()
	{
		$query = [
		    "query" => [
		        "match_all" => []
		    ]
		];

		$params['index'] = ESBookingMapper::getIndex();
		$params['type']  = ESBookingMapper::getType();
		$params['body']  = json_encode($query);

		$results = $this->client->search($params);

		return $results;
	}
}