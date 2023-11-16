<?php
 
$dataPoints = array( 
	array("y" => 53.64, "label" => "MANGO" ),
	array("y" => 35.94, "label" => "CHERRY" ),
	array("y" => 42.55, "label" => "SOLAR" ),
	array("y" => 35.55, "label" => "LOFT" ),
	array("y" => 39.99, "label" => "AVATAR" ),
	array("y" => 60.215, "label" => "PEACH" ),
	array("y" => 40.45, "label" => "SURVEY" )
);

 
?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "campaign"
	},
	axisY: {
		title: "Call transfer (in BYTES)"
	},
    axixX:{
        title:"campaign"
    },
	data: [{
		type: "column",
		yValueFormatString: "0.## BYTES",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</html>        