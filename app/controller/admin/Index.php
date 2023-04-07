<?php
namespace app\controller\admin;

use app\BaseController;
use thans\jwt\facade\JWTAuth;
use think\facade\Db;


class Index extends BaseController
{
    public function index()
    {
        $result = ["name"=>"test"];
        return json($result);
//        return '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:) </h1><p> ThinkPHP V' . \think\facade\App::version() . '<br/><span style="font-size:30px;">16载初心不改 - 你值得信赖的PHP框架</span></p><span style="font-size:25px;">[ V6.0 版本由 <a href="https://www.yisu.com/" target="yisu">亿速云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><think id="ee9b1aa918103c4fc"></think>';
    }
    public function hello($name = 'ThinkPHP6')
    {
        return 'hello,' . $name;
    }
    //用户登录：查询数据库内是否存在 用户名密码是否正确
    public function login(){
        //密码加密
        //password_hash('密码',PASSWORD_BCRYPT);
        $password=$this->request->post('password');
        $username=$this->request->post('username');
//        dump($username);exit();
        $ps = Db::table('sys_user')->where('username',$username)->value('password');
        $id = Db::table('sys_user')->where('username',$username)->value('id');
        if(password_verify($password,$ps)){
            //登录成功跳转页面 并且生成token 返回
            $token =JWTAuth::builder(['userid'=>$id]);
            return json(['token'=>$token]);
        }else{
//            dump('用户名或密码错误');
//            返回用户名或密码错误
            return json(['code'=>'201','msg'=>'用户名密码错误请重试']);
        }
    }
    //用户注销：注销用户信息
    public function logout(){
        //remove 前端携带的token
        //前端注销也可
    }
    public function userinfo(){
        $token = $this->request->get('token');
        $tokenpayload = JWTAuth::getPayload();
        $tokenid =$tokenpayload['userid']->getValue();
        $user = Db::table('sys_user')->where('id',$tokenid)->find();
        return json($user);
    }


}
