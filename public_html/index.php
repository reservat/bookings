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

// Find the customer by id
// @todo - use UUID instead of auto increment id
$klein->respond('GET', '/customer/[i:id]', function($req, $res, $serv, $app) {

    // Create a CustomerRepository object and pass the instance of PDO to it
    $repo = new \Reservat\Repository\CustomerRepository($app->db);

    // Fetch the user by ID, if found, return as a JSON object, otherwise throw a 404
    if($customer = $repo->getById($req->param('id'))->current()) {
        $res->json($customer);
    } else {
        $res->code(404);
    }
});

$klein->respond('POST', '/customer', function($req, $res, $serv, $app) {
    // Create the customer entity
    $customer = new \Reservat\Customer(
        $req->param('forename'),
        $req->param('surname'),
        $req->param('telephone'),
        $req->param('email')
    );

    // Create a CustomerDatamapper object and pass the instance of PDO to it
    $mapper = new \Reservat\Datamapper\CustomerDatamapper($app->db);
 
    // Insert the customer
    $mapper->insert($customer);
});

$klein->dispatch();
