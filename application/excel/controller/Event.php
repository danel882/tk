<?php
namespace app\excel\controller;
use \think\View;
use \think\Db;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use app\excel\model\User;
class Event
{
    public function event()  //模板渲染
    {

             // $inputFileName = 'public/1.xls';
             // $spreadsheet = IOFactory::load($inputFileName);
             // $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
             //
             // $sheet = $spreadsheet->getSheet(0);//// 读取第一個工作表
             // $highestRow = $sheet->getHighestRow();           //取得总行数
             // $highestColumn = $sheet->getHighestColumn(); //取得总列数
             // var_dump($highestColumn);
             // for($j=2;$j<=$highestRow;$j++){
             //     $str="";
             //     for($k='A';$k<=$highestColumn;$k++)            //从A列读取数据
             //     {
             //         $str .=$objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue().'|*|';//读取单元格
             //     }
             //     $str=mb_convert_encoding($str,'utf-8','auto');//根据自己编码修改
             //     $strs = explode("|*|",$str);
             //     $user=new User;
             //     $user->file=$strs[3];
             //     $result=$user->save();
             $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xls');
             //$reader->setReadDataOnly(TRUE);
             $spreadsheet = $reader->load("public/1.xls");

             $worksheet = $spreadsheet->getActiveSheet();
             // Get the highest row and column numbers referenced in the worksheet
             $highestRow = $worksheet->getHighestRow(); // e.g. 10
             $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
             $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn); // e.g. 5
             $user=new User;
             $user->where('1=1')->delete();

             // echo '<table>' . "\n";
             for ($row = 2; $row <= $highestRow; ++$row) {
                 $str="";
                 for ($col = 1; $col <= $highestColumnIndex; ++$col) {
                      $str .=$worksheet->getCellByColumnAndRow($col, $row)->getFormattedValue().'|*|';

                                                                      }
                 $str=mb_convert_encoding($str,'utf-8','auto');//根据自己编码修改
                 $strs = explode("|*|",$str);
                 //print_r ($str);
                 $user=new User;
                 $user->id=$strs[0];
                 $user->text=$strs[1];
                 $user->file=$strs[2];
                 $user->project=$strs[3];
                 $user->department=$strs[7];
                 $user->date=$strs[10];
                 $result=$user->save();
                  //根据自己编码修改
                                                            }

             }





} // class end
