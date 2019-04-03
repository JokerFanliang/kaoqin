<?php
namespace app\model;
use think\Model;
use think\Session;
use think\Image;
use think\Db;
use app\model\DailyModel;
use app\model\SumModel;

class DailyModel extends Model
{
    protected $name = 'ribao';
    
    public function getAllByPage(){
        $lists=DailyModel::group('number')->column('id,number,realname,depart,count(*)');
        return $lists;
    }

    public function getCat($cat_id){
        $lists=DailyModel::where(function($query)use($cat_id){
            if($cat_id==1){
                $query->where('write_time','>=',"17:30")->where('write_time','<=',"23:00");
            }elseif($cat_id==2){
                $query->where('write_time','>',"23:00")->whereOr('write_time','<=',"10:00");
            }elseif($cat_id==3){
                $query->where('write_time','>',"10:00")->where('write_time','<',"17:30");
            }
        })->group('number')->column('id,number,realname,depart,count(*)');
        return $lists;
        
    }

    public function getAll(){
        $lists=DailyModel::select();
        return $lists;
    }


    public function getById($id){
    	return $list=DailyModel::find($id);
    }

    public function add($request){
    	$data=$request->post();
        $list=new DailyModel();
        $list->title = $data['title'];
        $list->content = $data['content'];

        if(request()->file('img')){
            $image = Image::open(request()->file('img'));
            $path=$this->saveImg($image);
            $list->img=$path;            
        }
		if($list->save())  	
			return ['flag'=>true,'msg'=>'添加成功'];
		return ['flag'=>false,'msg'=>'添加失败'];
    }

    public function edit($request){
    	$data=$request->post();
        $list=DailyModel::find($data['id']);
        $list->title = $data['title'];
        $list->content = $data['content'];

        if(request()->file('img')){
            $image = Image::open(request()->file('img'));
            $path=$this->saveImg($image);
            $list->img=$path;            
        }
        if($list->save())   
			return ['flag'=>true,'msg'=>'修改成功'];
		return ['flag'=>false,'msg'=>'修改失败'];
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
        $list=DailyModel::find($id);
        //ProductModel::where('user_id',$id)->update(['is_delete'=>1]);
        if($list->delete())
            return true;
        return false;
    }

    public function import($info){

        vendor('PHPExcel.PHPExcel');
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
                    if($key=="A" && trim($cell)==""){
                      break;
                    }
                    $datas[$k][$key] = $cell->getValue(); //获取cell中数据
                }
            }

        }
        $datas=array_values($datas);
        Db::startTrans();
        try {
            foreach($datas as $k=>$v){
                $data['number']=$v['A'];
                $data['realname']=$v['B'];   
                $data['depart']=$v['C'];
                $data['write_date']=$v['D']; 
                $data['write_time']=mb_substr($v['D'], 7);          
                $data['create_time']=date('Y-m-d H:i:s',time());
                $data['update_time']=date('Y-m-d H:i:s',time());
                $res =DailyModel::insert($data);
                
            }
           
            $lists=DailyModel::group('number')->column('id,number,realname,depart,count(*)');
            $sum=[];
            $lists=array_values($lists);

            foreach($lists as $k=>$v){
                $sum['number']=$v['number'];
                $sum['realname']=$v['realname'];   
                $sum['depart']=$v['depart'];
                $sum['all']=$v['count(*)'];   
                $sum['one']='';     
                $sum['two']='';     
                $sum['three']='';            
                $sum['create_time']=date('Y-m-d H:i:s',time());
                $sum['update_time']=date('Y-m-d H:i:s',time());
                $res =SumModel::insert($sum);
            }
            

            Db::commit();
            return true;
        } catch (\Exception $e) {
            Db::rollback();
            return false;
        }
            
    }

    public function export(){
        $data=SumModel::select();
        //dump($data);exit;
        $this->create_excel($data,"周报统计");
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
        $header= ['工号','填写人','部门','填写次数','17:30-23:00','23:00-10:00','10:00-17:30']; //表头,名称可自定义
        $excel->setActiveSheetIndex(0);
        $excel->getActiveSheet()->setTitle('sheet1'); //设置表名
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(18);
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);

     
        $letter = ['A','B','C','D','E','F','G'];//列坐标
     
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
        $data=array_values($data);
        foreach($data as $k=>$v)
        {
            //从第二行开始写入数据（第一行为表头）
            $excel->getActiveSheet()->setCellValue('A'.($k+2),$v->number);
            $excel->getActiveSheet()->setCellValue('B'.($k+2),$v->realname);
            $excel->getActiveSheet()->setCellValue('C'.($k+2),$v->depart);
            $excel->getActiveSheet()->setCellValue('D'.($k+2),$v->all);
            $excel->getActiveSheet()->setCellValue('E'.($k+2),$v->one);
            $excel->getActiveSheet()->setCellValue('F'.($k+2),$v->two);
            $excel->getActiveSheet()->setCellValue('G'.($k+2),$v->three);
           
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
        DailyModel::where('id','>',0)->delete();
        SumModel::where('id','>',0)->delete();
        return true;
    }

    public function sums(){

            // $one=DailyModel::where(function($query)use($cat_id){
            //     if($cat_id==1){
            //         $query->where('write_time','>=',"17:30")->where('write_time','<=',"23:00");
            //     }elseif($cat_id==2){
            //         $query->where('write_time','>',"23:00")->whereOr('write_time','<=',"10:00");
            //     }elseif($cat_id==3){
            //         $query->where('write_time','>',"10:00")->where('write_time','<',"17:30");
            //     }
            // })->group('number')->column('id,number,realname,depart,count(*)');

        $ones=DailyModel::where('write_time','>=',"17:30")->where('write_time','<=',"23:00")->group('number')->column('id,number,count(*)');
        $update_one=[];
        $ones=array_values($ones);
        foreach($ones as $k=>$one){
            SumModel::where('number',$one['number'])->update(['one'=>$one['count(*)']]);
        }

        $twos=DailyModel::where('write_time','>',"23:00")->whereOr('write_time','<=',"10:00")->group('number')->column('id,number,count(*)');
        $update_two=[];
        $twos=array_values($twos);
        foreach($twos as $k=>$two){
            SumModel::where('number',$two['number'])->update(['two'=>$two['count(*)']]);
        }


        $threes=DailyModel::where('write_time','>',"10:00")->where('write_time','<',"17:30")->group('number')->column('id,number,count(*)');
        $update_three=[];
        $threes=array_values($threes);
        foreach($threes as $k=>$three){
            SumModel::where('number',$three['number'])->update(['three'=>$three['count(*)']]);
        }
        return true;
    }
}