<div class="w3-container">
 <table class="w3-table">
    <tr class="w3-light-grey">
        <th>yymmdd</th>
        <th>money</th>
        <th>+/-</th>
        <th>Cummulative(+/-)</th>
    </tr>
	
    <?php foreach ($ts as $t) { ?>
	
    	<tr>
        	<td> <a href="/tots/{{$t->yymmdd}}/"> {{ $t->yymmdd }} </a>
                    <a href="/tot/pub/{{$t->yymmdd}}"><img height="10" width="10"
                    src="tot/images/pub.png"></img> </a> </td>
        	<td> {{ $t->money }} </td>
        	<td> <font color="{{ $t->color }}"> {{ $t->gap }} </font> </td>
        	<td> <font color="{{ $t->color2 }}"> {{ $t->sum }} </font> </td>
    	</tr>
    <?php } ?>
</div>
