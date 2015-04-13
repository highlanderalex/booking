<?php
 if ($_SESSION['total_items'] != 0)
 {
?>
<h4>Ваша корзина</h4>
<table class="table table-striped">
	<tr>
		<td>Наименование</td>
		<td>Количество</td>
		<td>Цена</td>
		<td>Сумма</td>
		<td>Удалить</td>
	</tr>
<?php
	
	foreach($this->products as $item) : 
		//$item = $books->getBook($id);	
?>
		<tr>
			<td><?=$item['name'];?></td>
            <td>
                <form action="index.php?view=updateCart" method="post">
                <input type="hidden"  name="id" value="<?=$item['idProduct'];?>">
                <input type="number" name="qty" value="<?=$item['qty'];?>" min="1" max="100">
                <input type="submit" class="btn btn-primary"  name="updatecart" value="Обновить">
                </form>
            </td>
			<td><?=$item['price'];?> грн.</td>
			<td><?=number_format($item['price']*$item['qty'], 2);?> грн.</td>
			<td><a href="index.php?view=delFromCart&id=<?=$item['idProduct'];?>">Удалить</a></td>
		</tr>
<?php endforeach;?>
	</table>
	<h3>Общая сумма Заказа: <?=$_SESSION['total_price'];?> грн.</h3>
	<br /><br />
	<a href="index.php?view=order">Перейти к заказу</a>
<?php
}
else
{
?>
<h4>Ваша корзина пуста</h4>
<?php
}
?>
