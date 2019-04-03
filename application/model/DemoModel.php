<?php
namespace app\model;
use think\Model;
use think\Session;
use think\Image;
use think\Db;
use app\model\DemoModel;

class DemoModel extends Model
{
    protected $name = 'demo';
    
    public function getAllByPage(){
        $lists=DemoModel::order('create_time','desc')->paginate(15);
        return $lists;
    }

    public function getAll(){
        $lists=DemoModel::select();
        return $lists;
    }


    public function getById($id){
    	return $list=DemoModel::find($id);
    }

    public function add($request){
    	$data=$request->post();
        $list=new DemoModel();
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
        $list=DemoModel::find($data['id']);
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
        $list=DemoModel::find($id);
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
                    // if($key=="A" && trim($cell)==""){
                    //   break;
                    // }
                    $datas[$k][$key] = $cell->getValue(); //获取cell中数据
                }
            }

        }
dump($datas);exit;
        Db::startTrans();
        try {
            foreach($datas as $k=>$v){
                $data['title']=$v['A'];
                $data['content']=$v['B'];            
                $data['create_time']=date('Y-m-d H:i:s',time());
                $data['update_time']=date('Y-m-d H:i:s',time());
                $res =DemoModel::insert($data);
            }
            Db::commit();
            return true;
        } catch (\Exception $e) {
            Db::rollback();
            return false;
        }
            
    }

    public function export(){
        $data=DemoModel::select();
        $this->create_excel($data,"用户表");
    }

    private function create_excel($data = [],$name = 'excel'){
        vendor('PHPExcel.PHPExcel');
        $excel = new \PHPExcel(); //引用phpexcel
        iconv('UTF-8', 'gb2312', $name); //针对中文名转码
        $header= ['标题','内容']; //表头,名称可自定义
        $excel->setActiveSheetIndex(0);
        $excel->getActiveSheet()->setTitle('sheet1'); //设置表名
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(18);
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(80);
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(25);

     
        $letter = ['A','B'];//列坐标
     
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
        foreach($data as $k=>$v)
        {
            //从第二行开始写入数据（第一行为表头）
            $excel->getActiveSheet()->setCellValue('A'.($k+2),$v->title);
            $excel->getActiveSheet()->setCellValue('B'.($k+2),$v->content);
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
}