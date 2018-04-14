<?php
namespace app\index\controller;
use \think\View;
use \think\Db;
class Index
{
    public function index()
    {
        return view();
    }
    public function welcome()
    {
        return view();
    }
    public function home()
    {
        return view();
    }
    public function welcome1()
    {
        return view();
    }
    public function test()
    {
        return view();
    }
    public function tongji()
    {
        return view();
    }
    public function class()
    {
        return view();
    }
    public function excel()
    {
        return view();
    }
    public function tiao()
    {
        return view();
    }
    public function aa()
       {



       }
       public function ab()            //读取物料数据
          {
            $database=Db::connect('db_config1');
            $offset = input("offset");
            $limit = input("limit");

            $FNumber = input("FNumber", "");//isset($_POST['FNumber']) ? $_POST['FNumber'] : '';
            $FName = input("FName", "");
            $FModel = input("FModel", "");
            $FUnitID=input("FUnitID", "");
            $FCreateDateStime= input("FCreateDateStime", "");//isset($_POST['FCreateDateStime']) ? date('Y-m-d',strtotime($_POST['FCreateDateStime'])): '';


            $FCreateDateEtime= input("FCreateDateEtime", "2037-04-17");///isset($_POST['FCreateDateEtime']) ? date('Y-m-d',strtotime($_POST['FCreateDateEtime'])): '2037-04-17';
            $FCreateDateEtime=date('Y-m-d',strtotime("$FCreateDateEtime +1 day"));
            $search = input("search");

            $ordername = input("ordername", "fcreatedate");//input("?post.ordername")? input("ordername"): 'fcreatedate';
            $order = input("order", "desc");
            $order1="$ordername $order";
            $rs=array();
            $map=array();
            $map['a.FNumber']=['like',"%$FNumber%"];
            $map['a.FName']=['like',"%$FName%"];
            $map['a.FModel']=['like',"%$FModel%"];
            $map['c.fname']=['like',"%$FUnitID%"];
            $map['b.FCreateDate']=['BETWEEN',"$FCreateDateStime,$FCreateDateEtime"];
            $map['a.FDeleted'] =['<>',1];        //是否被删除
            $map['a.FFullName'] =['exp','is not null'];
            $b="SUBSTRING(ltrim(rtrim(a.FFullName)),1,(LEN(ltrim(rtrim(a.FFullName)))-CHARINDEX('_',REVERSE(ltrim(rtrim(a.FFullName))))))";

            if (!$ordername) {
              $ordername = 'id';
              $order = 'desc';
                      };
            if (!$offset) {
              $offset=0;
                          };
            if (!$limit) {
            $limit=10;
                   };
            $offset1 = ($offset-1)*$limit;

            $result = array();
            $result["total"] =$database->table('t_ICItem')->alias('a')->join('t_BaseProperty b','a.FItemID = b.FItemID','LEFT')->join('t_item c','a.FUnitID = c.FItemID','LEFT')->where($map)->count();
            $subQuery1=$database->table('t_ICItem')->where('FFullName','not null')->buildSql();
            $result["rows"] = $database->table($subQuery1.'a')->join('t_BaseProperty b','a.FItemID = b.FItemID','LEFT')->join('t_item c','a.FUnitID = c.FItemID','LEFT')->where($map)->field(['a.FNumber','a.FName','a.FModel','b.FCreateDate','c.fname' =>'FUnitID',$b => 'FFullName']) ->limit($offset,$limit)->order($order1)->select();
            return json ($result);
     }

