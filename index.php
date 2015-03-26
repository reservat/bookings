<?

require_once __DIR__ . '/vendor/autoload.php';

use Klein\Klein;
use Bookings\Core\Config;
use Bookings\Core\Elastic;
use Bookings\Core\Log;

$klein = new Klein();

$klein->respond(function ($request, $response, $service, $app) {

    $app->register('config', function() {
        return new Config();
    });

    $app->register('es', function() use($app){
        $params = $app->config->es;
        return new Elastic($params);
    });

});

$klein->respond('GET', '/test', function ($req, $res, $serv, $app) {

	$booking = new \Bookings\Booking(1, 1, 'new', [1, 2, 3], 6, new Bookings\Core\DateTime(), new Bookings\Core\DateTime());
	$bookingMapper = new \Bookings\Mapper\EsBookingMapper($app->es->getClient());
	$bookingMapper->insert($booking);
	
});

$klein->dispatch();