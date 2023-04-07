<?php
declare (strict_types = 1);

namespace app\controller\admin;

use app\BaseController;
use think\facade\Db;
use think\Request;

class Company extends BaseController
{
    public function getcertificatelist(){
        $dbs = Db::table('sys_certificate')->json(['certificate_pic'])->select();
        return json($dbs);
    }
    public function  deletecertificate(){
        $param = $this->request->param();
        Db::table('sys_certificate')->where('certificate_id',$param['certificateid'])->delete();
    }
    public function insertcertificate(){
        $insertinfo = $this->request->post('insertinfo');
//        dump($insertinfo);exit();
        Db::table('sys_certificate')->json(['certificate_pic'])->save($insertinfo);
    }
    public function updatecertificate(){
        $updateinfo =$this->request->put('updateinfo');
        Db::table('sys_certificate')->json(['certificate_pic'])->update($updateinfo);
    }
        
}
