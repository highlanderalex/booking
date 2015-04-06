<div style="color:red;"><?=$error;?></div>
<h4>Ваш заказ</h4>
<table class="table table-striped">
	<tr>
		<td>Наименование</td>
		<td>Количество</td>
		<td>Цена</td>
		<td>Сумма</td>
	</tr>
<?php
	foreach($products as $item) : 
?>
		<tr>
			<td><?=$item['name'];?></td>
			<td><?=$item['qty'];?></td>
			<td><?=$item['price'];?> грн.</td>
			<td><?=number_format($item['price']*$item['qty'], 2);?> грн.</td>
		</tr>
<?php endforeach;?>
	</table>
	<h5>Сумма Заказа: <?=$_SESSION['total_price'];?> грн.</h5>
	<h5>Ваша скидка: <?=$discont*100;?> %</h5>
	<h5>Оплатить: <?=number_format($_SESSION['total_price']-$_SESSION['total_price']*$discont, 2);?> грн.</h5>
	<form action="index.php?view=order" method="post">
	Выберите систему оплаты
	<select name="pay" size="1">
	<?php
		$i = 1;
		foreach($payment as $item) : 
	?>
		<option value="<?=$item['id'];?>" <?=( 1!= $i) ? '' : 'checked';?>><?=$item['pay'];?></option>
	<?php 
		$i++;
		endforeach;?>
	</select>
	<input type="submit" class="btn btn-success" value="Купить" name="buy">
	</form>
