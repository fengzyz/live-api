<?php
/**
 * Created by PhpStorm.
 * User: shuyu
 * Date: 2019/11/4
 * Time: 17:27
 */

namespace App\Job;
use Hyperf\AsyncQueue\Job;

class LastTokenJob extends Job
{

    public $params;

    public function __construct($params)
    {
        // 这里最好是普通数据，不要使用携带 IO 的对象，比如 PDO 对象
        $this->params = $params;
    }

    /**
     * Handle the job.
     */
    public function handle()
    {

    }
}