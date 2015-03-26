<?

namespace Bookings\Mapper;

use Bookings\Mapper\Interfaces\DataMapperInterface;
use Bookings\Interfaces\EntityInterface;

class ESBookingMapper extends ESDataMapper implements DataMapperInterface
{

    protected $_index = 'bookings';
    
    protected $_type = 'booking';

	protected $_mapping = [
		'_source' => [
                'enabled' => true
        ],
        'properties' => [
            'customerId' => [
                'type' => 'integer',
            ],
            'venueId' => [
            	'type' => 'integer'
            ],
            'state' => [
                'type' => 'string'
            ],
            'tableIds' => [
                "type"  => "integer", 
                "index_name" => "tableId"
            ],
            'guests' => [
                'type' => 'integer'
            ],
            'dateStart' => [
            	'type' => 'date'
            ],
            'dateBooked' => [
            	'type' => 'date'
            ]
        ]
	];

    public function insert(EntityInterface $booking)
    {

    }

    public function update(EntityInterface $booking)
    {

    }

    public function save(EntityInterface $booking)
    {

    }

    public function delete(EntityInterface $booking)
    {

    }

}