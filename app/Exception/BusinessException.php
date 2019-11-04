<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

namespace App\Exception;

use App\Constants\StatusCode;
use Hyperf\Server\Exception\ServerException;
use Throwable;

class BusinessException extends ServerException
{
    protected $statusCode = '';

    protected $httpCode = 0;

    protected $data;

    public function __construct(int $statusCode = 0, string $message = null, $data = null, Throwable $previous = null)
    {
        $this->statusCode = $statusCode;
        $this->httpCode = StatusCode::getHttpCode($this->statusCode);
        if (is_null($message)) {
            $message = StatusCode::getMessage($this->statusCode);
        }
        $this->data = $data;

        parent::__construct($message, $this->httpCode, $previous);
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function getHttpCode()
    {
        return $this->httpCode;
    }

    public function getData()
    {
        return $this->data;
    }
}
