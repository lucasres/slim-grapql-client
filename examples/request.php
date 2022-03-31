<?php

require_once __DIR__ . '/../vendor/autoload.php';

use SlimGraphql\Payload;
use SlimGraphql\Client;
use SlimGraphql\GraphqlException;

$cli = new Client("https://countries.trevorblades.com/");

$payload = new Payload(
    "query {
        continents() {
          code,
          name
        }
      }"
);


try{
  $response = $cli->makeRequest($payload);
  echo var_dump($response->getData());
} catch(GraphqlException $e) {
  // echo var_dump($e->getErrors());
  echo var_dump($e->getErrors());
}