<?php

require_once __DIR__ . '/../vendor/autoload.php';

use SlimGraphql\Payload;
use SlimGraphql\Client;

$cli = new Client("https://countries.trevorblades.com/");

$payload = new Payload(
    "query {
        continents(filter: {}) {
          code,
          name
        }
      }"
);

$response = $cli->makeRequest($payload);

echo var_dump($response->getData());