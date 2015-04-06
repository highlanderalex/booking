<?php
	include 'menu.php';
?>
<div style="color:red;"><?=$error;?></div>
<?php
	if ($_GET['obj']=='book'){
?>
		<form action="index.php?view=edit_obj" method="post">
		<input type="hidden" name="id" value="<?=$item['id'];?>"><br />
		Название <input type="text" name="name" value="<?=$item['name'];?>"><br />
		Цена <input type="text" name="price" value="<?=$item['price'];?>"><br />
		Фото <input type="text" name="image" value="<?=$item['image'];?>"><br />
		Описание<br /><textarea name="description" cols="50" rows="20"><?=$item['description'];?></textarea><br />
		Авторы<br />
		<select name="authors[]" multiple="multiple">
		<?php
			foreach($allauthors as $myrow1):
				$flag = false;
				//$result2 = get_book_authors($id);
				foreach($authorsbook as $myrow2):
					if ( $myrow1['id'] != $myrow2['id'] )
					{
						continue;
					} 
					else 
					{
						$flag = true;
						break;
					}
				endforeach;
				if (!$flag)
				{
			?>
					<option value="<?=$myrow1['id'];?>"><?=$myrow1['name'];?></option>
			<?php
				} 
				else 
				{
			?>
					<option value="<?=$myrow1['id'];?>" selected><?=$myrow1['name'];?></option>
			<?php
				}
			endforeach;
		?>
		</select>
		<br />
		Жанры<br />
		<select name="genres[]" multiple="multiple">
		<?php
			foreach($allgenres as $myrow1):
				$flag = false;
				foreach( $genresbook as $myrow2 ):
					if ($myrow1['id'] != $myrow2['id'])
					{
						continue;
					} else 
					{
						$flag = true;
						break;
					}
				endforeach;
				if (!$flag)
				{
			?>
					<option value="<?=$myrow1['id'];?>"><?=$myrow1['name'];?></option>
			<?php
				} 
				else 
				{
			?>
					<option value="<?=$myrow1['id'];?>" selected><?=$myrow1['name'];?></option>
			<?php
				}
			endforeach;
		?>
		</select>
		<br />
		<input type="submit" name="edit_book" value="Обновить данные">
		</form>
<?php
	}
	
	if ($_GET['obj']=='genre'){
?>
		<form action="index.php?view=edit_obj" method="post">
		<input type="hidden" name="id" value="<?=$item['id'];?>">
		Название <input type="text" name="name" value="<?=$item['name'];?>"><br />
		<input type="submit" name="edit_genre" value="Обновить данные">
		</form>
<?php
	}
	
	if ($_GET['obj']=='author'){
?>
		<form action="index.php?view=edit_obj" method="post">
		<input type="hidden" name="id" value="<?=$item['id'];?>">
		Название <input type="text" name="name" value="<?=$item['name'];?>"><br />
		<input type="submit" name="edit_author" value="Обновить данные">
		</form>
<?php
	}
?>
