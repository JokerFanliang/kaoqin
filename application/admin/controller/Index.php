<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Session;
class Index extends Base
{

    public function index()
    {
        $this->redirect('Admin/index');
    }

    public function loginout()

    {   
        Session::pull('uname');
        $this->redirect('Login/login');
    }


}