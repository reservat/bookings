<?

namespace Bookings\Mapper;

class ESOpeningTimesMapper extends ESCoreMapper {

    protected $_index = 'openingtimes';

    protected $_type = 'openingtimes';

	protected $_mapping = [
		'_source' => [
                'enabled' => true
        ],
        'properties' => [
            'venueId' => [
                'type' => 'integer',
            ],
            'days' => [
            	'type' => 'nested',
                'properties' => [
                    'dayId' => [
                        'type' => 'integer'
                    ], 
                    'slots' => [
                        'type' => 'nested',
                        'properties' => [
                            'name' => [
                                'type' => 'string'
                            ],
                            'description' => [
                                'type' => 'string'
                            ],
                            'startTimeTS' => [
                                'type' => 'integer'
                            ],
                            'endTimeTS' => [
                                'type' => 'integer'
                            ]
                        ]
                    ]
                ]
            ],
        ]
	];

}