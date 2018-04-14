<?php
namespace app\excel\controller;
use think\Controller;
use \think\View;
use \think\Db;
use think\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use app\excel\model\User;
class Index extends Controller
{
  public function index()
  {
      return view();
  }

  public function ab()
  {
    $offset = input("offset");
    $limit = input("limit");
    $ordername = input("ordername", "id");//input("?post.ordername")? input("ordername"): 'fcreatedate';
    $order = input("order", "asc");
    if (!$ordername) {
      $ordername = 'date';
      $order = 'desc';
              };
    if (!$offset) {
      $offset=0;
                  };
    if (!$limit) {
    $limit=10;
                  };
    $order1="$ordername $order";
    $result["total"] =Db::table('demo')->count();
    $result["rows"] = Db::table('demo')->limit($offset,$limit)->order($order1)->select();
    return json ($result);
  }

  public function upload(){
   // 获取表单上传文件 例如上传了001.jpg
   $file = request()->file('image');
   if (empty($file)) {
     $this->error('请选择上传文件');
                     }
   // 移动到框架应用根目录/public/uploads/ 目录下
   if($file){
       $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
       if($info){
              //$FilePath = $file->rootPath;
              $filename=$info->getSaveName();
              $filename='public'. DS .'uploads'. DS .$filename;
              $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xls');
              $spreadsheet = $reader->load($filename);

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

                                                      }
            $this->success('上传成功');
              //$this->success('上传成功');
               //echo $info->getFilename();
       }else{
           // 上传失败获取错误信息
           echo $file->getError();
       }
   }
                         }




} // class end
