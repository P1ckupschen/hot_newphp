<?php
declare (strict_types = 1);

namespace app\controller\admin;

use app\BaseController;
use app\Request;
use think\facade\Db;
use function Sodium\add;

class Hardware extends BaseController
{
    /**
     *                  设备中心表获得列表数据
     */
    public function geteqmentlist(){
//        dump($this->request->header("Authorization"));

        $list =  Db::table('sys_equipment')->select();
        $result = [];
        $result['sh']='';
        return json($list);
    }
    /**
     *                  产品页面获得分类标签
     */
    public function getcategorylist(){

        $categorylist= Db::table('sys_category')->json(['categorypic'])->select();

        return json($categorylist);

    }
    /**
     *                  产品表获得列表数据  其中实现分页查询 接收pageinfo数据
     */
    public function getproducts(){
//        $pagequery = $this->request->get('pagequery');
//        $categoryid = $pagequery->categoryid;
//        dump($pagequery);
//        dump($categoryid)
        $pageSize = $this->request->get('pageSize');
        $pageNum = $this->request->get('pageNum');
        $categoryid = $this->request->get('categoryid');
        $list = Db::table('sys_product')->where('categoryid',$categoryid)->json(['prd_pic'])->paginate(['list_rows'=> $pageSize, 'page' => $pageNum]);
//        $array = array('["\/dev-api\/storage\/upload\/20230302\\80b311e182578b063158fc48f1de3fcc.png", "\/dev-api\/storage\/upload\/20230302\\0181d3c2e889ecf419703f731a9873a2.png"]');
//        $arrayde =json_decode($array);
//        dump($arrayde);
        return json($list);
    }
    /**
     *                  产品表批量删除
     */
    public function deleteproductsbyids(){
//        $products = request()->param('multipleSelection');
        $products = $this->request->param();
        //拿不到参数
//        $products1 = $this->request->delete('data');
//        $products2 = $this->request->delete('multipleSelection');
        dump($products);
//        dump($products1);
//        dump($products2);
        $ids=[];
        $length = count($products);
        foreach ($products as $item){
            dump($item['prd_id']);
            array_push($ids,$item['prd_id']);
        }
        dump($ids);
        Db::table('sys_product')->where('prd_id','in',$ids)->delete();
    }
    /**
     *                  产品表插入
     */   //新增产品 TODO
//    public function insertproduct(){
////        $product = $this->request->post('productinfo');
////        dump($product);exit();
//        dump($this->request->param());
//
//    }
    /**
     *                  产品表插入 with pic
     */   //新增产品 TODO
    public function insertproductwithpic(){
        $product = $this->request->post('productinfo');
        //把对象中的prd_pic属性里的值都变为json再存放
        dump($product);
        Db::table('sys_product')->json(['prd_pic'])->save($product);


    }
    /**
     *                            产品信息修改            TODO
     */
    public function updateproduct(){
        $columndate = $this->request->put('columndata');
//        exit();
        Db::table('sys_product')->json(['prd_pic'])->update($columndate);
    }
    /**
     *                            图片上传
     */
    public function uploadproductpic(){
        $uploadedFile = $this->request->file('file');
        $savename = \think\facade\Filesystem::disk('public')->putFile( 'upload', $uploadedFile);
        $result= 'storage/'.$savename ;
        return json($result);
    }

    /**
     *                  类型表的删除
     */
    public function deletecategorybyid(){
//        $param = $this->request->delete('categoryid');
        $param = $this->request->param();
        $categoryid = $param['categoryid'];
        Db::table('sys_category')->delete($categoryid);

    }
    /**
     *                  类型表的修改更新
     */
    public function commitupdate(){
//        dump($this->request->put('categoryinfo'));
        $param = $this->request->put();
        Db::table('sys_category')->json(['categorypic'])->update($param);
    }
    /**
     *                  类型表的添加
     */
    public function commitinsert(){
        $param = $this->request->post();
//        dump($param);exit();
        Db::table('sys_category')->json(['categorypic'])->save($param);
    }
    /**
     *                  设备的修改                                       TODO
     */
    public function updateequipment(){
        $eqmentinfo = $this->request->put('eqmentinfo');
//        dump($eqmentinfo);exit();
        Db::table('sys_equipment')->json(['eq_pic'])->update($eqmentinfo);
//        dump($eqmentinfo);exit();
    }
    /**
     *                  设备的删除
     */
    public function deleteequipment(){
        $id = $this->request->delete('equipmentid');
        $param = $this->request->param();
        Db::table('sys_equipment')->where('eq_id',$param['equipmentid'])->delete();
    }
    /**
     *                  设备的插入
     */
    public function insertequipment(){
        $insertinfo = $this->request->post('insertinfo');
//        dump($insertinfo);exit();
        Db::table('sys_equipment')->json(['eq_pic'])->save($insertinfo);
    }

}
