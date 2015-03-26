<?

namespace Bookings\Mapper;

use Bookings\Mapper\Interfaces\DataMapperInterface;

class ESOpeningTimesMapper extends ESDataMapper implements DataMapperInterface
{

    protected static $_index = 'openingtimes';

    protected static $_type = 'openingtimes';

    protected static $_id = 'venueId';

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