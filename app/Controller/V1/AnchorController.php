<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: shuyu
 * Date: 2019/10/24
 * Time: 13:40
 */

namespace App\Controller\V1;


use App\Controller\Controller;
use App\Request\AnchorRequest;
use App\Service\AnchorService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Request;



class AnchorController extends Controller
{
    /**
     * @Inject
     * @var AnchorService
     */
    protected $anchorService;

    public function  anchorList(Request $request){
        $offset = (int) $request->input('offset');
        $limit = (int) $request->input('limit');
        $result = $this->anchorService->search($offset, $limit);

        return $this->response->success($result);
    }

    public function addAnchor(AnchorRequest $request){
        $allowed_extensions = ["png", "jpg", "gif"];
        $data = $request->post();
        $file = $request->file('head_images');
        $fileCover = $request->file('cover_image');
        $filePath = '/uploads/'.date('Y-m-d',time());
        $destinationPath = BASE_PATH.$filePath;
        if(!file_exists($destinationPath)){
            mkdir($destinationPath,0777,true);
        }
        if($file->isValid()){
            $extension = $file->getExtension();
            if(!in_array($extension,$allowed_extensions)){
                return $this->response->fail('201');
            }
            $fileName = date('YmdHis').mt_rand(100,999).'.'.$extension;   // 重命名
            $file->moveTo($destinationPath.'/'.$fileName);
            if ($file->isMoved()) {
                $data['head_images'] = $filePath.'/'.$fileName;
            }
        }
        foreach ($fileCover as $key => $val) {

            $extension = $val->getExtension();
            if(!in_array($extension,$allowed_extensions)){
                return $this->response->fail('201');
            }
            $fileName = date('YmdHis').mt_rand(100,999).'.'.$extension;   // 重命名
            $val->moveTo($destinationPath.'/'.$fileName);
            if ($val->isMoved()) {
                $cover_image[$key] = $filePath.'/'.$fileName;
            }
        }
        $data['cover_image'] = implode(",", $cover_image);
        $result = $this->anchorService->save($data);
        return $this->response->success($result);
    }
}