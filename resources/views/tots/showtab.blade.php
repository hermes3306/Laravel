<div class="w3-container">
    <table class="w3-table">

    <tr class="w3-light-grey">
        <th>yymmdd</th>
        <th>accnt</th>
        <th>money</th>
    </tr>
    <?php foreach ($ts as $t) { ?>
    <tr>
        <td> <a href="/tots/yymmdd/{{$t->yymmdd}}/"> {{ $t->yymmdd }} </a>    
				<a href="/tot/pub/{{$t->yymmdd}}"><img height="10" width="10" 
				src="/images/pub.png" %}"></img> </a>
		</td>
        <td> {{ $t->accnt }} </td>
        <td> {{ $t->money }} </td>
    </tr>
	<?php } ?>
</div>
