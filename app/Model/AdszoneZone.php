<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: shuyu
 * Date: 2019/10/24
 * Time: 13:48
 */

namespace App\Model;


class AdszoneZone extends Model
{

    public function adsZone()
    {
        return $this->hasMany(AdszoneAds::class, 'zone_id', 'id');
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'adszone_zone';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name', 'mark', 'type', 'width','height','weigh','createtime','updatetime', 'code'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id', 'name', 'mark', 'type', 'width','height','weigh','createtime','updatetime', 'code'];
}