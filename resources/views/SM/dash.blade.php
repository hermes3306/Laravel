@include ('SM.header')

<h3>Daily Sum: </h3>

<div>

<?php

	$mydata1=array();
	$mydata2=array();
	$mydata3=array();
	$mydata4=array();
	$mydata5=array();

	foreach($hhmmsss as $row) { array_push($mydata1, $row->hhmmss); }
	foreach($temps as $row) { array_push($mydata2, $row->temp); }
	foreach($humiditys as $row) { array_push($mydata3, $row->humi); }
	foreach($gass as $row) { array_push($mydata4, $row->gas); }
	foreach($elecs as $row) { array_push($mydata5, $row->ele); }
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
            label: "Temperature:",
            backgroundColor: 'rgb(255,0, 0)',
            borderColor: 'rgb(255, 0, 0)',
            data: [{{ implode(",", $mydata2) }} ],
			fill: false,
        }, 

		{
            label: "Humidity:",
            backgroundColor: 'rgb(0,255,0)',
            borderColor: 'rgb(0,255,0)',
            data: [{{ implode(",", $mydata3) }} ],
			fill: false,
        }, 

		{
            label: "Gas:",
            backgroundColor: 'rgb(0,0, 255)',
            borderColor: 'rgb(0,0,255)',
            data: [{{ implode(",", $mydata4) }} ],
			fill: false,
        }, 

		{
            label: "Electricity:",
            backgroundColor: 'rgb(125,0, 0)',
            borderColor: 'rgb(125, 0, 0)',
            data: [{{ implode(",", $mydata5) }} ],
			fill: false,
        }, 


		]
    },

    // Configuration options go here
    options: {}
});

</script>



</div>


@include('Tot.tail');
