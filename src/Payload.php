<?php

declare(strict_types=1);

namespace SlimGraphql;

class Payload  {

    /**
     * @var string
     */
    private $query;

    /**
     * @var array
     */
    private $variables;

    public function __construct(string $query, array $variables = [])
    {
        $this->query = $query;
        $this->variables = $variables;
    }

    public function getQuery(): string
    {
        return $this->query;
    }

    public function getVariables(): array
    {
        return $this->variables;
    }

    public function serializeVariables(): string
    {
        return http_build_query($this->getVariables());
    }

    public function serialize(): string
    {
        return json_encode([
            'query'     => $this->getQuery(),
            'variables' => $this->getVariables(),    
        ]);
    }
}