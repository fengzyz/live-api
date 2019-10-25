<?php
/**
 * Created by PhpStorm.
 * User: shuyu
 * Date: 2019/10/24
 * Time: 14:30
 */

namespace App\Controller\V1;


use App\Controller\Controller;
use App\Service\AdszoneService;
use Hyperf\Di\Annotation\Inject;


class AdszoneController extends Controller
{
    /**
     * @Inject
     * @var AdszoneService
     */
    protected $adszoneService;

    public function indexInit(){
        $headerAdsList = $this->adszoneService->search(1);
        $matrixAdsList = $this->adszoneService->search(5);
        $data = [
            'headerAdsList' => $headerAdsList,
            'matrixAdsList' => $matrixAdsList
        ];
        return $this->response->success($data,'请求数据成功！');
    }
}