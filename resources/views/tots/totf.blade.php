@include ('tots.header')

<div class="w3-container">
{{ Form::open(array('url' => '/tots/ins', 'method' => 'post')) }}

<?php
print("<label width=50>yymmdd:</lable>");
print("<input type='text' size=10 align=right name='yymmdd' value='$yymmdd' />");

$sum = 0;
foreach($Tot as $row) {
		if($row->money < 0) {
		} else {
 			print("<input type='label' size=3 name='foo[$row->accnt]' value='$row->accnt' readonly />");
 			print("<input type='text' size=10 name='foo[$row->accnt]' value='$row->money' />");
			$sum = $sum + $row->money;
		}
}
?>

Total: <font color="red"> {{$sum}} </font>
<br>
<input type="submit" name="Submit" value="Submit">

{{ Form::close() }}

</div>

@include ('tots.tail')
