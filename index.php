<?

require_once __DIR__ . '/vendor/autoload.php';

$klein = new \Klein\Klein();

$klein->respond(function ($request, $response, $service, $app) {

    $app->register('config', function() {

        $config = new \Bookings\Config();
        return $config;

    });

    $app->register('es', function() use($app){
        $params = $app->config->es;
        return new \Bookings\Elastic($params);
    });



});


$klein->respond('GET', '/slots', function ($req, $res, $service, $app) {

    $calendar = new \OpeningTimes\Calendar($app->config->coreTimes, $app->config->overrides, (20 * 60), (60 * 60));
	$c = $calendar->from(strtotime('Today'))->to(strtotime('Next Week'))->build()->getTimeSlots();

});

$klein->respond('GET', '/booking', function ($req, $res, $service, $app) {

	$indexParams['index']  = 'booking';

        // Example Index Mapping
        $myTypeMapping = array(
            '_source' => array(
                'enabled' => true
            ),
            'properties' => array(
                'name' => array(
                    'type' => 'string',
                    'analyzer' => 'standard'
                ),
                'telephone' => array(
                    'type' => 'string'
                ),
                'e-mail' => array(
                    'type' => 'string'
                ),
                'telephone' => array(
                    'type' => 'string'
                )
            )
        );

        $indexParams['body']['mappings']['bookings'] = $myTypeMapping;

        // Create the index
        $res = $app->es->client()->indices()->create($indexParams);
        var_dump($res);
});

$klein->dispatch();