<?php

use SlimGraphql\Payload;
use SlimGraphql\Client;

include_once('../vendor/autoload.php');

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

echo var_dump($response);