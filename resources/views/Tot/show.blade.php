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

foreach ($Tot as $row) {
		array_push($yymmdd_array, $row->yymmdd);
		array_push($money_array, $row->money);
}


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
        labels: [{{implode(",", $yymmdd_array) }}],
        datasets: [{
            label: "Daily Sum:",
            backgroundColor: 'rgb(0, 0, 255)',
            borderColor: 'rgb(0, 0, 255)',
            data: [{{implode(",", $money_array)}}],
			fill: false
        }, 

		]
    },

    // Configuration options go here
    options: {}
});

</script>



</div>

<div>
<?php 
$inx = 0;
$gap = 0;
$before = 0;
print("<table><tr><th>yymmdd</th><th>amount</th><th>+/-</th></tr>");
	foreach ($Tot as $row) {
		if ($inx == 0) $before = $row->money;
		$gap = $row->money - $before;
		print("<tr><td>$row->yymmdd</td><td> $row->money </td>");
		if ($gap > 0) {
			print(" <td> <font color='#FF0000'> $gap </font> </td> </tr> "); 
		} else {
			print(" <td> <font color='#0000FF'> $gap </font> </td> </tr> "); 
		}
		$before = $row->money;
		$inx = $inx + 1;
	}
print("</table>");
?>
</div>


@include('Tot.tail')
