<div id="" style="width: 95%; margin: auto;">
	<canvas id="canvas"></canvas>
</div>
<script>
	var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
	var raw_data = [<?php echo implode ( ', ', unserialize( $data['months_arr'] ) ) ?>];
	var months = [];
	for ( let i = 0; i < raw_data.length; i++ ) {
		months.push( MONTHS[ raw_data[ i ] - 1 ] );
	}
	var color = Chart.helpers.color;
	var barChartData = {
		labels: months,
		datasets: [{
			label: 'Monthly Profit / Loss',
			backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
			borderColor: window.chartColors.red,
			borderWidth: 1,
			data: [<?php echo implode( ', ', unserialize( $data['months_profit_arr'] ) ) ?>]
		}]

	};

	window.onload = function() {
		var ctx = document.getElementById('canvas').getContext('2d');
		window.myBar = new Chart(ctx, {
			type: 'bar',
			data: barChartData,
			options: {
				responsive: true,
				legend: {
					position: 'top',
				},
				title: {
					display: true,
					text: 'Monthly Profitability Graph'
				}
			}
		});
	};
</script>