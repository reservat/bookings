<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Klein\Klein;
use Reservat\Core\Config;
use Reservat\Core\Elastic;
use Reservat\Core\Log;

$klein = new Klein();

$klein->respond(function ($request, $response, $service, $app) {

    Dotenv::load(__DIR__ . '/../');

    $app->register('config', function() {
        return new Config(__DIR__ . '/../');
    });

    $app->register('log', function() {
        return new Log();
    });

    $app->register('es', function() use($app){
        $params = $app->config->es;
        return new Elastic($params);
    });

    $app->register('db', function() use($app) {
        return new PDO('mysql:host='.$app->config->mysql['host'].';dbname='.$app->config->mysql['db'], $app->config->mysql['user'], $app->config->mysql['password']);
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

$klein->respond('POST', '/customer', function($req, $res, $serv, $app) {
    $customer = new \Reservat\Customer($req->param('forename'), $req->param('surname'), $req->param('telephone'));
    $mapper = new \Reservat\Datamapper\CustomerDatamapper($app->db);
    $mapper->insert($customer);
});

$klein->dispatch();