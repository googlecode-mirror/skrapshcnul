<div class="m-content">
	<div class="c-pages shadow-rounded">
		<?php //echo ( json_encode($user_statistics)) ?>
		<h2><?php echo $tpl_page_title; ?></h2>
		<h3 class="sub-heading">Numbers - what people always like about!</h3>
		
		<div id="chart-container" style="width: 100%; height: 400px"></div>
		
	</div>
	<div class="clearfix">&nbsp;</div>
</div>


<script>

var user_stats = <?php echo json_encode($user_statistics) ?>;

var chart;
jQuery(document).ready(function() {
	chart = new Highcharts.Chart({

		chart: {
			renderTo: 'chart-container',
			type: 'column'
		},

		title: {
			/*text: 'Total Users, grouped by date'*/
			text: user_stats.title.text
		},

		xAxis: {
			/*categories: ['Apples', 'Oranges', 'Pears', 'Grapes', 'Bananas']*/
			categories: user_stats.xAxis.categories
		},

		yAxis: {
			allowDecimals: false,
			min: 0,
			title: {
				/*text: 'Number of fruits'*/
				text: user_stats.yAxis.title.text
			}
		},

		tooltip: {
			formatter: function() {
				return '<b>'+ this.x +'</b><br/>'+
					this.series.name +': '+ this.y +'<br/>'+
					'Total: '+ this.point.stackTotal;
			}
		},

		plotOptions: {
			column: {
				stacking: 'normal'
			}
		},

		/*series: [{
			name: 'John',
			data: [5, 3, 4, 7, 2],
			stack: 'male'
		}, {
			name: 'Joe',
			data: [3, 4, 4, 2, 5],
			stack: 'male'
		}]*/
		series: [{
			name: user_stats.series.name,
			data: user_stats.series.data,
			stack: user_stats.series.stack
		}]
	});
});
console.log(user_stats.xAxis.categories);
console.log(user_stats.series.data);
</script>