<html>
<head>

<meta charset="utf-8">
<title>tot</title>

<!-- **Favicon** -->
<link href="https://waffle.at/wp-content/uploads/2013/08/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
<link id="default-css" href="https://waffle.at/wp-content/themes/waffle/style.css" rel="stylesheet" media="all" />

<link rel="stylesheet" type="text/css" href="/css/style.css">


</head>
<body>

@php
	$altDB1;	
	$altDB2;
	switch ($targetDB) {
		case "mysql":		$altDB1 = "sqlite"; $altDB2 = "postgres"; break; 
		case "sqlite":		$altDB1 = "mysql"; $altDB2 = "postgres"; break; 
		case "postgres": 	$altDB1 = "sqlite"; $altDB2 = "mysql"; break; 
	}
@endphp

<div class="w3-container">
<table width=100%> <tr> 
<td align="left"> 

@if ($targetDB=="mysql") 
target: <font color="green"> mysql 		</font>  | 
		<font color="grey">  <a href='/tots/settar/sqlite'>sqlite</a> 	</font>  |
		<font color="grey">  <a href='/tots/settar/postgres'>postges</a> 	</font>  
@elseif ($targetDB=="sqlite") 
target:	<font color="grey">  <a href='/tots/settar/mysql'>mysql</a> 	</font>  |
		<font color="green">  sqlite 	</font>  |
		<font color="grey">  <a href='/tots/settar/postgres'>postges</a> 	</font>  
@else
target:	<font color="grey">  <a href='/tots/settar/mysql'>mysql</a> 	</font>  |
		<font color="grey">  <a href='/tots/settar/sqlite'>sqlite</a> 	</font>  |
		<font color="green">  postgres  	</font>
@endif

</td> 
<td align="right">
<a href="/tots/daily">daily</a> |
<a href="/tots/today">today</a> |
<a href="/tots/detail">detail</a> |
<a href="/tots/accnt/kw">kw</a> |
<a href="/tots/accnt/wr1">wr1</a> |
<a href="/tots/accnt/wr2">wr2</a> |
<a href="/tots/accnt/hd">hd</a> |
<a href="/tots/accnt/ha">ha</a> |
<a href="/tots/accnt/wo">wo</a> |
<a href="/tots/accnt/xi">xi</a> |
<a href="/tots/accnt/ok">ok</a> |
<a href="/tots/totf">totf</a> |
<a href="/tots/pub">pub </a> |
<a href="/tots/sync">sync </a> |
<a href="/tots/serialize">serialize </a> |
<a href="/tots/email">email</a> |
<a href="/static/mall/index.html">shop </a>

</td></tr></table>
</div>
