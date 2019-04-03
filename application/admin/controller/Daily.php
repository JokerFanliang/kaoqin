<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Config;
use think\Session;
use app\model\DailyModel;
use app\model\SumModel;
class Daily extends Base
{

    protected $dailyModel;
    protected $sumModel;

    public function __construct(DailyModel $daily,SumModel $sum) {
        parent::__construct();
        $this->dailyModel = $daily;
        $this->sumModel = $sum;

    }

    public function index()
    {
        $lists=$this->sumModel->getAll();
        return view("",compact('lists'));
    }

    public function add()
    {
        if($_POST){
            $res=$this->dailyModel->add(request());
            if($res)
                $this->success("添加成功",'Daily/index');
            $this->error("添加失败",'Daily/index');
        }
        return view("",compact('list'));
    }

    public function edit()
    {
        if($_POST){
            $res=$this->dailyModel->edit(request());
            if($res)
                $this->success("修改成功",'Daily/index');
            $this->error("修改失败",'Daily/index');
        }
        $id=$_GET['id'];
        $list=$this->dailyModel->getById($id);
        return view("",compact('list'));
    }

    public function del()
    {
        $id=$_GET['id'];
        $res=$this->dailyModel->del($id);
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
                $res= $this->dailyModel->import($info);
                if($res){
                    $this->success('导入成功！',"/admin/Daily/index");
                }else{
                    $this->error('导入失败，请重新审核数据！');
                }
            }
        }
    }

    public function export(){
        $this->dailyModel->export();
    }

    public function remove(){
        $this->dailyModel->remove();
        return $this->redirect('Daily/index');
    }

    public function choice(){
        $cat_id=$_GET['cat_id'];
        $lists=$this->dailyModel->getCat($cat_id);
        return view("",compact('lists','cat_id'));
        
    }

    public function exportChoice(){
        $cat_id=$_GET['cat_id'];
        $this->dailyModel->exportChoice($cat_id);       
    }

    public function sums(){
        $this->dailyModel->sums();
        $this->success('统计成功！',"/admin/Daily/index");
    }

}