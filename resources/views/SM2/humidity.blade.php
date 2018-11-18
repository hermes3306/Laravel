@include ('SM2.header')

<h3>Real Time Sensor Data: </h3>

<div>
<?php
	$mydata1=array();
	$mydata2=array();

	foreach($hhmmsss as $row) { array_push($mydata1, $row->hhmmss); }
	foreach($humiditys as $row) { array_push($mydata2, $row->humi); }
?>

</div>

<br>

<div>
<canvas id="myChart"></canvas>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

<script>

var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: [{{implode(",", $mydata1) }}],
        datasets: [
		{
            label: "Humidity:",
            backgroundColor: 'rgb(0, 255, 0)',
            borderColor: 'rgb(0,255, 0)',
            data: [{{ implode(",", $mydata2) }} ],
			fill: false,
        }, 

		]
    },

    // Configuration options go here
    options: {}
});

</script>



</div>


@include('SM2.tail');
