<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:83:"/opt/lampstack-7.1.15-0/apache2/htdocs/demo/application/excel/view/index/index.html";i:1523188840;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="/demo/public/static/css/bootstrap.min.css">
  <link rel="stylesheet" href="/demo/public/static/css/index.css">
  <link rel="stylesheet" href="/demo/public/static/css/bootstrap-table.css">
  <link href="/demo/public/static/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
  <script src="/demo/public/static/js/jquery.min.js"></script>
  <script src="/demo/public/static/js/bootstrap.min.js"></script>
  <script src="/demo/public/static/js/bootstrap-table.js"></script>
  <script src="/demo/public/static/js/bootstrap-table-zh-CN.js"></script>
  <script src="/demo/public/static/js/bootstrap-table-export.js"></script>
  <script src="/demo/public/static/js/tableExport.js"></script>
  <script type="text/javascript" src="/demo/public/static/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
  <script type="text/javascript" src="/demo/public/static/js/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
  <script src="/demo/public/static/js/echarts.min.js"></script>
</head>
<body>
    <div class="container">
      <form action="/demo/index.php/excel/index/upload" enctype="multipart/form-data" method="post">
      <input type="file" name="image" /> <br>
      <input type="submit" value="上传" />
      </form>
          <table id="table"> </table>

    </div>

<script>
    var $table = $('#table'),
        $search1 = $('#search1'),
        $btn_search1=$('#btn_search1'),
        $btn_search2=$('#btn_search2');
    initTable();

    function initTable() {
        $table.bootstrapTable({
            height: getHeight(),
            url:'/demo/index.php/excel/Index/ab',
            queryParams: function (params) {
                return {

                  limit : params.limit,
                  offset : params.offset,
                  order : params.order,
                  ordername : params.sort
                };
            },
            //showHeader : true,
            //showColumns : true,
            //showRefresh : true,
            sortOrder : 'asc',
            // toolbar: "#toolbar",
            pagination: true,//分页
            sidePagination : 'server',//服务器端分页
            pageNumber : 1,
            pageSize   : 10,
            pageList: [10, 20, 50,300],//分页步进值
            columns: [
                {
                    field: 'id',//域值
                    title: '序号',//标题
                    visible: true,//false表示不显示
                    sortable: true,//启用排序
                    width : '5%',
                },
                {
                    field: 'text',//域值
                    title: '文件号',//标题
                    visible: true,//false表示不显示
                    sortable: true,//启用排序
                    width : '30%',

                },
                {
                    field: 'file',//域值
                    title: '文件名称',//内容
                    visible: true,//false表示不显示
                    sortable: true,//启用排序
                    width : '35%',

                },
                {
                    field: 'project',//域值
                    title: '工作号',//内容
                    visible: true,//false表示不显示
                    sortable: true,//启用排序
                    width : '10%',

                },
                {
                    field: 'department',//域值
                    title: '部门',//内容
                    visible: true,//false表示不显示
                    sortable: true,//启用排序
                    width : '20%',

                },
                {
                    field: 'date',//域值
                    title: '发出日期',//内容
                    visible: true,//false表示不显示
                    sortable: true,//启用排序
                    width : '10%',

                }
                  ]
        });

        $(window).resize(function () {
            $table.bootstrapTable('resetView', {
                height: getHeight()
            });
        });

    }



    function getHeight() {
        return $(window).height()-200; //$('h1').outerHeight(true)
    }







</script>
</body>
</html>
