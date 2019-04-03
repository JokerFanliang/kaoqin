<?php
namespace app\admin\controller;
use think\Controller;
class Base extends Controller
{
    public function __construct()
    {
       parent::__construct();

       if(!session('?user_id'))
       {
          $this->error('您还没有登录，先去登录吧','admin/Login/login');
       }


    }

}
