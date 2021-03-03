$(document).ready(function () {
	"use strict";
	var root = window.location.origin + "/backpropagation/";

	var ticksStyle = {
		fontColor: "#495057",
		fontStyle: "bold"
	};

	var mode = "index";
	var intersect = true;

	var id = $("#id").val();

	var $chart = $("#akurasi-chart");
	$.ajax({
		url: root + "akurasi/grafik/"+id,
		type: "GET",
		async: true,
		cache: false,
		dataType: "json",
		success: function (response) {
			var denom = [];
			var target = [];
			var data = [];

			for (var i = 0; i < JSON.parse(response.denormalisasi).length; i++) {
				data.push((i+1));
				denom.push(JSON.parse(response.denormalisasi)[i]);
				target.push(JSON.parse(response.targeta)[i]);
			}


			var salesChart = new Chart($chart, {
				type: "line",
				data: {
					labels: data,
					datasets: [
						{
							label: "Hasil Prediksi",
							backgroundColor: "rgba(255,255,255,0)",
							borderColor: "#007bff",
							data: denom
						},{
							label: "Target",
							backgroundColor: "rgba(255,255,255,0)",
							borderColor: "#00ff0d",
							data: target
						}
					]
				},
				options: {
					maintainAspectRatio: false,
					tooltips: {
						mode: mode,
						intersect: intersect
					},
					hover: {
						mode: mode,
						intersect: intersect
					},
					elements: {
						point:{
							radius: 0
						}
					},
					legend: {
						display: true,
						position: "bottom",
					},
					scales: {
						yAxes:[{
							ticks: {
								beginAtZero : true
							}
						}]
					},
					title: {
						display: false,
						text: "Jumlah"
					},
				}
			});
		}
	});



	function getNum(val) {
		if (isNaN(val)) {
			return 0;
		}
		return val;
	}

	function nan(angka) {
		if (isNaN(angka)){
			return 0;
		}else {
			return angka;
		}
	}
});
