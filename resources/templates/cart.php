<?php
 if ($_SESSION['total_items'] != 0)
 {
?>
<h4>Ваша корзина</h4>
<form action="index.php?view=updateCart" method="post">
<table class="table table-striped">
	<tr>
		<td>Наименование</td>
		<td>Количество</td>
		<td>Цена</td>
		<td>Сумма</td>
		<td>Удалить</td>
	</tr>
<?php
	
	foreach($products as $item) : 
		//$item = $books->getBook($id);	
?>
		<tr>
			<td><?=$item['name'];?></td>
			<td><input type="text" name="qty" value="<?=$item['qty'];?>" maxlength="2" size="5"></td>
			<td><?=$item['price'];?> грн.</td>
			<td><?=number_format($item['price']*$item['qty'], 2);?> грн.</td>
			<td><a href="index.php?view=delFromCart&id=<?=$item['idProduct'];?>">Удалить</a></td>
		</tr>
<?php endforeach;?>
	</table>

	<h3>Общая сумма Заказа: <?=$_SESSION['total_price'];?> грн.</h3>
	<input type="submit" class="btn btn-primary" value="Обновить">
	</form>
	<br /><br />
	<a href="index.php?view=order">Перейти к заказу</a>
<?php
}
else
{
	print '<h4>Ваша корзина пуста</h4>';
}
?>