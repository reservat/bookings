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
    Log::addError('HODOR HODOR HODR');
});

$klein->dispatch();