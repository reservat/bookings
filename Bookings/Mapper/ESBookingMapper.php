<?

namespace Bookings\Mapper;

class ESBookingMapper extends ESCoreMapper {

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
            'tableId' => [
            	'type' => 'integer'
            ],
            'guests' => [
                'type' => 'integer'
            ],
            'tableCapacity' => [
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