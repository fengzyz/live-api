<?php
/**
 * Created by PhpStorm.
 * User: shuyu
 * Date: 2019/10/28
 * Time: 15:22
 */

namespace App\Helper;

class FileUtils
{
    public function FileUpload($file, $is_up = 0){

        $data = '';
        $allowed_extensions = ["png", "jpg", "gif"];
        $filePath = '/uploads/'.date('Y-m-d',time());
        $destinationPath = BASE_PATH.$filePath;
        if(!file_exists($destinationPath)){
            mkdir($destinationPath,0777,true);
        }
        if($is_up){
            foreach ($file as $key => $val) {
                $extension = $file->getExtension();
                if(!in_array($extension,$allowed_extensions)){
                    return $this->response->fail('201');
                }
                $fileName = date('YmdHis').mt_rand(100,999).'.'.$extension;   // 重命名
                $val->moveTo($destinationPath.'/'.$fileName);
                if ($val->isMoved()) {
                    $cover_image[$key] = $filePath.'/'.$fileName;
                }
            }
            $data = $cover_image;
        }else{
            if($file->isValid()){
                $extension = $file->getExtension();
                if(!in_array($extension,$allowed_extensions)){
                    return $this->response->fail('201');
                }
                $fileName = date('YmdHis').mt_rand(100,999).'.'.$extension;   // 重命名
                $file->moveTo($destinationPath.'/'.$fileName);
                if ($file->isMoved()) {
                    $data = $filePath.'/'.$fileName;
                }
            }
        }
        return $data;
    }
}