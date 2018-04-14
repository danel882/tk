<?php
namespace app\home\controller;
use \think\View;
use \think\Db;
class Index
{
    public function index()
    {
        return view();
    }

    public function ab()
    {
      $database=Db::connect('db_config1');
      $rs=array();
      $map=array();
      $map['fdetail']=['=',0];
      $map['fitemclassid']=['=',"4"];
      $result = array();
      $result=$database->table('t_Item')->field(['FItemID' =>'id','fparentid'=>'parendid','fname'=>'name'])->where($map)->select();
       return json ($result);
      //echo json_encode($result);
    }

}
