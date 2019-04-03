<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Config;
use think\Session;
use app\model\OuterModel;
class Outer extends Base
{
    public function __construct(OuterModel $outer) {
        parent::__construct();
        $this->outerModel=$outer;

    }

    public function index()
    {
        $data=request()->get();
        $lists=$this->outerModel->getAllOuters($data);
        $count=count($lists);
        return view("",compact('lists','count'));
    }

    public function add()
    {
        if($_POST){
            $res=$this->outerModel->add(request());
            if($res)
                $this->success("添加成功",'Outer/index');
            $this->error("添加失败",'Outer/index');
        }
        return view("",compact('list'));
    }

    public function edit()
    {
        if($_POST){
            $res=$this->outerModel->edit(request());
            if($res)
                $this->success("修改成功",'Outer/index');
            $this->error("修改失败",'Outer/index');
        }
        $id=$_GET['id'];
        $list=$this->outerModel->getById($id);
        return view("",compact('list'));
    }

    public function del()
    {
        $id=$_GET['id'];
        $res=$this->outerModel->del($id);
        if($res)
            $this->success("删除成功");
        $this->error("删除失败");
    }

    public function import(){
        if($_POST){
           //获取表单上传的文件
            $file=request()->file('excel');
            $info = $file->validate(['size' => 500000000, 'ext' => 'xlsx,xls,csv,txt'])->move(ROOT_PATH . 'public' . DS . 'static'.DS.'uploads'.DS.'excel');
            if($info){
                $res= $this->outerModel->import($info);
                if($res){
                    $this->success('导入成功！',"/admin/Outer/index");
                }else{
                    $this->error('导入失败，请重新审核数据！');
                }
            }
        }
    }

    public function export(){
        $this->outerModel->export();
    }

    public function remove(){
        $this->outerModel->remove();
        return $this->redirect('Outer/index');
    }

    public function choice(){
        $cat_id=$_GET['cat_id'];
        $lists=$this->outerModel->getCat($cat_id);
        return view("",compact('lists','cat_id'));
        
    }

    public function exportChoice(){
        $cat_id=$_GET['cat_id'];
        $this->outerModel->exportChoice($cat_id);       
    }

    public function sums(){
        $this->outerModel->sums();
        $this->success('统计成功！',"/admin/Outer/index");
    }

}