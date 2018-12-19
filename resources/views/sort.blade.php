<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>SORT</title>
	<link href="/css/bootstrap.min.css" rel="stylesheet">
	<script src="/js/jquery-1.11.3.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<script src="/js/echarts.simple.min.js"></script>
</head>
<body>
	<div class="col-sm-2">
		<div class="panel-body">
			<ul class="nav nav-pills nav-stacked">
				<li role="presentation" class="{{ Request::path() == 'bubble' ? 'active' : ''}}" ><a href="{{ url('/bubble') }}">冒泡排序1</a></li>
				<li role="presentation" class="{{ Request::path() == 'bubble2' ? 'active' : ''}}" ><a href="{{ url('/bubble2') }}">冒泡排序2</a></li>
				<li role="presentation" class="{{ Request::path() == 'selection' ? 'active' : ''}}" ><a href="{{ url('/selection') }}">选择排序</a></li>
				<li role="presentation" class="{{ Request::path() == 'insertion' ? 'active' : ''}}" ><a href="{{ url('/insertion') }}">直接插入排序</a></li>
				<li role="presentation" class="{{ Request::path() == 'shell' ? 'active' : ''}}" ><a href="{{ url('/shell') }}">希尔排序1</a></li>
				<li role="presentation" class="{{ Request::path() == 'shell2' ? 'active' : ''}}" ><a href="{{ url('/shell2') }}">希尔排序2</a></li>
			</ul>
		</div>
	</div>
	<div class="well well-sm col-sm-10">
		<div class="col-sm-12" >
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><button type="button" class="btn btn-success" id="test" >开始</button></h3>
				</div>
				<div class="panel-body">
					<div id="bubble" style="width: 100%;height:600px;"></div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" >
		$(function(){
			// 冒泡
			bubble = echarts.init(document.getElementById('bubble'));
			// 初始数据
			var init_yAxis = {{ $init['yAxis'] }};
			var init_color = <?php echo $init['color']; ?>;
			// 动态数据
            var sort_yAxis = {{ $sort['yAxis'] }};
            var sort_color = <?php echo $sort['color']; ?>;
            var option = {
	            xAxis: {
	                data: init_yAxis,
	            },
	            yAxis: {},
	            series: [{
	                type: 'bar',
	                data: init_yAxis,
                    itemStyle: {
                        color: function (params){
                            var colorList = init_color;
                            return colorList[params.dataIndex];
						}
					},
	            }]
	        };
	        bubble.setOption(option);


            $("#test").click(function(event) {
                var timer = window.setInterval(function(){
                    var color = sort_color.shift();
                    var yAxis = sort_yAxis.shift();
                    var option = {
                        xAxis: {
                            data: yAxis,
                        },
                        yAxis: {},
                        series: [{
                            type: 'bar',
                            data: yAxis,
                            itemStyle: {
                                color: function (params){
                                    var colorList = color;
                                    return colorList[params.dataIndex];
                                }
                            },
                        }]
                    };
                    bubble.setOption(option);
                    if( sort_yAxis.length == 0 ){
                        window.clearInterval(timer);
                    }
                },300)
            });
		})
	</script>
</body>
</html>