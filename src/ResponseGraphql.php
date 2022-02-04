<?php

declare(strict_types=1);

namespace SlimGraphql;

use Exception;

class ResponseGraphql {

    /**
     * @var array
     */
    private $data = [];

    public function __construct(
        array $data
    )
    {
        $this->data = $data;
    }

    public static function create(array $response): ResponseGraphql
    {
        if (! isset($response['data'])) {
            throw new Exception('The server dont return data field');
        }
        
        return new ResponseGraphql(
            $response['data']
        );
    }
}