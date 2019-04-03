<?php
namespace app\model;
use think\Model;
use think\Session;
use think\Image;
use app\model\ProductModel;

class UserModel extends Model
{
    protected $name = 'user';
    
    public function getUsers(){
        $lists=UserModel::where('is_delete',0)->order('create_time','desc')->paginate(15);
        return $lists;
    }

    public function getAllUsers(){
        $lists=UserModel::where('is_delete',0)->select();
        return $lists;
    }



    public function getById($id){
    	return $list=UserModel::where('is_delete',0)->find($id);
    }

    public function add($request){
    	$data=$request->post();
        $user=UserModel::where('realname',$data['realname'])->find();
        if($user)
            return ['flag'=>false,'msg'=>'该姓名已存在，请修改后再添加'];
        $user=new UserModel();
        $user->realname = trim($data['realname']);
        $user->phone = $data['phone'];
        $user->address = $data['address'];
        $user->desc=$data['desc'];
        if(request()->file('img')){
            $image = Image::open(request()->file('img'));
            $path=$this->saveImg($image);
            $user->img=$path;            
        }
		if($user->save())  	
			return ['flag'=>true,'msg'=>'添加成功'];
		return ['flag'=>false,'msg'=>'添加失败'];
    }

    public function edit($request){
    	$data=$request->post();
        $user=UserModel::where('id','<>',$data['id'])->where('realname',$data['realname'])->find();
        if($user)
            return ['flag'=>false,'msg'=>'该姓名已存在，请修改后再添加'];
        $user=UserModel::find($data['id']);
        $user->realname = trim($data['realname']);
        $user->phone = $data['phone'];
        $user->address = $data['address'];
        $user->desc=$data['desc'];
        if(request()->file('img')){
            $image = Image::open(request()->file('img'));
            $path=$this->saveImg($image);
            $user->img=$path;            
        }
		if($user->save())  	
			return ['flag'=>true,'msg'=>'添加成功'];
		return ['flag'=>false,'msg'=>'添加失败'];
    }


    private function saveImg($image){
    	$folder="/uploads/".date("Ymd")."/";
    	$filename=time().rand(1000,9999);
		if (!file_exists(STATIC_PATH.$folder)){
            mkdir (STATIC_PATH.$folder,0777,true);
        }
		$path=$folder.$filename.".".$image->type();
        $image->save(STATIC_PATH.$path);
		return $path;
    }

    public function del($id){
        $user=UserModel::find($id);
        ProductModel::where('user_id',$id)->update(['is_delete'=>1]);
        $user->is_delete=1;
        if($user->save())
            return true;
        return false;
    }
}