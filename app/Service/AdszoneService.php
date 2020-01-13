<?php
/**
 * Created by PhpStorm.
 * User: shuyu
 * Date: 2019/10/24
 * Time: 13:58
 */

namespace App\Service;
use App\Service\Formatter\AdszoneFormatter;
use App\Service\Dao\AdszoneDao;
use Hyperf\Di\Annotation\Inject;

class AdszoneService extends Service
{

    /**
     * @Inject
     * @var AdszoneDao
     */
    protected $dao;
    public function search($id)
    {
        $adsZone = $this->dao->find($id);
        return $adsZone;
    }
}