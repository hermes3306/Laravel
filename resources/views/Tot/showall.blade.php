@include ('Tot.header')


<h3>Daily Detail: </h3>

<div>
<?php
	print("<table><th>yymmdd</th><th>amount</th>");
    foreach ($Tot as $row) {
        print("<tr><td>$row->yymmdd</td><td> $row->money </td>");
    }
	print("</table>");

?>
</div>



@include('Tot.tail');
~                         
