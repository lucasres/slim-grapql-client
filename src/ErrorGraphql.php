<?php

declare(strict_types=1);

namespace SlimGraphql;

class ErrorGraphql {

    private string $message;
    private array $locations;
    private array $code;
    
    public function __construct(
        string $message
    )
    {
        $this->message = $message;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}