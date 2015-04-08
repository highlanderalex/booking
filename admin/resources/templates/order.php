<script type="text/javascript" src="resources/js/myscript.js">
</script>
<?php
	include 'menu.php';
?>
<div>
<?php 
	if ($msg == '')
	{
?>
<h4>Ваши заказы</h4>
<table border="1">
<?php
	foreach($userorders as $item) : 
?>
		<tr>
			<td><div class="orders" idorder="<?=$item['id'];?>">
				<b>Дата: </b><?=$item['datetime'];?>
				<b>Система оплаты</b> <?=$item['pay'];?>
				<b>Статус</b> <?=$item['status'];?><br />
				<div class="foods" style="display:none;"></div>
			</div>
			</td>
			<td>
			<form action="index.php?view=order" method="post">
			<input type="hidden" name="idOrder" value="<?=$item['id']?>">
			<input type="hidden" name="idUser" value="<?=$_GET['id']?>">
			<select name="status" size="1">
			<?php
				$i = 1;
				foreach($allstatus as $val) :
			?>
				<option value="<?=$val['id']?>" <?=( 1 == $i )? 'checked' : '';?>><?=$val['status'];?></option>
			<?php
				$i++;
				endforeach;
			?>
			</select>
			<input type="submit" name="updStatus" value="Обновить">
			</form>
			</td>
			</tr>
			
		
<?php 
	endforeach;
?>
	</table>
<?php
	}
	else
	{
?>
		<h3><?=$msg;?></h3>
<?php
	}
?>
</div>	

