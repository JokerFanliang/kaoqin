<?php
use app\model\AdminModel;
use app\model\SystemModel;
use think\Session;
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function getAdminType(){
	return Session::get('admin_type');
}

function getTitle(){
	return Session::get('index_title');
}

function user($param=""){
	if(Session('?user_id')){	
       	$id=Session::get('user_id');
        $user=AdminModel::find($id);
        switch ($param) {
		    case 'id':
		        $res=$user->id;
		        break;
		    case 'username':
		        $res=$user->username;
		        break;
		    default : 
		    	$res=$user;
		    	break;
		}
    }else{
    	$res=null;
    }
    return $res;
}

function getSystem(){
	return $list=SystemModel::find();
}

//清除数组中所有字符串两端空格
function TrimArray($Input){
    if (!is_array($Input))
        return trim($Input);
    return array_map('TrimArray', $Input);
}

function deal($data,$type){
	$arr=explode(" ",trim($data));
	if(count($arr)>=2){
		if($type==0){
			$sec=strtotime($arr[0])-strtotime("08:00");
			if($sec>0){
				$min=$sec/60;
				return "迟到".$min."分钟";
			}else{
				return "正常";
			}
		}elseif($type==1){
			$sec=strtotime($arr[0])-strtotime("08:30");
			if($sec>0){
				$min=$sec/60;
				return "迟到".$min."分钟";
			}else{
				return "正常";
			}
		}elseif($type==2){
			$sec=strtotime($arr[0])-strtotime("09:00");
			if($sec>0){
				$min=$sec/60;
				return "迟到".$min."分钟";
			}else{
				return "正常";
			}
		}
	}else{
		return $data;
	}
}

function dealStart($v){
	$v=explode(" ",$v);
	if($v[1]=="上午"){
		$res=$v[0]." 08:30";
	}else{
		$res=$v[0]." 12:00";
	}
	return $res;
}

function dealEnd($v){
	$v=explode(" ",$v);
	if($v[1]=="上午"){
		$res=$v[0]." 12:00";
	}else{
		$res=$v[0]." 18:00";
	}
	return $res;
}