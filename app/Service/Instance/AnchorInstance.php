<?php
/**
 * Created by PhpStorm.
 * User: shuyu
 * Date: 2019/10/29
 * Time: 9:53
 */

namespace App\Service\Instance;
use App\Model\Anchor;
use Hyperf\Utils\Traits\StaticInstance;

class AnchorInstance
{
    use StaticInstance;

    public $models = [];

    public function init(array $ids)
    {
        $ids = array_diff($ids, array_keys($this->models));
        $models = Anchor::findManyFromCache($ids);
        foreach ($models as $model) {
            $this->models[$model->id] = $model;
        }
    }
    public function getModel($id): ? Anchor
    {
        return $this->models[$id] ?? null;
    }
}