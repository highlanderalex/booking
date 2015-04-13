|
<?php
	foreach ($this->authors as $item) :
?>
	<a href="index.php?view=author&id=<?=$item['author_id']?>"> <?=$item['name'];?></a> | 

<?php
	endforeach;
?>
<hr />
<?php
	foreach ($this->result as $item) :
?>
	<p><a href="index.php?view=book&id=<?=$item['id']?>" class="drop-shadow"><img src="resources/img/<?=$item['image'];?>" alt="" /></a></p>
<?php
	endforeach;
?>