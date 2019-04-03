<?php
namespace app\model;
use think\Model;
use think\Session;
use think\Db;

class WaiqinModel extends Model
{
    protected $name = 'waiqin';
    
    public function getAll(){
        $lists=WaiqinModel::select();
        return $lists;
    }

    public function import($info){
        vendor('PHPExcel.PHPExcel');
        $days=['01'=>'a','02'=>'b','03'=>'c','04'=>'d','05'=>'e','06'=>'f','07'=>'g','08'=>'h',
            '09'=>'i','10'=>'j','11'=>'k','12'=>'l','13'=>'m','14'=>'n','15'=>'o','16'=>'p',
            '17'=>'q','18'=>'r','19'=>'s','20'=>'t','21'=>'u','22'=>'v','23'=>'w','24'=>'x',
            '25'=>'y','26'=>'z','27'=>'aa','28'=>'ab','29'=>'ac','30'=>'ad','31'=>'ae'
        ];
        $file_name = ROOT_PATH . 'public' . DS . 'static'.DS.'uploads'.DS.'excel' . DS . $info->getSaveName();
        $objPHPExcelReader = \PHPExcel_IOFactory::load($file_name);
          //加载excel文件
        $datas=[];
        foreach($objPHPExcelReader->getWorksheetIterator() as $sheet) //循环读取sheet
        { 
            foreach($sheet->getRowIterator() as $k=>$row) //逐行处理
            {     
                if($row->getRowIndex()<2) //确定从哪一行开始读取
                {
                    continue;
                }
                foreach($row->getCellIterator() as $key=>$cell) //逐列读取
                {
                    // if($key=="A" && trim($cell)==""){
                    //   break;
                    // }
                    if($key=="B" || $key=="I" ||$key=="J" ||$key=="P" ||$key=="Q"){
                        $datas[$k][$key] = $cell->getValue(); //获取cell中数据
                    }
                    
                }
            }

        }
        $datas=array_values($datas);   
        //dump($datas);exit; 
        Db::startTrans();
        try {
            $leave=[];
            foreach($datas as $k=>$v){
                
                $realname=$v['I'];

                
                $list=WorkModel::where('realname','like','%'.$realname.'%')->find();
                if($list){
                    foreach($days as $key=>$day){
                        if(strtotime($v['P'])<=strtotime($list->mon."-".$key) && strtotime($list->mon."-".$key)<=strtotime($v['Q'])){
                        $list->$day="调休";
                        }
                    }
                    $list->save();
                }else{
                    $leave[$k]['title']=$v['B'];
                    $leave[$k]['realname']=$v['I'];
                    $leave[$k]['depart']=$v['J'];
                    $leave[$k]['start']=$v['P'];
                    $leave[$k]['end']=$v['Q'];
                    $leave[$k]['create_time']=date('Y-m-d H:i:s',time());
                    $leave[$k]['update_time']=date('Y-m-d H:i:s',time());

                }

                
            }
            $leave=array_values($leave);
            //dump($leave);exit;
            $res =WaiqinModel::insertAll($leave);
            Db::commit();
            return true;
        } catch (\Exception $e) {
            Db::rollback();
            return false;
        }
            
    }

    public function remove(){
        WaiqinModel::where('id','>',0)->delete();
        return true;
    }

}