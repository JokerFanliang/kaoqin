<?php
namespace app\model;
use think\Model;
use think\Session;
use think\Image;
use app\model\xxModel;

class OuterModel extends Model
{
    protected $name = 'outer';

    public function getAllOuters($data){
        $lists=OuterModel::where(function($query)use($data){
            if(isset($data['com']) && $data['com']){
                $query->where('company','like','%'.$data['com'].'%');
            }
            if(isset($data['local']) && $data['local']){
                $query->where('local',$data['local']);
            }
            if(isset($data['rest']) && $data['rest']!=2){
                $query->where('rest',$data['rest']);
            }
            if(isset($data['realname']) && $data['realname']){
                $query->where('realname',$data['realname']);
            }
        })->select();
        return $lists;
    }

    public function getById($id){
    	return $list=OuterModel::find($id);
    }

    public function add($request){
    	$data=$request->post();
        $user=OuterModel::where('realname',$data['realname'])->find();
        if($user)
            return ['flag'=>false,'msg'=>'该姓名已存在，请修改后再添加'];
        $user=new OuterModel();
        $user->company = trim($data['company']);
        $user->realname = trim($data['realname']);
        $user->job = $data['job'];
        $user->local = $data['local'];
        $user->out_date=$data['out_date'];
        $user->rest=$data['rest'];
        $user->start=$data['start'];
        $user->end=$data['end'];
        $user->remark=$data['remark'];

		if($user->save())  	
			return ['flag'=>true,'msg'=>'添加成功'];
		return ['flag'=>false,'msg'=>'添加失败'];
    }

    public function edit($request){
    	$data=$request->post();
        $user=OuterModel::where('id','<>',$data['id'])->where('realname',$data['realname'])->find();
        if($user)
            return ['flag'=>false,'msg'=>'该姓名已存在，请修改后再添加'];
        $user=OuterModel::find($data['id']);
        $user->company = trim($data['company']);
        $user->realname = trim($data['realname']);
        $user->job = $data['job'];
        $user->local = $data['local'];
        $user->out_date=$data['out_date'];
        $user->rest=$data['rest'];
        $user->start=$data['start'];
        $user->end=$data['end'];
        $user->remark=$data['remark'];
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
        $user=OuterModel::find($id);
        if($user->delete())
            return true;
        return false;
    }
}