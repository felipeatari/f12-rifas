<?php

namespace App\Services;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class Service
{
    protected string $status = 'success';
    protected string $message = '';
    protected int|string $code = 200;

    abstract protected function repository(): mixed;

    protected function exception($exception, string $notFoundMessage = 'Registro não encontrado')
    {
        if ($exception instanceof ModelNotFoundException) {
            $this->status = 'error';
            $this->code = 404;
            $this->message = $notFoundMessage;
        } else {
            $this->status = 'error';
            $this->code = $exception->getCode() ?: 500;
            $this->message = $exception->getMessage();
        }

        return null;
    }

    public function status(): string
    {
        return $this->status;
    }

    public function code(): int|string
    {
        return $this->code;
    }

    public function message(): string
    {
        return $this->message;
    }
}
