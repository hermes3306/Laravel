@include ('Tot.header')

<h3>Update for latest date: </h3>

<div>
{{ Form::open(array('url' => '/Tot/ins', 'method' => 'post')) }}

<?php
print("<label width=50>Date:</lable>");
print("<input type='text' size=10 align=right name='yymmdd' value='$yymmdd' />");
echo("<br>");

$sum = 0;
foreach($Tot as $row) {
		if($row->money < 0) {
		} else {
 			print("<input type='text' size=3 name='foo[$row->accnt]' value='$row->accnt' readonly />");
 			print("<input type='text' size=10 name='foo[$row->accnt]' value='$row->money' />");
			$sum = $sum + $row->money;
    		echo("<br>");
		}
}

print("<input type='text' size=3 name='newaccnt' value='new' />");
print("<input type='text' size=10 name='newamt' value='0' />");
echo("<br>");

?>

Total: <font color="red"> {{$sum}} </font>
<br>
<input type="submit" name="Submit" value="Submit">

{{ Form::close() }}

</div>

@include('Tot.tail');
