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

use Hyperf\HttpServer\Router\Router;
use App\Middleware\CorsMiddleware;

Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\IndexController@index');
// 该 Group 下的所有路由都将应用配置的中间件
Router::addGroup(
    '/v1', function () {
        Router::post('/login', 'App\Controller\V1\UserController@login');
        Router::post('/register', 'App\Controller\V1\UserController@register');
        Router::get('/adszone', 'App\Controller\V1\AdszoneController@indexInit');
        Router::post('/anchor/add', 'App\Controller\V1\AnchorController@addAnchor');
        Router::get('/anchor/list', 'App\Controller\V1\AnchorController@anchorList');
    },
    ['middleware' => [CorsMiddleware::class]])
;

Router::post('/note/{id:\d+}', 'App\Controller\NoteController@save');
Router::get('/note', 'App\Controller\NoteController@index');
Router::post('/note/delete/{id:\d+}', 'App\Controller\NoteController@delete');
