<html>
<head></head>
<body>

<a href="/Tot/show">show</a> |
<a href="/Tot/showall">all</a> |
<a href="/Tot/ins">ins</a> <BR> 

<?php
	foreach ($Tot as $row) {
		print("$row->yymmdd, $row->accnt, $row->money <BR>"); 
	}

	//var_dump($Tot);
?>

<table width="500" border="0" cellspacing="1" cellpadding="0"> 
<form action="/Tot/ins" method="POST">
	@method('POST')
<tr> 
<td><strong>yymmdd</strong></td> 
<td><strong>accnt</strong></td> 
<td><strong>money</strong></td>
<td><strong>y</strong></td>
<td><strong>a</strong></td>
<td><strong>m</strong></td>
</tr> 

<?php
foreach($Tot as $row) { 
    print("<tr>");
		print("<td>$row->yymmdd</td>, <td>$row->accnt</td>, <td>$row->money</td>"); 
 		print("<td><input type='text' name='foo[$row->yymmdd]' value='$row->yymmdd' /></td>");
 		print("<td><input type='text' name='foo[$row->accnt]' value='$row->accnt' /></td>");
 		print("<td><input type='text' name='foo[$row->money]' value='$row->money' /></td>");
    print("</tr>");
}
?>

<tr> 
<td colspan="6" align="center"><input type="submit" name="Submit" value="Submit"></td> 
</tr> 

</form>
</table>

</body>
</html>
