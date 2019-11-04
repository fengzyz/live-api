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

use Hyperf\Contract\StdoutLoggerInterface;

use Psr\Container\ContainerInterface;

abstract class Service
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var StdoutLoggerInterface
     */
    protected $logger;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->logger = $container->get(StdoutLoggerInterface::class);
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
