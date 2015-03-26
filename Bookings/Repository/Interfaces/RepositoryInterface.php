<?

namespace Bookings\Repository\Interfaces;

interface RepositoryInterface 
{
	public function getById($id);
	public function getAll();
}