<?php
// autoload files
require 'vendor/autoload.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

// initialize Slim application instance
$app = new \Slim\App();

// API endpoint to obtain new UUID
$app->get('/api/uuid/generate', function (Request $request, Response $response) {
  try {
    $uuid = Uuid::uuid1();
    $data = ['uuid' => $uuid->toString()];
    return $response->withJson($data, 200);
  } catch (Exception $e) {
    $data = ['error' => $e->getMessage()];
    return $response->withJson($data, 500);
  }
});

// run application
$app->run();
