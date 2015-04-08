<?php
	include 'menu.php';
	if ($obj=='book'){
?>
		<form action="index.php?view=ins_obj" method="post">
		Название <input type="text" name="name" value=""><br />
		Цена <input type="text" name="price" value=""><br />
		Фото <input type="text" name="image" value="no_foto.jpg"><br />
		Описание<br /><textarea name="description" cols="50" rows="20"></textarea><br />
		Авторы<br />
		<select name="authors[]" multiple="multiple">
		<?php
			$i = 1;
			foreach( $authors as $item ):
				if ($i!=1)
				{
		?>
					<option value="<?=$item['id'];?>"><?=$item['name'];?></option>
		
		<?php
				} 
				else 
				{
		?>
					<option value="<?=$item['id'];?>" selected><?=$item['name'];?></option>
		<?php
				}
				$i++;
			endforeach;
		?>
		</select>
		<br />
		Жанры<br />
		<select name="genres[]" multiple="multiple">
		<?php
			$i = 1;
			foreach( $genres as $item ):
				if ($i!=1)
				{
		?>
					<option value="<?=$item['id'];?>"><?=$item['name'];?></option>
		
		<?php
				}
				else 
				{
		?>
					<option value="<?=$item['id'];?>" selected><?=$item['name'];?></option>
		<?php
				}
				$i++;
			endforeach;
		?>
		</select>
		<br />
		<input type="submit" name="add_book" value="Добавить данные">
		</form>
<?php
	}
	
	
	if ($obj=='genre')
	{
?>
		<form action="index.php?view=ins_obj" method="post">
		Введите жанр <input type="text" name="name" value=""><br />
		<input type="submit" name="add_genre" value="Добавить данные">
		</form>
<?php
	}
	
	
	if ($obj=='author')
	{
?>
		<form action="index.php?view=ins_obj" method="post">
		Введите автора <input type="text" name="name" value=""><br />
		<input type="submit" name="add_author" value="Добавить данные">
		</form>
<?php
	}
	