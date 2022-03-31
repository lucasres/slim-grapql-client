<?php

declare(strict_types=1);

namespace SlimGraphql;

use Exception;
use Throwable;

class GraphqlException extends Exception
{
    private array $errors;

    public function __construct(
        array $response,
        int $code = 400,
        ?Throwable $previous = null
    ) {
        if (!isset($response['errors'])) {
            throw new Exception("Cannot create error response because server dont return errors");
        }

        foreach ($response['errors'] as $responseError) {
            $error = new ErrorGraphql(
                $responseError['message']
            );

            $this->errors[] = $error;
        }

        parent::__construct("Request returns with error", $code, $previous);
    }

    /**
     * @return ErrorGraphql[]
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
