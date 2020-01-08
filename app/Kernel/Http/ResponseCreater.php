<?php

declare(strict_types=1);

namespace App\Kernel\Http;

use App\Constants\StatusCode;

use Hyperf\Di\Annotation\AbstractAnnotation;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\HttpServer\Response;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

class ResponseCreater extends AbstractAnnotation
{
    /**
     * @param ResponseInterface|PsrResponseInterface $response
     * @param string|null $statusCode
     * @param string|null $message
     * @param $data
     * @return PsrResponseInterface
     */
    public function create($response, ?string $statusCode, ?string $message, $data): PsrResponseInterface
    {

        $result = new ResponseJson([
            'code' => StatusCode::getHttpCode($statusCode),
            'message' => $message,
            'data' => $data
        ]);

        if (!$response instanceof ResponseInterface) {
            $response = new Response($response);
        }

        //调用队列 记录日志
        //$params['url'] = $request->getRequestUri();
        //$params['requestData'] = $request->all();
        $params['responseData'] = ['code' => StatusCode::getHttpCode($statusCode), 'message' => $message, 'data' => $data];

        //$this->queueService->push($params, 1, 0);

        return $response->withStatus(StatusCode::getHttpCode($statusCode))->json($result);
    }

    /**
     * @param ResponseInterface|PsrResponseInterface $response
     * @param $data
     * @param string|null $message
     * @return PsrResponseInterface
     */
    public  function success($response, $data, ?string $message = null): PsrResponseInterface
    {
        $statusCode = StatusCode::Success;
        $message = $message ?? StatusCode::getMessage(StatusCode::Success);
        return $this->create($response, $statusCode, $message, $data);
    }

    /**
     * @param ResponseInterface|PsrResponseInterface $response
     * @param string $statusCode
     * @param string|null $message
     * @param null $data
     * @return PsrResponseInterface
     */
    public  function error($response, string $statusCode, ?string $message = null, $data = null): PsrResponseInterface
    {
        $message = $message ?? StatusCode::getMessage($statusCode);

        return $this->create($response, $statusCode, $message, $data);
    }
}
