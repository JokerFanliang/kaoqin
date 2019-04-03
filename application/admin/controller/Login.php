<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Session;
use app\model\UserModel;
use app\model\AdminModel;

class Login extends Controller
{
    public function login(){
        if($_POST)
        {
            $data=$this->request->post();
            $username = $data['username'];
            $password = md5($data['password']);
            $query['username'] = $username;
            $query['password'] = $password;
            $user = AdminModel::where($query)->find();
            if ($user){
                Session::set('admin_type', $user->types);
                Session::set('user_id', $user->id);
                $this->redirect("Index/index","登录成功");
            } else {
                $this->error("用户名或密码错误!",'Login/login');
            }
        }
        return view();
    }


}