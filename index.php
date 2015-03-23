<?

require_once __DIR__ . '/vendor/autoload.php';

$klein = new \Klein\Klein();

$klein->respond(function ($request, $response, $service, $app) {

	// TODO: Find a better config solution

    $app->register('config', function() {
        \Bookings\Config();
    	require_once __DIR__ . '/config.php';

        $config = new stdClass();
        $config->coreTimes = $coreTimes;
        $config->overrides = $overrides;

        return $config;

    });

    $app->register('es', function(){

    	require_once __DIR__ . '/config.php';

    	$params = ['hosts' => ['http://'.$esUser.':'.$esPassword.'@'.$esHost]];
    	$client = new \Elasticsearch\Client($params);

    	return $client;

    });



});


$klein->respond('GET', '/slots', function ($req, $res, $service, $app) {

    $calendar = new \OpeningTimes\Calendar($app->config->coreTimes, $app->config->overrides, (20 * 60), (60 * 60));
	$c = $calendar->from(strtotime('Today'))->to(strtotime('Next Week'))->build()->getTimeSlots();

});

$klein->respond('GET', '/booking', function ($req, $res, $service, $app) {
	


});

$klein->dispatch();