<?php
	foreach ($result as $item) :
?>
<p><a href="index.php?view=book&id=<?=$item['id']?>" class="drop-shadow"><img src="resources/img/<?=$item['image'];?>" alt="" /></a></p>
<?php
	endforeach;
?>