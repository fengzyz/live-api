<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: shuyu
 * Date: 2019/10/25
 * Time: 11:53
 */

namespace App\Service;
use App\Model\Anchor;
use App\Service\Dao\AnchorDao;
use App\Service\Formatter\AnchorFormatter;
use Hyperf\Di\Annotation\Inject;


class AnchorService extends Service
{
    /**
     * @Inject
     * @var AnchorDao
     */
    protected $dao;
    public function search($offset = 0, $limit = 10){
        $anchorDao = $this->dao->find($offset, $limit);
        return $anchorDao;
    }
    /**
     * 添加主播
     */
    public function save($data){
        $anchor = new Anchor();
        $anchor->name = $data['name'];
        $anchor->wechat = $data['wechat'];
        $anchor->head_images = $data['head_images'];
        $anchor->cover_image = $data['cover_image'];
        $anchor->gender = $data['gender'];
        $anchor->mobile_phone = $data['mobile_phone'];
        $anchor->work_desc = $data['work_desc'];
        $anchor->fans_num = $data['fans_num'];
        $anchor->height = $data['height'];
        $anchor->weight = $data['weight'];
        $anchor->platform = $data['platform'];
        $anchor->work_type = $data['work_type'];
        $anchor->work_location = $data['work_location'];
        $anchor->salary_desc = $data['salary_desc'];
        $anchor->user_id = $data['user_id'];
        return $anchor->save();
    }
}