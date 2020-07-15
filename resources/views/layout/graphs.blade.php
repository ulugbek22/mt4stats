<div class="graphs-wrapper">
	<div class="graph">
	  <canvas id="canvas"></canvas>
	</div>
	<div class="graph">
	  <canvas id="canvas1"></canvas>
	</div>
	<div class="graph">
	  <canvas id="canvas2"></canvas>
	</div>
</div>
<script>
	var MONTHS = ['', '', '', '', '', '', '', '', '', '', '', ''];
	var raw_data = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
	var months = [];
	for ( let i = 0; i < raw_data.length; i++ ) {
		months.push( MONTHS[ raw_data[ i ] - 1 ] );
	}
	var color = Chart.helpers.color;
	var barChartData = {
		labels: months,
		datasets: [{
			label: '',
			backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
			borderColor: window.chartColors.red,
			borderWidth: 1,
			data: [100, 150, 400, 500, 200, 100, 45, 10, 100, 44, 40, 12]
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
					display: false,
					text: 'Monthly Profitability Graph'
				}
			}
		});
	};
</script>

<script>
	var MONTHS = ['', '', '', '', '', '', '', '', '', '', '', ''];
	var raw_data = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
	var months = [];
	for ( let i = 0; i < raw_data.length; i++ ) {
		months.push( MONTHS[ raw_data[ i ] - 1 ] );
	}
	var color = Chart.helpers.color;
	var barChartData = {
		labels: months,
		datasets: [{
			label: '',
			backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
			borderColor: window.chartColors.red,
			borderWidth: 1,
			data: [100, 150, 400, 500, 200, 100, 45, 10, 100, 44, 40, 12]
		}]

	};

	window.onload = function() {
		var ctx = document.getElementById('canvas1').getContext('2d');
		window.myBar = new Chart(ctx, {
			type: 'bar',
			data: barChartData,
			options: {
				responsive: true,
				legend: {
					position: 'top',
				},
				title: {
					display: false,
					text: 'Monthly Profitability Graph'
				}
			}
		});
	};
</script>