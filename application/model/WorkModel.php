<?php
namespace app\model;
use think\Model;
use think\Session;
use think\Image;
use think\Db;
use app\model\OuterModel;

class WorkModel extends Model
{
    protected $name = 'work';
    
    public function getAll(){
        $lists=WorkModel::where('times','<>',"")->select();
        return $lists;
    }


    public function import($info,$mon){
        vendor('PHPExcel.PHPExcel');
        $file_name = ROOT_PATH . 'public' . DS . 'static'.DS.'uploads'.DS.'excel' . DS . $info->getSaveName();
        $objPHPExcelReader = \PHPExcel_IOFactory::load($file_name);
          //加载excel文件
        $datas=[];
        foreach($objPHPExcelReader->getWorksheetIterator() as $sheet) //循环读取sheet
        { 
            foreach($sheet->getRowIterator() as $k=>$row) //逐行处理
            {     
                if($row->getRowIndex()<4) //确定从哪一行开始读取
                {
                    continue;
                }
                foreach($row->getCellIterator() as $key=>$cell) //逐列读取
                {
                    // if($key=="A" && trim($cell)==""){
                    //   break;
                    // }
                    $datas[$k][$key] = $cell->getValue(); //获取cell中数据
                }
            }

        }
        $datas=array_values($datas);    
        // dump($datas);exit;
        $dates=array_filter(array_values($datas[0]));
        Db::startTrans();
        $datas_array=[];
        try {
            $data_array=[];
            foreach($datas as $k=>$v){
                $v=array_values($v);
                if($k>0){
                    if($k%2==1){
                        array_push($data_array,$v[10]);
                    }
                    if($k%2==0){
                        for($i=0;$i<count($dates);$i++){
                            array_push($data_array,$v[$i]);
                        }
                        
                        $datas_array[]=$data_array;
                        $data_array=[];
                    }
                    
                }
                
            }
            
//dump($datas_array);exit;
            $datas_arrays=[];
            $data_arrays=[];
            foreach($datas_array as $ks=>$vs){
                foreach($vs as $k=>$v){
                    if($k>0){
                        //array_push($data_arrays,$vs[0],$v,$dates[$k-1]);
                        $data_arrays=['realname'=>$vs[0],'times'=>$v,'dates'=>$mon.'-'.$dates[$k-1]];
                        $datas_arrays[]=$data_arrays;
                        $data_arrays=[];
                    }
                    
                }
                
            }
            //dump($datas_arrays);exit;
            $result=Db::table('work')->insertAll($datas_arrays);
            Db::commit();
            return true;
        } catch (\Exception $e) {
            Db::rollback();
            return false;
        }
            
    }

    public function export(){
        $data=WorkModel::where('times','<>',"")->select();
        //dump($data);exit;
        $this->create_excel($data,"考勤统计");
    }

    public function exportChoice($cat_id){
        $data=$this->getCat($cat_id);
        //dump($data);exit;
        $name=$cat_id==1 ? "11:00之前提交日报" : ($cat_id==2 ? "23:00-10:00提交日报" :  "10:00之后提交日报"); 
        $this->create_excel($data,$name);

    }

    private function create_excel($data = [],$name = 'excel'){
        vendor('PHPExcel.PHPExcel');
        $excel = new \PHPExcel(); //引用phpexcel
        iconv('UTF-8', 'gb2312', $name); //针对中文名转码
        $header= ['姓名','上班','下班']; //表头,名称可自定义
        $excel->setActiveSheetIndex(0);
        
        $letter = ['A','B','C'];//列坐标
     
        $excel->getActiveSheet()->setTitle('sheet1'); //设置表名
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(30);

        foreach($letter as $k=>$let){
            if($let=="A" || $let=="B" || $let=="C"){
                $excel->getActiveSheet()->getColumnDimension($let)->setWidth(20);
            }else{
                $excel->getActiveSheet()->getColumnDimension($let)->setWidth(10);
            }
            
        }


     
        
        //生成表头
        for($i=0;$i<count($header);$i++)
        {
            //设置表头值
            $excel->getActiveSheet()->setCellValue("$letter[$i]1",$header[$i]);
            //设置表头字体样式
            $excel->getActiveSheet()->getStyle("$letter[$i]1")->getFont()->setName('宋体');
            //设置表头字体大小
            $excel->getActiveSheet()->getStyle("$letter[$i]1")->getFont()->setSize(14);
            //设置表头字体是否加粗
            $excel->getActiveSheet()->getStyle("$letter[$i]1")->getFont()->setBold(true);
            //设置表头文字水平居中
            $excel->getActiveSheet()->getStyle("$letter[$i]1")->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            //设置文字上下居中
            $excel->getActiveSheet()->getStyle($letter[$i])->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
            //设置单元格背景色
            $excel->getActiveSheet()->getStyle("$letter[$i]1")->getFill()->getStartColor()->setARGB('FFFFFFFF');
            $excel->getActiveSheet()->getStyle("$letter[$i]1")->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
            $excel->getActiveSheet()->getStyle("$letter[$i]1")->getFill()->getStartColor()->setARGB('FF6DBA43');
            //设置字体颜色
            $excel->getActiveSheet()->getStyle("$letter[$i]1")->getFont()->getColor()->setARGB('FFFFFFFF');
        }
        //写入数据
        //$arrays=['A'=>'realname','B'=>'depart','C'=>'sum'];
        $data=array_values($data);
        foreach($data as $k=>$v)
        {
            //从第二行开始写入数据（第一行为表头）
            $excel->getActiveSheet()->setCellValue('A'.($k+2),$v->realname);
            $excel->getActiveSheet()->setCellValue('B'.($k+2),$v->start);
            $excel->getActiveSheet()->setCellValue('C'.($k+2),$v->end);
           
        }
        //设置单元格边框
        $excel->getActiveSheet()->getStyle("A1:C".(count($data)+1))->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
        
        //清理缓冲区，避免中文乱码
        ob_end_clean();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$name.'.xls"');
        header('Cache-Control: max-age=0');
     
        //导出数据
        $res_excel = \PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $res_excel->save('php://output');
    }

    public function remove(){
        WorkModel::where('id','>',0)->delete();
        return true;
    }

    public function sums(){
        $lists=WorkModel::where('times','<>',"")->select();
        foreach($lists as $list){
            $work=WorkModel::where('id',$list->id)->find();
            $times=$work->times;
            $len=strlen($times);
            $dates=$work->dates;
            $work->start=$dates." ".substr($times,0,5).":00.0";
            $work->end=$dates." ".substr($times,-5).":00.0";
            $work->save();

        }
        return true;
    }
}