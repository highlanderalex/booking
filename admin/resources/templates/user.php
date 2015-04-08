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
		<td valign="top" width="20%"><?=$item['name'];?></td>
		<td valign="top" width="20%"><?=$item['email'];?></td>
		<td valign="top" width="10%"><?=$item['discont']*100;?>%</td>
		<td valign="top" width="10%"><a href="index.php?view=order&id=<?=$item['id']?>">Заказы</a></td>
		<td valign="top" width="30%">
			<form action="index.php?view=user" method="post">
			<input type="hidden" name="id" value="<?=$item['id']?>">
			<select name="discont" size="1">
			<?php
				$i = 1;
				foreach($alldiscont as $val) :
			?>
				<option value="<?=$val['id']?>" <?=( 1 == $i )? 'checked' : '';?>><?=$val['discont']*100;?>%</option>
			<?php
				$i++;
				endforeach;
			?>
			</select>
			<input type="submit" name="updDiscont" value="Обновить">
			</form>
		</td>
	</tr>
<?php
	endforeach;
?>
</table>