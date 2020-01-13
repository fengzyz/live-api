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

namespace App\Service;

use App\Constants\ErrorCode;
use App\Exception\BusinessException;
use Hyperf\Snowflake\IdGeneratorInterface;
use App\Kernel\Oauth\WeChatFactory;
use App\Service\Dao\UserDao;
use App\Service\Instance\JwtInstance;
use App\Service\Redis\UserCollection;
use Hyperf\Di\Annotation\Inject;

class UserService extends Service
{
    /**
     * @Inject
     * @var WeChatFactory
     */
    protected $factory;

    /**
     * @Inject
     * @var UserDao
     */
    protected $dao;

    public function login($data,$code)
    {
        $app = $this->factory->create();
        $session = $app->auth->session($code);
        $user = di()->get(UserCollection::class)->getUser($session['openid']);
        if (empty($user)) {
            $user = $this->dao->create($session['openid']);
            $user->uuid = $this->getUuid();
            $user->nickname = $data['nickname'];
            $user->avatar   = $data['avatar'];
            $user->gender   = $data['gender'];
            $user->province = $data['province'];
            $user->language = $data['language'];
            $user->city     = $data['city'];
            $user->country  = $data['country'];
            $token = JwtInstance::instance()->encode($user);
            $user->last_token  = $token;
            $user->last_at  = date('Y-m-d H:i:s',time());
            $user->save();
            return [$token, $user];
        }
        $token = JwtInstance::instance()->encode($user);
        return [$token, $user];
    }

    public function register($code, $encrypted_data, $iv)
    {
        $app = $this->factory->create();

        $session = $app->auth->session($code);

        $userInfo = $app->encryptor->decryptData($session['session_key'], $iv, $encrypted_data);

        $user = $this->dao->create($userInfo);

        $token = JwtInstance::instance()->encode($user);

        return [$token, $user];
    }

    /**
     * 生成唯一ID
     * @return mixed
     */
    private function getUuid()
    {
        //$container = ApplicationContext::getContainer();
        $generator = $this->container->get(IdGeneratorInterface::class);
        return (string)$generator->generate();
    }
}
