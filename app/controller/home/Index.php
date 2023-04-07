<?php
namespace app\controller\home;

use think\facade\View;

class Index
{
    public function index() {
        //todo 数据库的操作
        return View::assign("name", "ddd")->fetch();
    }
    public function test() {
        return $this->fetch('home/index/Index');
    }
}
