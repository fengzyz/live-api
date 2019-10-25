<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: shuyu
 * Date: 2019/10/24
 * Time: 13:49
 */

namespace App\Model;



/**
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $imageurl
 * @property
 * @property string $linkurl
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class AdszoneAds extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'adszone_ads';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'title', 'imageurl', 'linkurl', 'target','code','weigh','createtime','updatetime', 'expiretime', 'zone_id','effectime'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id', 'title', 'imageurl', 'linkurl', 'target','code','weigh','createtime','updatetime', 'expiretime', 'zone_id','effectime'];
}