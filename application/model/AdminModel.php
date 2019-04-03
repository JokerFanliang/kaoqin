<?php
namespace app\model;
use think\Model;
use think\Session;

class AdminModel extends Model
{
    protected $name = 'admin';
    
    public function getAdmins(){
    	$type=Session::get('admin_type');
    	$lists=AdminModel::where(function($query)use($type){
            if($type==1){
				$query->where('id',Session::get('user_id'));
            }
        })->order('create_time','desc')->paginate(10);
        return $lists;
    }

    public function add($request){
    	$data=$request->post();
        $user=AdminModel::where('username',$data['user_name'])->find();
        if($user)
            return ['flag'=>false,'msg'=>'该用户名已存在'];
        $user=new AdminModel();
        $user->username = trim($data['user_name']);
        $user->password = md5(trim($data['password']));
        $user->types = 1;
		if($user->save())  	
			return ['flag'=>true,'msg'=>'添加成功'];
		return ['flag'=>false,'msg'=>'添加失败'];
    }

    public function edit($request){
    	$data=request()->post();
        $user_id=$data['id'];
        $user=AdminModel::where('id','<>',$user_id)->where('username',$data['username'])->find();
        if($user)
			return ['flag'=>false,'msg'=>'该用户名已存在'];
		$user=AdminModel::find($user_id);
		$user->username=trim($data['username']);
		if($data['password'])
			$user->password=trim($data['password']);
		if($user->save())  	
			return ['flag'=>true,'msg'=>'修改成功'];
		return ['flag'=>false,'msg'=>'修改失败'];
    }

    public function del($id){
    	$list=AdminModel::find($id);
    	if($list->delete())
    		return true;
    	return false;
    }
}