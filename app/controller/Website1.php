<?php
namespace app\controller;

use app\BaseController;
use think\facade\Db;
use think\facade\Template;
use think\facade\View;

class Website extends BaseController
{
    public function home()
    {
        Db::table('sys_category')->json(['categorypic'])->select()->each(function ($item) {
            return $item;
        });
        $catelist = Db::table('sys_category')->json(['categorypic'])->select();
        if ($catelist!=null) {
            $catelist = $catelist->toArray();
            foreach ($catelist as $key=>$item) {
                if($item['categorypic']!==null) {
                    $item['categorypic'] = array_map(function ($data){
                        $data['url'] = config('app.app_host') .'/public'. str_replace("//","/",str_replace("\\","/",$data['url']));
                        return $data;
                    }, $item['categorypic']);
                }
                $catelist[$key] = $item;
            }
        }
        $certificateList =Db::table('sys_certificate')->json(['certificate_pic'])->select()->each(function ($item){
                if($item['certificate_pic']!==null) {
                    $item['certificate_pic'] = array_map(function ($data){
                        $data['url'] = config('app.app_host') .'/public'. str_replace("//","/",str_replace("\\","/",$data['url']));
                        return $data;
                    }, $item['certificate_pic']);
                }
                return $item;
        });
        if(count($certificateList)>=4 && $certificateList!==null){
            $toArray = $certificateList->toArray();
            $array_slice = array_slice($toArray, 1, 4);
        }
        View::assign('categorylist',$catelist);
        View::assign('certificateList',$array_slice);
        return View::fetch();
    }

    public function about() {
        return View::fetch();
    }

    public function product() {
        $list = Db::table('sys_category')->select();
        View::assign('series', $list);
        $categoryid = $this->request->get('categoryid');
        if($categoryid ==null){
            $categoryid=$list[0]['categoryid'];
        }

        $result = Db::table('sys_product')->where('categoryid', $categoryid)->json(['prd_pic'])->select();
//        dump($result);
        if ($result!=null) {
            $result = $result->toArray();
            foreach ($result as $key=>$item) {
                if($item['prd_pic']!==null) {
                    $item['prd_pic'] = array_map(function ($data){
                        $data['url'] = config('app.app_host').'/public'.str_replace("//","/",str_replace("\\","/",$data['url']));
                        return $data;
                    }, $item['prd_pic']);
                }
                $result[$key] = $item;
            }
        }
        //返回数据的时候把url改了 去掉/dev-api/
        View::assign('products',$result);
        View::assign('currentTag', $this->request->get('tag'));
        return View::fetch();
    }

    public function equipment() {
        $equipmentList=Db::table('sys_equipment')->json(['eq_pic'])->select()->each(function ($item){
            if($item['eq_pic']!==null){
                $item['eq_pic'] = array_map(function ($data){
                    $data['url'] = config('app.app_host').'/public'.str_replace("//","/",str_replace("\\","/",$data['url']));
                    return $data;
                },$item['eq_pic']);
            }
            return $item;
        });
        View::assign('equipmentList',$equipmentList);
        View::assign('equipmentListOne',$equipmentList[0]['eq_pic']);
        View::assign('equipmentListTwo',$equipmentList[1]['eq_pic']);
        View::assign('equipmentListThree',$equipmentList[2]['eq_pic']);
        return View::fetch();
    }

    public function certs() {
        $certificateList = Db::table('sys_certificate')->json(['certificate_pic'])->select()->map(function ($item){
           if($item['certificate_pic']!==null){
               $item['certificate_pic'] =array_map(function($data){
                   $data['url'] =  config('app.app_host').'/public'.str_replace("//","/",str_replace("\\","/",$data['url']));
                   return $data;
               },$item['certificate_pic']);
           }
           return $item;
        });
        View::assign('certificateList',$certificateList);
        return View::fetch();
    }

    public function contact() {
        return View::fetch();
    }
}

