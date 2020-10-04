function createCo2Chart(ctx) {
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

function co2ChartUpdate(chart, url) {
	$.LoadingOverlay("show");

	$.getJSON(
		url,
		function (data) {
			var ppm = null;
			var temp = null;
			var label = "";
			
			chart.options.scales.xAxes[0].time.unit = "minute";
			label = "";

			if (typeof data !== "undefined" && data.length > 0) {
				var sec = (new Date(data[data.length - 1]["time"]).getTime() - new Date(data[0]["time"]).getTime()) / 1000;
				var units = {
					"hour": 3600,
					"day": 3600 * 24,
					"month": 3600 * 24 * 30,
					"year": 3600 * 24 * 365
				};

				label =
					"Период: "
					+ moment(data[0]["time"]).format("D MMM YYYY, HH:mm:ss")
					+ " - "
					+ moment(data[data.length - 1]["time"]).format("D MMM YYYY, HH:mm:ss");

				for (const [unit, divider] of Object.entries(units)) {
					if (sec / divider > 1) {
						chart.options.scales.xAxes[0].time.unit = unit;
					}
				}

				ppm = mapCo2Data(data, "ppm");
				temp = mapCo2Data(data, "temp");
			}


			chart.options.scales.xAxes[0].scaleLabel.labelString = label;
			chart.data.datasets[0].data = ppm;
			chart.data.datasets[1].data = temp;

			$.LoadingOverlay("hide");
			chart.update();
		}
	);
}
