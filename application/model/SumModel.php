<?php
namespace app\model;
use think\Model;
use think\Session;

class SumModel extends Model
{
    protected $name = 'sum';
    
    public function getAll(){
        $lists=SumModel::select();
        return $lists;
    }

}