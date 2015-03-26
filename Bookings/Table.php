<?

namespace Bookings;

use \Bookings\Interfaces\TableInterface;

class Venue implements TableInterface, EntityInterface
{

	protected $_number = null;
	protected $_capacity = null;
	protected $_venueId = null;
	protected $_isFixed = null;

	public function __construct($number, $capacity, $venueId, $isFixed)
	{
		$this->_number = $number;
		$this->_capacity = $capacity;
		$this->_venueId = $venueId;
		$this->_isFixed = $isFixed;
	}

	public function getNumber()
	{
		return $this->_number;
	}

	public function getCapacity()
	{
		return $this->_capacity;
	}

	public function getVenue()
	{
		return $this->_venue;
	}

	public function getIsFixed()
	{
		return $this->_isFixed;
	}

	public function toArray()
	{
		return [
			'number' => $this->_name,
			'capacity' => $this->_capacity,
			'venue' => $this->_venue,
			'isFixed' => $this->_isFixed
		];
	}

}