<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\model\AdminModel;
use think\Session;
class Admin extends Base
{

    protected $adminModel;

    public function __construct(AdminModel $admin) {
        parent::__construct();
        $this->adminModel = $admin;

    }

    public function index()
    {
        $lists=$this->adminModel->getAdmins();
        return view("",compact('lists'));
    }

    public function add()
    {
        if($_POST){
            $res=$this->adminModel->add(request());
            if($res['flag'])
                $this->success($res['msg'],'Admin/index');
            $this->error($res['msg']);
        }
        return view();
    }

    public function edit()
    {
        if($_POST){
            $res=$this->adminModel->edit(request());
            if($res['flag'])
                $this->success($res['msg'],'Admin/index');
            $this->error($res['msg']);
        }
        $id=$_GET['id'];
        $list=AdminModel::find($id);
        return view("",compact('list'));
    }

    public function del()
    {
        $id=$_GET['id'];
        $res=$this->adminModel->del($id);
        if($res)
            $this->success("删除成功");
        $this->error("删除失败");
    }

}