          public function a()       //读取统计分类数据
          {

             $database=Db::connect('db_config1');
             $FNumber = input("FNumber", "");
             $FName = input("FName", "");
             $FModel = input("FModel", "");
             $FUnitID=input("FUnitID", "");
             $FCreateDateStime= input("FCreateDateStime", "");
             $FCreateDateEtime= input("FCreateDateEtime", "2037-04-17");
             $FCreateDateEtime=date('Y-m-d',strtotime("$FCreateDateEtime +1 day"));
             $search = input("search");

             $ordername = input("ordername", "fcreatedate");
      	     $rs=array();
      	     $map=array();
      	     $map1=array();
      	     $map['a.FNumber']=['like',"%$FNumber%"];
      	     $map['a.FName']=['like',"%$FName%"];
             $map['a.FModel']=['like',"%$FModel%"];
             $map['b.FCreateDate']=['BETWEEN',"$FCreateDateStime,$FCreateDateEtime"];
             $map['c.fname']=['like',"%$FUnitID%"];
             $map['a.FDeleted'] =['<>',1];        //是否被删除
             $map1['FDeleted'] =['<>',1];
             $map1['FNumber'] =array(array('like','%.%'), array('notlike','a.%'), array('notlike','c.%'),'and');
             $b="SUBSTRING(ltrim(rtrim(a.FFullName)),1,(LEN(ltrim(rtrim(a.FFullName)))-CHARINDEX('_',REVERSE(ltrim(rtrim(a.FFullName))))))";
             $result = array();
             $subQuery= array();
             $subQuery1= array();
             $subQuery1=$database->table('t_ICItem')->where('FFullName','not null')->where($map1)->buildSql();
             $subQuery = $database->table($subQuery1.'a')->join('t_BaseProperty b','a.FItemID = b.FItemID','LEFT')->join('t_item c','a.FUnitID = c.FItemID','LEFT')->where($map)->field(['a.FNumber','a.FModel','b.FCreateDate','c.fname' =>'FUnitID',$b => 'FName']) ->buildSql();
             $result =$database->table($subQuery.'d')->field('d.FName,count(*) as count') ->group('d.FName') ->order('FName desc')->select();
             echo json_encode($result);
        }
          public function pie()       //读取统计分类数据
          {
            $database=Db::connect('db_config1');
            $offset = input("offset");
            $limit = input("limit");
            $FNumber = input("FNumber", "");//isset($_POST['FNumber']) ? $_POST['FNumber'] : '';
            $FName = input("FName", "");
            $FModel = input("FModel", "");
            $FUnitID=input("FUnitID", "");
            $FCreateDateStime= input("FCreateDateStime", "");//isset($_POST['FCreateDateStime']) ? date('Y-m-d',strtotime($_POST['FCreateDateStime'])): '';
            $FCreateDateEtime= input("FCreateDateEtime", "2037-04-17");///isset($_POST['FCreateDateEtime']) ? date('Y-m-d',strtotime($_POST['FCreateDateEtime'])): '2037-04-17';
            $FCreateDateEtime=date('Y-m-d',strtotime("$FCreateDateEtime +1 day"));
            $rs=array();
            $map=array();
            $map1=array();
            $map['a.FNumber']=['like',"%$FNumber%"];
            $map['a.FName']=['like',"%$FName%"];
            $map['c.fname']=['like',"%$FUnitID%"];
            $map['a.FModel']=['like',"%$FModel%"];
            $map['b.FCreateDate']=['BETWEEN',"$FCreateDateStime,$FCreateDateEtime"];
            $map['a.FDeleted'] =['<>',1];        //是否被删除
            $map1['FDeleted'] =['<>',1];
            $map1['FNumber'] =array(array('like','%.%'), array('notlike','a.%'), array('notlike','c.%'),'and');
            $b="SUBSTRING(ltrim(rtrim(a.FFullName)),1,(LEN(ltrim(rtrim(a.FFullName)))-CHARINDEX('_',REVERSE(ltrim(rtrim(a.FFullName))))))";
            $result = array();
            $subQuery= array();
            $subQuery1= array();
            $subQuery1=$database->table('t_ICItem')->where('FFullName','not null')->where($map1)->buildSql();
            $subQuery = $database->table($subQuery1.'a')->join('t_BaseProperty b','a.FItemID = b.FItemID','LEFT')->join('t_item c','a.FUnitID = c.FItemID','LEFT')->where($map)->field(['a.FNumber','a.FModel','b.FCreateDate','c.fname' =>'FUnitID',$b => 'FName']) ->buildSql();
            $result =$database->table($subQuery.'d')->field('d.FName,count(*) as count') ->group('d.FName') ->order('count desc')->limit('0,6')->select();
            echo json_encode($result);
          }
          public function ad(){                      //物料统计时间统计
            $database=Db::connect('db_config1');
            $map['a.FDeleted'] =['<>',1];
            $map1['FDeleted'] =['<>',1];
            $map1['FNumber'] =array(array('like','%.%'), array('notlike','c.%'),'and');
            $result = array();
            $subQuery= array();
            $subQuery1= array();
            $subQuery1=$database->table('t_ICItem')->where('FFullName','not null')->where($map1)->buildSql();
            $subQuery = $database->table($subQuery1.'a')->join('t_BaseProperty b','a.FItemID = b.FItemID','LEFT')->join('t_item c','a.FUnitID = c.FItemID','LEFT')->where($map)->field(['a.FNumber','a.FModel','b.FCreateDate','c.fname' =>'FUnitID']) ->buildSql();
            $result =$database->table($subQuery.'d')->field('CONVERT(varchar(10), d.FCreateDate, 120) as FCreateDate,count(*) as count')->group('CONVERT(varchar(10), d.FCreateDate, 120)')->order('fcreatedate desc')->limit('0,30')->select();
            echo json_encode($result);
                                  }
} //class
