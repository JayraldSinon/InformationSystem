<?php
require('top.inc.php');
isAdmin();


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "masterlist";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}

$weekP = 0;
$weekU = 0;
$monthP = 0;
$monthU = 0;
$yearP = 0;
$yearU = 0;

$currentMonth = date('n');

$sql_weekP = "SELECT COUNT(ID) AS ID FROM payment WHERE YEAR(CurrDate) = YEAR(CURDATE()) AND WEEK(CurrDate) = WEEK(CURDATE()) AND stat = 1 AND Month <= $currentMonth";
$result = mysqli_query($con, $sql_weekP);
$row = mysqli_fetch_assoc($result);
$weekP = $row['ID'];

$sql_weekU = "SELECT COUNT(ID) AS ID FROM payment WHERE YEAR(CurrDate) = YEAR(CURDATE()) AND WEEK(CurrDate) = WEEK(CURDATE()) AND stat = 0 AND Month <= $currentMonth";
$result = mysqli_query($con, $sql_weekU);
$row = mysqli_fetch_assoc($result);
$weekU = $row['ID'];


$sql_monthP = "SELECT COUNT(ID) AS ID FROM payment WHERE YEAR(CurrDate) = YEAR(CURDATE()) AND MONTH(CurrDate) = MONTH(CURDATE()) AND stat = 1 AND Month <= $currentMonth";
$result = mysqli_query($con, $sql_monthP);
$row = mysqli_fetch_assoc($result);
$monthP = $row['ID'];

$sql_monthU = "SELECT COUNT(ID) AS ID FROM payment WHERE YEAR(CurrDate) = YEAR(CURDATE()) AND MONTH(CurrDate) = MONTH(CURDATE()) AND stat = 0 AND Month <= $currentMonth";
$result = mysqli_query($con, $sql_monthU);
$row = mysqli_fetch_assoc($result);
$monthU = $row['ID'];


$sql_yearP = "SELECT COUNT(ID) AS ID FROM payment WHERE YEAR(CurrDate) = YEAR(CURDATE()) AND stat = 1 AND Month <= $currentMonth";
$result = mysqli_query($con, $sql_yearP);
$row = mysqli_fetch_assoc($result);
$yearP = $row['ID'];

$sql_yearU = "SELECT COUNT(ID) AS ID FROM payment WHERE YEAR(CurrDate) = YEAR(CURDATE()) AND stat = 0 AND Month <= $currentMonth";
$result = mysqli_query($con, $sql_yearU);
$row = mysqli_fetch_assoc($result);
$yearU = $row['ID'];


$dataPoints = array( 
        array("label"=>"WEEKLY", "y"=>$weekP)
);
$dataPoints1 = array( 
        array("label"=>"WEEKLY", "y"=>$weekU)
      );

$dataPoints2 = array( 
        array("label"=>"MONTHLY", "y"=>$monthP)
);
$dataPoints3 = array( 
        array("label"=>"MONTHLY", "y"=>$monthU)
      );

$dataPoints4 = array( 
        array("label"=>"ANNUAlly", "y"=>$yearP)
);
$dataPoints5 = array( 
        array("label"=>"ANNUAlly", "y"=>$yearU)
      );

?>
<html>
<head>
  <script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	exportEnabled: true,
	animationEnabled: true,
	title:{
		text: "WEEKLY PAID AND UNPAID"
	}, 
	
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
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	},
	{
		type: "column",
		name: "UNPAID",
		axisYType: "secondary",
		showInLegend: true,
		yValueFormatString: "#,##0.# Units",
		dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
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

var chart = new CanvasJS.Chart("chartContainer1", {
	exportEnabled: true,
	animationEnabled: true,
	title:{
		text: "MONTHLY PAID AND UNPAID"
	}, 
	
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
		dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
	},
	{
		type: "column",
		name: "UNPAID",
		axisYType: "secondary",
		showInLegend: true,
		yValueFormatString: "#,##0.# Units",
		dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
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

var chart = new CanvasJS.Chart("chartContainer2", {
	exportEnabled: true,
	animationEnabled: true,
	title:{
		text: "ANNUALLY PAID AND UNPAID"
	}, 
	
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
		dataPoints: <?php echo json_encode($dataPoints4, JSON_NUMERIC_CHECK); ?>
	},
	{
		type: "column",
		name: "UNPAID",
		axisYType: "secondary",
		showInLegend: true,
		yValueFormatString: "#,##0.# Units",
		dataPoints: <?php echo json_encode($dataPoints5, JSON_NUMERIC_CHECK); ?>
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
<br>
<div id="chartContainer" style="height: 300px; width: 100%;"></div>
<br>
<div id="chartContainer1" style="height: 300px; width: 100%;"></div>
<br>
<div id="chartContainer2" style="height: 300px; width: 100%;"></div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script> 
</body>
</html>

<?php
require('footer.inc.php');
?>