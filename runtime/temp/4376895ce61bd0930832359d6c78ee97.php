<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:86:"/opt/lampstack-7.1.15-0/apache2/htdocs/demo/application/index/view/index/welcome1.html";i:1521439727;}*/ ?>
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
    <div class="container" id="win">
      <button id="btn_search1" type="button" class="btn btn-default">
        <!-- data-toggle="modal" data-target="#myModal" -->
      <span class="glyphicon glyphicon-search" aria-hidden="true"></span>查看
      </button>

      <div id="main" style="width:100%;height:400px;"></div>
      <!-- <div id="win5" style="width:100%;padding:0px;height:700px;"></div> -->


</div>
<script>

window.addEventListener("resize", resizeCanvas, false);

function getHeight() {
    return $(window).height() -$('#btn_search1').outerHeight(true); //$('h1').outerHeight(true)
}

function resizeCanvas() {
    w = canvas.width = window.innerWidth;
    h = canvas.height = window.innerHeight;
}


var $btn_search1=$('#btn_search1');

    $btn_search1.click(function (){
      classone12();
                              })


    function classone12(){
                          var names = [], counts = [];
                          getusers();
                          echartsbuild();
                          function getusers() {
                                     $.ajax({
                                        type: "post",
                                        async: false,
                                        url: "/demo/index.php/index/index/ad",

                                        dataType: "json",
                                        success: function(result){
                                            if(result){
                                                for(var i = 0 ; i < result.length; i++){
                                                    names.push(result[i].fcreatedate);
                                                    counts.push(result[i].count);
                                                }
                                            }
                                        },
                                        error: function(errmsg) {
                                            alert("Ajax获取服务器数据出错了！"+ errmsg);
                                        }
                                    });
                                return names, counts;
                                              }  //function getusers()

                          function echartsbuild() {
                                  var myChart = document.getElementById('main');
                                  var myChartContainer = function myChartContainer() {

                                      myChart.style.height = getHeight()+'px';
                                                                    };
                              myChartContainer();
                              var myChart = echarts.init(myChart);
                              var option = {
                              tooltip: {
                                  trigger: 'axis',
                                  axisPointer: {
                                      type: 'shadow'
                                  }
                              },
                              legend: {
                                  data: ['天']
                              },
                              grid: {
                                  left: '3%',
                                  right: '11%',
                                  top:'3%',
                                  bottom: '8%',
                                  containLabel: true
                              },
                              xAxis: {
                                  type: 'value',
                                  boundaryGap: [0,0.02]
                              },
                              yAxis: {
                                  type: 'category',
                                  data: names


                              },
                              series: [
                                  {
                                      name: '数据',
                                      type: 'bar',
                                      data: counts,
                                       label: {
                                      normal:  {
                                          position: 'right',
                                          show: true
                                                      }
                                                    }

                                  }

                              ]
                              };
                                    myChart.setOption(option);

                                              }
                              }

window.onresize = function () {
                                  myChartContainer();
                                  myChart.resize();
                              };
</script>
</body>
</html>
