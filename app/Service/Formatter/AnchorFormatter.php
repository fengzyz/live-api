<?php
/**
 * Created by PhpStorm.
 * User: shuyu
 * Date: 2019/10/29
 * Time: 9:49
 */

namespace App\Service\Formatter;
use App\Model\Anchor;
use App\Service\Instance\AnchorInstance;

class AnchorFormatter extends Formatter
{
    public function base(Anchor $model)
    {
        return [
            'id' => $model->id,
            'user_id' => $model->user_id,
            'name' => $model->name,
            'created_at' => $model->created_at->toDateTimeString(),
            'update_at' => $model->updated_at->toDateString(),
        ];
    }

    public function formatArray($models)
    {
        $ids = [];
        foreach ($models as $model) {
            $ids[] = $model->user_id;
        }
        $instance = AnchorInstance::instance();
        $instance->init($ids);

        $result = [];
        foreach ($models as $model) {
            $item = self::base($model);
            if ($anchor= $instance->getModel($model->user_id)) {
                $item['user'] = AnchorFormatter::instance()->base($anchor);
            }

            $result[] = $item;
        }

        return $result;
    }
}