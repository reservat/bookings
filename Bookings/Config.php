<?

namespace Bookings;

class Config {

	protected $_config = [];

	public function __construct(){
		$config = require_once __DIR__ . '../config.php';
		var_dump($config);
	}

}