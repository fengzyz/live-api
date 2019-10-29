<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: shuyu
 * Date: 2019/10/25
 * Time: 11:53
 */

namespace App\Service\Dao;
use App\Model\Anchor;
use App\Service\Service;

class AnchorDao extends Service
{

    /**
     * 查询主播列表
     * @param int $offset
     * @param int $limit
     * @return \Hyperf\Database\Model\Builder[]|\Hyperf\Database\Model\Collection
     */
    public function find($offset = 0, $limit = 10)
    {
        $anchor = Anchor::query();
        $anchor->where('check_status', Anchor::CHECK_STATUS);
        return $anchor->orderBy('id', 'desc')->offset($offset)->limit($limit)->get();
    }
}