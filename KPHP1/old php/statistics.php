<!DOCTYPE html>
<html>
<head>
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	exportEnabled: true,
	animationEnabled: true,
	title:{
		text: "PAID AND UNPAID MONITORING"
	},
	subtitles: [{
		text: "Click Legend to Hide or Unhide Data Series"
	}], 
	
	axisY: {
		title: "PAID",
		titleFontColor: "#4F81BC",
		lineColor: "#4F81BC",
		labelFontColor: "#4F81BC",
		tickColor: "#4F81BC",
		includeZero: true
	},
	axisY2: {
		title: "UNPAID",
		titleFontColor: "#C0504E",
		lineColor: "#C0504E",
		labelFontColor: "#C0504E",
		tickColor: "#C0504E",
		includeZero: true
	},
	toolTip: {
		shared: true
	},
	legend: {
		cursor: "pointer",
		itemclick: toggleDataSeries
	},
	data: [{
		type: "column",
		name: "PAID",
		showInLegend: true,      
		yValueFormatString: "#,##0.# Units",
		dataPoints: [
			{ label: "Weekly",  y: 19034.5 },
			{ label: "Monthly", y: 20015 },
			{ label: "Annually", y: 25342 },
			
		]
	},
	{
		type: "column",
		name: "UNPAID",
		axisYType: "secondary",
		showInLegend: true,
		yValueFormatString: "#,##0.# Units",
		dataPoints: [
			{ label: "Weekly", y: 210.5 },
			{ label: "Monthly", y: 135 },
			{ label: "Annually", y: 425 },
		
		]
	}]
});
chart.render();

function toggleDataSeries(e) {
	if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	} else {
		e.dataSeries.visible = true;
	}
	e.chart.render();
}

}
</script>
</head>
<body>
<div id="chartContainer" style="height: 300px; width: 100%;"></div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</html>