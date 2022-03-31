<?php

declare(strict_types=1);

namespace SlimGraphql;

class Locations {

    private int $line;
    private int $column;
    
    public function __construct(
        int $line,
        int $column
    )
    {
        $this->line = $line;
        $this->column = $column;
    }

    public function getLine(): int
    {
        return $this->line;
    }

    public function getColumn(): int
    {
        return $this->column;
    }
}