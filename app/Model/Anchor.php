<?php
/**
 * Created by PhpStorm.
 * User: shuyu
 * Date: 2019/10/25
 * Time: 11:11
 */

namespace App\Model;


class Anchor extends Model
{

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
    protected $fillable = ['id', 'name', 'wechat', 'head_images', 'openid', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'gender' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}