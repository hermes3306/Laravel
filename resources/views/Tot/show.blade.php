@include ('Tot.header')

<h3>Daily Sum: </h3>

<div>

<?php
	$yymmdd_array= array();
	$money_array = array();
	$money_array2 = array();


/*
	foreach ($Tot as $row) {
		print("$row->yymmdd, $row->money <BR>"); 
		array_push($yymmdd_array, $row->yymmdd);
		array_push($money_array, $row->money);
	}
*/

print("<table><tr><th>yymmdd</th><th>amount</th></tr>");
	foreach ($Tot as $row) {
		print("<tr><td>$row->yymmdd</td><td> $row->money </td>"); 
		array_push($yymmdd_array, $row->yymmdd);
		array_push($money_array, $row->money);
	}
print("</table>");

	//var_dump($Tot);
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
    type: 'bar',

    // The data for our dataset
    data: {
        labels: [{{implode(",", $yymmdd_array) }}],
        datasets: [{
            label: "Daily Sum:",
            backgroundColor: 'rgb(99, 255, 132)',
            borderColor: 'rgb(99, 255, 132)',
            data: [{{implode(",", $money_array)}} ],
        }, 

		]
    },

    // Configuration options go here
    options: {}
});

</script>



</div>


@include('Tot.tail')
