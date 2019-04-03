<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Config;
use think\Session;
use app\model\WorkModel;
class Work extends Base
{

    protected $work;
    public function __construct(WorkModel $work) {
        parent::__construct();
        $this->workModel=$work;

    }

    public function index()
    {
        $lists=$this->workModel->getAll();
        return view("",compact('lists'));
    }

    public function sums(){
        $res=$this->workModel->sums();
        if($res)
            $this->success("处理成功");
        $this->error("处理失败");
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

           //获取表单上传的文件
            $month=request()->post();
            $mon=$month['month'];
            $file=request()->file('excel');
            $info = $file->validate(['size' => 500000000, 'ext' => 'xlsx,xls,csv,txt'])->move(ROOT_PATH . 'public' . DS . 'static'.DS.'uploads'.DS.'excel');
            if($info){
                $res= $this->workModel->import($info,$mon);
                if($res){
                    $this->success('导入成功！',"/admin/Work/index");
                }else{
                    $this->error('导入失败，请重新审核数据！');
                }
            }

    }

    public function export(){
        $this->workModel->export();
    }

    public function remove(){
        $this->workModel->remove();
        return $this->redirect('Work/index');
    }

}