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
<form name="form1" method="post" action="sort-backend.php">
<tr> 
<td><strong>yymmdd</strong></td> 
<td><strong>accnt</strong></td> 
<td><strong>money</strong></td>
</tr> 

<?php
foreach($Tot as $row) { ?>
	<tr>
		<td><?php echo $row->yymmdd ?></td>
		<td><?php echo $row->accnt ?></td>
		<td><?php echo $row->money ?></td>
    	<td><input type="text" name="foo[<?php echo $row->yymmdd; ?>]" value='<?php echo $row->yymmdd;?>' /></td>
    	<td><input type="text" name="foo[<?php echo $row->accnt; ?>]" value='<?php echo $row->accnt;?>' /></td>
    	<td><input type="text" name="foo[<?php echo $row->money; ?>]" value='<?php echo $row->money;?>' /></td>
	</tr>
<? } 
?>

<tr> 
<td colspan="6" align="center"><input type="submit" name="Submit" value="Submit"></td> 
</tr> 

</form>
</table>
