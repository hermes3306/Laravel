@include ('Tot.header')

<h3>Today:</h3>

<div>

<?php
	$yymmdd = date("ymd");
	$accnt_array = array();
	$money_array = array();
	$yymmdd_array = array();
	$bgcolor = array();
	$colors = array(
  		"rgb(0,255,0)",  
		"rgb(0,0,255)",  
		"rgb(255,0,0)",  
		"rgb(128,0,0)",  
		"rgb(128,128,128)",  
		"rgb(255,0,0)",  
		"rgb(0,0,255)",  
		"rgb(0,255,0)", 
				);
	$inx = 0;
	
foreach ($Tot as $row) {
		array_push($yymmdd_array, $row->yymmdd);
		array_push($accnt_array, $row->accnt);
		array_push($money_array, $row->money);
		array_push($bgcolor, $colors[$inx] );
		$inx++;
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
    type: 'pie',

    // The data for our dataset
    data: {
        labels: [
			<?php
				foreach ($Tot as $t) { ?>
					"{{$t->accnt}}",
			<?php
				}
			?> 
		],
        datasets: [{
            label: "Daily Sum:",
            data: [ {{ implode(",", $money_array )  }} ],   
			backgroundColor: [
				<?php
					foreach ($bgcolor as $co) { ?>
						"{{$co}}",
				<?php
					}
				?> 
			]
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
print("<table><tr><th>yymmdd</th><th>account</th><th>amount</th></tr>");
	foreach ($Tot as $row) {
		print("<tr><td>$row->yymmdd</td><td>$row->accnt</td><td> $row->money </td>"); 
	}
print("</table>");
?>
</div>


@include('Tot.tail')
