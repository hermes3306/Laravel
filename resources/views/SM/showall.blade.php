@include ('SM.header')


<h3>Daily Detail: </h3>

<div>
<?php
	print("<table><tr><th>yymmdd</th><th>hhmmss</th>");
	print("<th>type</th><th>val</th></tr>");

    foreach ($SM as $row) {
        print("<tr><td>$row->yymmdd</td><td> $row->hhmmss </td>");
		print("<td>$row->type</td><td>$row->val</td></tr>");
    }
	print("</table>");

?>
</div>



@include('Tot.tail');
~                         
