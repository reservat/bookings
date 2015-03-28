<?php

require_once __DIR__ . '/vendor/autoload.php';

use Klein\Klein;
use Reservat\Core\Config;
use Reservat\Core\Elastic;
use Reservat\Core\Log;

$klein = new Klein();

$klein->respond(function ($request, $response, $service, $app) {

    $app->register('config', function() {
        return new Config();
    });

    $app->register('es', function() use($app){
        $params = $app->config->es;
        return new Elastic($params);
    });

    $app->register('db', function() use($app) {
        //return new PDO('mysql:host='.$app->config->)
    });
});

$klein->respond('GET', '/test', function ($req, $res, $serv, $app) {

	$booking = new \Reservat\Booking(1, 1, 'new', [1, 2, 3], 6, new Reservat\Core\DateTime(), new Reservat\Core\DateTime());
	$bookingMapper = new \Reservat\Datamapper\EsBookingDatamapper($app->es->getClient());
	$bookingMapper->insert($booking);
	
});

$klein->respond('GET', '/booking', function ($req, $res, $serv, $app) {

	$repo = new \Reservat\Repository\ESBookingRepository($app->es->getClient());
	$bookings = $repo->getAll();

	var_dump($bookings);
	
});

$klein->dispatch();