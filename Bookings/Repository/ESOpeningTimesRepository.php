<?

namespace Bookings\Repository;

use ReservatCore\Interfaces\RepositoryInterface;
use Bookings\Repository\Interfaces\ESOpeningTimesRepositoryInterface;
use Elasticsearch\Client;

class ESOpeningTimesRepository implements RepositoryInterface, ESOpeningTimesRepositoryInterface
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

	}
}