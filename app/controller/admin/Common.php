<?php
declare (strict_types = 1);

namespace app\controller\admin;

use app\BaseController;
use think\facade\Filesystem;
use think\Request;

class Common extends BaseController
{
    /**
     *                  统一图片上传
     */
    public function uploadpic(){
        $uploadedFile = $this->request->file();
//        dump($uploadedFile);
        $savename = \think\facade\Filesystem::disk('public')->putFile( 'upload',$uploadedFile['file']);
//        $savename = Filesystem::disk()->putFile( '/storage/upload',$uploadedFile['file']);
//        dump($savename);
        $result= '/storage/'.$savename ;
//        exit();
        //返回地址 前端拼接
        return json($result);
    }
}
