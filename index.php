<?

require_once __DIR__ . '/vendor/autoload.php';

$klein = new \Klein\Klein();

$klein->respond(function ($request, $response, $service, $app) {

    $app->register('config', function() {
        return new \Bookings\Core\Config();
    });

    $app->register('es', function() use($app){
        $params = $app->config->es;
        return new \Bookings\Core\Elastic($params);
    });

});

$klein->respond('GET', '/test', function ($req, $res, $serv, $app) {
    $esBooking = new \Bookings\Mapper\ESBookingMapper(); 
    $esBooking->putMapping($app->es->getClient());
});

$klein->dispatch();