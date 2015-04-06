<?php
	include 'menu.php';
?>
<div style="color:red;"><?=$error;?></div>
<table cellpadding="0" cellspacing="0" border="0" width="550px">
<?php
	$obj = 'genre';
	foreach ($genres as $item) :	
?>
	<tr>
		<td valign="top" width="10%"><?=$item['id']?></td>
		<td valign="top" width="50%"><?=$item['name'];?></td>
		<td valign="top" width="30%" ><a href="index.php?view=edit&id=<?=$item['id']?>&obj=<?=$obj;?>">Редактировать</a></td>
		<td valign="top" width="10%"><a href="index.php?view=del_obj&id=<?=$item['id']?>&obj=<?=$obj;?>">Удалить</a></td>
	</tr>
<?php
	endforeach;
?>
</table>