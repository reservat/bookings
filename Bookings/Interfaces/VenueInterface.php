<?

namespace Bookings\Interfaces;

interface VenueInterface
{
	public function getName();
	public function getDescription();
	public function getTelephoneNumber();
	public function getEmailAddress();
	public function getPassword();
	public function getLastLogin();
	public function getPostcode();
	public function getLatLng();
	public function getCapacity();
	public function getSlotInterval();
	public function getOccupiedTime();
}