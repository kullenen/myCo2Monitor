function co2chart(ctx, points) {
	var myChart = new Chart(ctx, {
		type: "line",
		data: {
			labels: Object.keys(points),
			datasets: [{
				label: "CO2",
				backgroundColor: "red",
				borderColor: "red",
				fill: false,
				data: Object.values(points),
			}]
		},
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true
					}
				}]
			}
		}
	});
}
