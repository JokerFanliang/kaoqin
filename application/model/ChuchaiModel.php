<?php
namespace app\model;
use think\Model;
use think\Session;
use think\Db;

class ChuchaiModel extends Model
{
    protected $name = 'chuchai';
    
    public function getAll(){
        $lists=ChuchaiModel::select();
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
                    if($key=="B" || $key=="I" ||$key=="J" || $key=="R" ||$key=="S"){
                        $valu=$cell->getValue();
                        if (is_object($valu)) {              
                           $valu = $valu->__toString();
                        }
                        $datas[$k][$key] = $valu; //获取cell中数据
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
                $start=dealStart($v['R']);
                $end=dealEnd($v['S']);
                
                $list=WorkModel::where('realname','like','%'.$realname.'%')->find();
                if($list){
                    foreach($days as $key=>$day){
                        if(strpos($start,"08:30") && strtotime($start)<=strtotime($list->mon."-".$key." 08:30")){
                                if(strtotime($end)==strtotime($list->mon."-".$key." 12:00")){
                                    if(strpos($list->$day,"迟到")){
                                        $list->$day=$list->$day." 出差半天";
                                    }else{
                                        $list->$day="出差半天";
                                    }
                                    
                                }elseif(strtotime($end)>=strtotime($list->mon."-".$key." 18:00")){
                                    if(strpos($list->$day,"迟到")){
                                        $list->$day=$list->$day." 出差";
                                    }else{
                                        $list->$day="出差";
                                    }
                                } 
                            
                        }
                        if(strpos($start,"12:00") && strtotime($start)<=strtotime($list->mon."-".$key." 12:00")){
                            // if(strtotime($start)<=strtotime($list->mon."-".$key." 12:00")){
                            //     if(strpos($list->$day,"迟到")){
                            //         $list->$day=$list->$day." 出差半天";
                            //     }else{
                            //         $list->$day="出差半天";
                            //     }
                            // }else{
                                if(strtotime($start)==strtotime($list->mon."-".$key." 12:00")){
                                    if(strpos($list->$day,"迟到")){
                                        $list->$day=$list->$day." 出差半天";
                                    }else{
                                        $list->$day="出差半天";
                                    }
                                }elseif(strtotime($end)==strtotime($list->mon."-".$key." 12:00")){
                                    if(strpos($list->$day,"迟到")){
                                        $list->$day=$list->$day." 出差半天";
                                    }else{
                                        $list->$day="出差半天";
                                    }
                                    
                                }elseif(strtotime($end)>=strtotime($list->mon."-".$key." 18:00")){
                                    if(strpos($list->$day,"迟到")){
                                        $list->$day=$list->$day." 出差";
                                    }else{
                                        $list->$day="出差";
                                    }
                                } 
                            // }

                            
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
            $res =ChuchaiModel::insertAll($leave);
            Db::commit();
            return true;
        } catch (\Exception $e) {
            Db::rollback();
            return false;
        }
            
    }

    public function remove(){
        ChuchaiModel::where('id','>',0)->delete();
        return true;
    }

}