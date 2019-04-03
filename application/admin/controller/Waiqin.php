<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Config;
use think\Session;
use app\model\WorkModel;
use app\model\WaiqinModel;
class Waiqin extends Base
{

    public function __construct(WorkModel $work,WaiqinModel $waiqin) {
        parent::__construct();
        $this->workModel=$work;
        $this->waiqinModel=$waiqin;

    }

    public function index()
    {
        $lists=$this->waiqinModel->getAll();
        return view("",compact('lists'));
    }


    public function import(){
        if($_POST){
           //获取表单上传的文件
            $file=request()->file('excel');
            $info = $file->validate(['size' => 500000000, 'ext' => 'xlsx,xls,csv,txt'])->move(ROOT_PATH . 'public' . DS . 'static'.DS.'uploads'.DS.'excel');
            if($info){
                $res= $this->waiqinModel->import($info);
                if($res){
                    $this->success('导入成功！',"/admin/Leave/index");
                }else{
                    $this->error('导入失败，请重新审核数据！');
                }
            }
        }
    }

    public function remove(){
        $this->waiqinModel->remove();
        return $this->redirect('Leave/index');
    }
}