<img src="resources/img/<?=$item['image'];?>" alt="" /><br />
<a href="index.php?view=addToCart&id=<?=$item['id'];?>">Добавить в корзину</a><br /><br />
<div class="desc_one">
	<div class="product-name"><?=$item['name'];?></div>
	<div class="product-price">Цена: <?=$item['price'];?> грн.</div>
</div>
					
<div class="description_book">
	<font style="font-weight:bold;">Автор:</font>
	<? foreach ($res_author as $myrow) :?>
	<?=$myrow['name'];?>&nbsp;
	<? endforeach;?>
	<br />
	<font style="font-weight:bold;">Жанр книги:</font>				
	<? foreach ($res_genre as $myrow) :?>
	<?=$myrow['name'];?>&nbsp;
	<? endforeach;?>
	<br />
	<font style="font-weight:bold;">Описание: </font><?=$item['description'];?>
</div><br />
<br />
					
					
