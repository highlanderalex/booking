<img src="resources/img/<?=$this->item['image'];?>" alt="" /><br />
<a href="index.php?view=addToCart&id=<?=$this->item['id'];?>">Добавить в корзину</a><br /><br />
<div class="desc_one">
	<div class="product-name"><?=$this->item['name'];?></div>
	<div class="product-price">Цена: <?=$this->item['price'];?> грн.</div>
</div>
					
<div class="description_book">
	<font style="font-weight:bold;">Автор:</font>
	<? foreach ($this->res_author as $myrow) :?>
	<?=$myrow['name'];?>&nbsp;
	<? endforeach;?>
	<br />
	<font style="font-weight:bold;">Жанр книги:</font>				
	<? foreach ($this->res_genre as $myrow) :?>
	<?=$myrow['name'];?>&nbsp;
	<? endforeach;?>
	<br />
	<font style="font-weight:bold;">Описание: </font><?=$this->item['description'];?>
</div><br />
<br />
					
					
