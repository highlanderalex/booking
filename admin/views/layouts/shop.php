<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Книжный каталог</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
</head>

<body>
<center>
	<!--Content-->
	<table width="780px" border="0" bgcolor="#FFFFFF" cellpadding="0" cellspacing="0">
		<tr>
			<td bgcolor="#EEEEEE" valign="top" align="center">
			<?php
				require_once 'resources/templates/'.$view.'.php';
			?>
			
			</td>
		</tr>
		<tr>
		<td bgcolor="#EEEEEE">&nbsp;</td>
		</tr>
	</table>
	
	<!--Footer-->
	<!--table width="780px" border="0" bgcolor="#FFFFFF" cellpadding="0" cellspacing="0">
		<tr height="25px">
			<td>
				<p align="center">&#169; Copyright 2014</p>
			</td>
		</tr>
	</table-->
</center>		
</body>
</html>