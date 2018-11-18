@include ('Tot.header')


<h3>Daily Detail: </h3>

<div>
<?php
    $yymmdds = array();
	$last_yymmdd="000000";
	$last_data=array();
	$accnts  = array();
	$dataset = array();
	$colset = array();
	$data = array();

	foreach ($Tot as $row) {
		if(!in_array($row->yymmdd,$yymmdds)) {
			array_push($yymmdds, $row->yymmdd);
		}
		
		if(!in_array($row->accnt,$accnts)) {
		}else{
			$dataset[$last_yymmdd] = $data;
			$data = array();
			$accnts = array();
		}
		$data[$row->accnt] = $row->money;
		array_push($accnts,$row->accnt);
		$last_yymmdd = $row->yymmdd;
	}
	$dataset[$last_yymmdd] = $data;;

	$colset = array();

	foreach ($dataset as $key=>$record) {
		foreach($record as $key2=>$amount) {
			if(!array_key_exists($key2, $colset)) {
				$colset[$key2] = array($amount);
			}else {
				array_push($colset[$key2], $amount);
			}	
		}
	}


	$bgcols = array (
		"'rgb(255,0,0)'",
		"'rgb(0,255,0)'",
		"'rgb(0,0,255)'",
		"'rgb(185,0,0)'",
		"'rgb(0,185,0)'",
		"'rgb(0,0,185)'",
		"'rgb(222,0,0)'",
		"'rgb(0,222,0)'",
		"'rgb(0,0,222)'",
		"'rgb(125,0,0)'",
		"'rgb(0,125,0)'",
		"'rgb(0,0,125)'",
	);

	

?>
</div>

<div>
<canvas id="myChart"></canvas>

<button id="Bar">Bar</button>
<button id="Line">Line</button>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

<script>

var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: [{{implode(",", $yymmdds) }}],
        datasets: [

<?php
	$inx=0;
	foreach ($colset as $key=>$record) {
		$mydata=implode(",", $record);
		print("{");
		print("label: '$key',");
		print("backgroundColor: $bgcols[$inx],");
		print("borderColor: $bgcols[$inx],");
		print("data: [$mydata],");
		print("fill: false,");
		print("},");
		$inx=$inx+1;
	}
?>
        ]
    },

    // Configuration options go here
    options: {
	}
});


// add event
document.getElementById('Bar').addEventListener('click', function() {
			window.chart.type='Bar';
			window.chart.update();
});



</script>



</div>




@include('Tot.tail');
