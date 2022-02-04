<?php

declare(strict_types=1);

namespace SlimGraphqlClient;

use Exception;
use SlimGraphql\Payload;
use SlimGraphql\ResponseGraphql;

class Client {
    /**
     * @var string
     */
    private $url;

    /**
     * @var Payload
     */
    private $payload;

    /**
     * @var array
     */
    private $config;

    public function __construct(string $url, Payload $payload, array $config = [])
    {
        $this->url = $url;
        $this->payload = $payload;
        $this->config = $config;
    }

    public function getPayload(): Payload
    {
        return $this->payload;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getConfig(): array
    {
        return $this->config;
    }

    public function makeRequest(array $config = []): ResponseGraphql
    {
        $mergedConfig = $config + $this->getConfig();

        $curl = curl_init();

        curl_setopt_array(
            $curl,
            [
                CURLOPT_URL => $this->getUrl(),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => $mergedConfig['timeout'] ?? 30,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_HTTPHEADER => $mergedConfig['headers'] ?? []
            ]
        );

        $response = curl_exec($curl);
        $error = curl_error($curl);
        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($error) {
            throw new Exception("Graphql request error: {$error}");
        }

        if ($statusCode >= 400) {
            throw new Exception("Graphql request status more than 400");
        }

        return ResponseGraphql::create(
            json_decode($response, true)
        );
    }
}