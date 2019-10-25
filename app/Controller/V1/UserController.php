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

namespace App\Controller\V1;

use App\Controller\Controller;
use App\Request\LoginRequest;
use App\Request\RegisterRequest;
use App\Service\Formatter\UserFormatter;
use App\Service\UserService;
use Hyperf\Di\Annotation\Inject;

class UserController extends Controller
{
    /**
     * @Inject
     * @var UserService
     */
    protected $userService;

    /**
     * 用户登录
     * @param LoginRequest $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function login(LoginRequest $request)
    {
        $code = (string) $request->input('code');

        [$token, $user] = $this->userService->login($code);

        return $this->response->success([
            'token' => $token,
            'userInfo' => UserFormatter::instance()->base($user),
        ]);
    }

    /**
     * 授权注册
     * @param RegisterRequest $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function register(RegisterRequest $request)
    {
        $code = (string) $request->input('code');
        $encryptedData = (string) $request->input('encrypted_data');
        $iv = (string) $request->input('iv');

        [$token, $user] = $this->userService->register($code, $encryptedData, $iv);

        return $this->response->success([
            'token' => $token,
            'userInfo' => UserFormatter::instance()->base($user),
        ]);
    }
}
