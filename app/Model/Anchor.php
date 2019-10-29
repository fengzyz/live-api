<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: shuyu
 * Date: 2019/10/25
 * Time: 11:11
 */

namespace App\Model;
use Hyperf\Database\Model\SoftDeletes;


/**
 * @property $id
 * @property $name
 * @property $gender
 * @property $created_at
 * @property $updated_at
 */
class Anchor extends Model
{
    use SoftDeletes;

    const CHECK_STATUS = 2;
    protected $dateFormat = 'U';
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'anchor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name', 'wechat', 'head_images', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer',  'created_at' => 'datetime', 'updated_at' => 'datetime'];
}