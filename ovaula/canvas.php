
<html>
  <head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Mushrooms', 3],
          ['Onions', 3],
          ['Olives', 3], 
          ['Zucchini', 3],
          ['Pepperoni', 3],
          ['Tomatle', 3],
          ['Champiñon', 3]
        ]);

        // Set chart options
        var options = {legend: 'none', pieSliceText: 'none', 'tooltip' : {trigger: 'none'}, 'displayMode':'regions', 'width':400,'height':300};

 
        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));

        function selectHandler() {
          var selectedItem = chart.getSelection()[0];
          if (selectedItem) {
            var topping = data.getValue(selectedItem.row, 0);
            alert('The user selected ' + topping);
          }
        }

        google.visualization.events.addListener(chart, 'select', selectHandler);    
        chart.draw(data, options);
      }

    </script>
  </head>
  <body>
    <!--Div that will hold the pie chart-->
    <div id="chart_div" style="width:400; height:300"></div>
  </body>
</html>
<!--<html>
  <head>
  <script src="js/jquery-2.2.1.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Work',     11],
          ['Eat',      2],
          ['Commute',  2],
          ['Watch TV', 2],
          ['Sleep',    7]
        ]);

        var options = {
          pieHole: 0,
          pieSliceTextStyle: {
            color: 'black',
          },
          legend: 'none'
        };

        var chart = new google.visualization.PieChart(document.getElementById('donut_single'));
        chart.draw(data, options);
        function selectHandler() {
    var selectedItem = chart.getSelection()[0];
    if (selectedItem) {
      var value = data.getValue(selectedItem.row, selectedItem.column);
      alert('The user selected ' + value);
    }
  }

  // Listen for the 'select' event, and call my function selectHandler() when
  // the user selects something on the chart.
  google.visualization.events.addListener(chart, 'select', selectHandler);
      }
    </script>
  </head>
  <body>
    <div id="donut_single" style="width: 900px; height: 500px;"></div>
  </body>
</html>
<img class="rotate" id="rueda" src="img/logo-modal.png" />

<script src="js/jquery-2.2.1.min.js"></script>
<script>
$(document).ready(function() {
	var rotation = function (){
    jQuery('#rueda').rotate({
      angle:0,            // reset rotation angle to 0 where to start the rotation
      // rotate 360 degrees (counter clockwise), in 3 secconds
      animateTo:-360, 
      duration: 3000,
      // auto-call the function after rotation, to rotate again and again
      callback: rotation,
      // add easing to make animation look more natural
      // t: current time, b: begInnIng value, c: change In value, d: duration
      easing: function (x,t,b,c,d){
        return c*(t/d)+b;       // linear easing
      },
      // bind "click" to stop the rotation when click, gets and display the current angle
      bind: {
        click: function(){
          jQuery(this).stopRotate();
          jQuery(this).html('<br/> Angle: <b>'+ $(this).getRotateAngle()+ '</b>');
          alert(rotation);
      }}
     });
  }

  rotation(); 

});
</script>
<!doctype html>
<html>
<head>
<meta charset="UTF-8" />
<title>Canvas Test</title>
</head>
<body>
<section>
<div>
<canvas id="canvas" width="400" height="300">
This text is displayed if your browser does not support HTML5 Canvas.
</canvas>
</div>
<script src="js/jquery-2.2.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#canvas').click(function(event) {
		$(this).toggleClass('rotated');
	});
});
var myColor = ["#ECD078","#D95B43","#C02942","#542437","#53777A"];
var myData = [10,30,20,60,40];

function getTotal(){
var myTotal = 0;
for (var j = 0; j < myData.length; j++) {
myTotal += (typeof myData[j] == 'number') ? myData[j] : 0;
}
return myTotal;
}

function plotData() {
var canvas;
var ctx;
var lastend = 0;
var myTotal = getTotal();

canvas = document.getElementById("canvas");
ctx = canvas.getContext("2d");
ctx.clearRect(0, 0, canvas.width, canvas.height);

for (var i = 0; i < myData.length; i++) {
ctx.fillStyle = myColor[i];
ctx.beginPath();
ctx.moveTo(200,150);
ctx.arc(200,150,150,lastend,lastend+
  (Math.PI*2*(myData[i]/myTotal)),false);
ctx.lineTo(200,150);
ctx.fill();
lastend += Math.PI*2*(myData[i]/myTotal);
}
}

plotData();

</script>
</section>
</body>
</html>
DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<canvas id="canvas"></canvas>
	<script src="js/jquery-2.2.1.min.js"></script>
	<script>
		$(document).ready(function() {
			draw();
		});
		function draw(){
			var canvas=document.getElementById('canvas');
			if(canvas.getContext){
				var ctx=canvas.getContext('2d');
				ctx.beginPath();
				ctx.moveTo(150,150);
				ctx.lineTo(75,25);
				ctx.lineTo(75,75);
				ctx.fill();
				/*var ctx=canvas.getContext('2d');
				ctx.beginPath();
				ctx.moveTo(550,100);
				ctx.lineTo(100,95);
				ctx.lineTo(100,5);
				ctx.fill();*/
			}
		}
	</script>
</body>
</html> -->