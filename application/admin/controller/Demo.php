<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Config;
use think\Session;
use app\model\DemoModel;
class Demo extends Base
{

    protected $demoModel;

    public function __construct(DemoModel $demo) {
        parent::__construct();
        $this->demoModel = $demo;

    }

    public function index()
    {
        $lists=$this->demoModel->getAllByPage();
        return view("",compact('lists'));
    }

    public function add()
    {
        if($_POST){
            $res=$this->demoModel->add(request());
            if($res)
                $this->success("添加成功",'Demo/index');
            $this->error("添加失败",'Demo/index');
        }
        return view("",compact('list'));
    }

    public function edit()
    {
        if($_POST){
            $res=$this->demoModel->edit(request());
            if($res)
                $this->success("修改成功",'Demo/index');
            $this->error("修改失败",'Demo/index');
        }
        $id=$_GET['id'];
        $list=$this->demoModel->getById($id);
        return view("",compact('list'));
    }

    public function del()
    {
        $id=$_GET['id'];
        $res=$this->demoModel->del($id);
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
                $res= $this->demoModel->import($info);
                if($res){
                    $this->success('导入成功！',"/admin/Demo/index");
                }else{
                    $this->error('导入失败，请重新审核数据！');
                }
            }
        }
    }

    public function export(){
        $this->demoModel->export();
    }


}