<?

namespace Bookings\Core;

class Log {

	protected static $_instance = null;
	protected static $_log = null;

	public function __construct(){

		$config = new \Bookings\Core\Config();
		$config = $config->log['slack'];

		self::$_log = new \Monolog\Logger('slack');
		self::$_log->pushHandler(new \Monolog\Handler\SlackHandler(
			$config['token'], 
			$config['channel'], 
			$config['username'], 
			true, 
			$config['emote'], 
			\Monolog\Logger::ERROR
		));

	}

	public static function log($func, $args){

		if(self::$_instance === null){
			self::$_instance = new static();
		}

		self::$_log->$func($args);
		
	}

	public static function __callstatic($func, $args){

		self::log($func, implode($args));

	}

}