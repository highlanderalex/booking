<div style="color:red;"><?=$error;?></div>
<h4>Ваш заказ</h4>
<form action="index.php?view=order" method="post">
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
	<h5>Оплатить: <?=$_SESSION['total_price']-$_SESSION['total_price']*$discont;?> грн.</h5>
	Выберите систему оплаты
	<select name="pay" size="1">
		<option value="0" checked>Системы оплаты</option>
	<?php
		foreach($payment as $item) : 
		
	?>
		<option value="<?=$item['id'];?>"><?=$item['pay'];?></option>
	<?php endforeach;?>
	</select>
	<input type="submit" class="btn btn-success" value="Заказать">
	</form>