<?php
/**
 * Created by PhpStorm.
 * User: shuyu
 * Date: 2019/10/24
 * Time: 15:36
 */

namespace App\Service\Dao;

use App\Model\AdszoneZone;

class AdszoneDao
{

    public function find($id)
    {
        $adsZone = AdszoneZone::with('adsZone')
            ->where('id', $id)
            ->orderBy('id', 'desc')->get();
        return $adsZone;
    }
}