function createCo2chart(ctx) {
	return new Chart(ctx, {
		type: "line",
		data: {
			datasets: [
				{
					label: "CO2",
					backgroundColor: "red",
					borderColor: "red",
					fill: false,
					yAxisID: "axis-ppm"
				}
				,
				{
					label: "Температура",
					backgroundColor: "green",
					borderColor: "green",
					fill: false,
					yAxisID: "axis-temp"
				}
			]
		},
		options: {
			responsive: true,
			scales: {
				xAxes: [
					{
						scaleLabel: {
							display: true,
							labelString: "Время"
						},
						type: "time",
						time: {
							unit: "minute",
							displayFormats: {
								second: "HH:mm:ss",
								hour: "HH:mm",
								minute: "HH:mm"
							}
						}
					}
				],
				yAxes: [
					{
						scaleLabel: {
							display: true,
							labelString: "CO2, ppm"
						},
						ticks: {
							beginAtZero: true
						},
						position: "left",
						id: "axis-ppm",
					},
					{
						scaleLabel: {
							display: true,
							labelString: "Температура, C"
						},
						ticks: {
							beginAtZero: true
						},
						position: "right",
						id: "axis-temp",
					}
				]
			}
		}
	});
}

function mapCo2Data(data, key) {
	return data.map(
		function (item) {
			return {
				x: new Date(item["time"]),
				y: item[key]
			};
		}
	);
}

function co2chartUpdate(url, chart) {
	$.getJSON(
		url,
		function (data) {
			var sec = (new Date(data[data.length - 1]["time"]).getTime() - new Date(data[0]["time"]).getTime()) / 1000;

			chart.options.scales.xAxes[0].time.unit = "minute";
			chart.options.scales.xAxes[0].scaleLabel.labelString =
				"Период: "
				+ moment(data[0]["time"]).format("MMM D YYYY, HH:mm:ss")
				+ " - "
				+ moment(data[data.length - 1]["time"]).format("MMM D YYYY, HH:mm:ss");
			
			if (sec / (3600 * 24 * 365) > 2) {
				chart.options.scales.xAxes[0].time.unit = "year";
			}
			if (sec / (3600 * 24 * 30) > 2) {
				chart.options.scales.xAxes[0].time.unit = "month";
			}
			if (sec / (3600 * 24) > 2) {
				chart.options.scales.xAxes[0].time.unit = "day";
			}
			if (sec / 3600 > 2) {
				chart.options.scales.xAxes[0].time.unit = "hour";
			}

			chart.data.datasets[0].data = mapCo2Data(data, "ppm");
			chart.data.datasets[1].data = mapCo2Data(data, "temp");

			chart.update();
		}
	);
}
