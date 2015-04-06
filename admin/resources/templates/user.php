<?php
	include 'menu.php';
?>
<table cellpadding="0" cellspacing="0" border="0" width="550px">
<?php
	//$obj = 'book';
	foreach($users as $item) :	
?>
	<tr>
		<td valign="top" width="10%"><?=$item['id']?></td>
		<td valign="top" width="50%"><?=$item['name'];?></td>
		<td valign="top" width="50%"><?=$item['email'];?></td>
		<td valign="top" width="30%"><a href="index.php?view=order&id=<?=$item['id']?>">Заказы</a></td>
	</tr>
<?php
	endforeach;
?>
</table>