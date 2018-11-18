@include ('SM.header')

<h3>Daily Sum: </h3>

<div>

<?php
	$yymmdd_array= array();
	$money_array = array();
	$money_array2 = array();


print("<table><th>yymmdd</th><th>type</th><th>max</th><th>min</th><th>avg</th>");
	foreach ($SM as $row) {
		print("<tr><td>$row->yymmdd</td>"); 
		print("<td> $row->type </td>"); 
		print("<td>$row->max</td><td> $row->min </td>"); 
		print("<td>$row->avg</td></tr>"); 
	}
print("</table>");

  	$xs=array();
  	$data1=array();
  	$data2=array();
  	$data3=array();
  	$data4=array();

    foreach($yymmdds as $row) { array_push($xs, $row->yymmdd); }
    foreach($temps as $row) { array_push($data1, $row->val); }
    foreach($humiditys as $row) { array_push($data2, $row->val); }
    foreach($gass as $row) { array_push($data3, $row->val); }
    foreach($electricitys as $row) { array_push($data4, $row->val); }


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
    type: 'line',

    // The data for our dataset
    data: {
        labels: [{{implode(",", $xs) }}],
        datasets: [{
            label: "Temp:",
            backgroundColor: 'rgb(255, 0, 0)',
            borderColor: 'rgb(255, 0, 0)',
            data: [{{implode(",", $data1)}} ],
			fill: false,
        }, 
        {
            label: "Humidity:",
            backgroundColor: 'rgb(0, 255, 0)',
            borderColor: 'rgb(0, 255, 0)',
            data: [{{implode(",", $data2)}} ],
			fill: false,
        }, 
        {
            label: "gas:",
            backgroundColor: 'rgb(0, 0, 255)',
            borderColor: 'rgb(0, 0, 255)',
            data: [{{implode(",", $data3)}} ],
			fill: false,
        }, 
        {
            label: "elec.:",
            backgroundColor: 'rgb(125, 0, 0)',
            borderColor: 'rgb(125, 0, 0)',
            data: [{{implode(",", $data4)}} ],
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
