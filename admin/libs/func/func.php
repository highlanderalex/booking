<?php
		function __autoload($class)
		{
			if (file_exists(dirname(__FILE__) . '/../../controllers/'.$class.'.php') ) 
			{
				require_once (dirname(__FILE__) . '/../../controllers/'.$class.'.php');
			}
			
			if (file_exists(dirname(__FILE__) . '/../class/'.$class.'.php') ) 
			{
				require_once (dirname(__FILE__) . '/../class/'.$class.'.php');
			}
		}
	
		function redirect($view)
		{
			header('Location: index.php?view=' . $view);
		}
		
		function checkId($id)
		{
			if( preg_match("/^[0-9]+$/",$id) && $id > 0 )
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	
		function addFile()
		{
			$root =  'resources/img';
			$max_width = 150;
			$max_height = 200;
			$max_size = 20480;
			
			$upfile = $_FILES['upfile']['tmp_name'];
			$upfile_name = $_FILES['upfile']['name'];
			$upfile_size = $_FILES['upfile']['size'];
			
			if (!$upfile)
			{
				$error = 'Нет файла для загрузки';
				return $error;
			}
			
			$file_types = array("image/jpeg"=>"jpg", "image/pjpeg"=>"jpg");
			$width = null;
			$height = null;
			$img_info = getimagesize($upfile);
			$upfile_type = $img_info['mime'];
			list($width, $height, $t, $attr) = $img_info;
			
			if (!isset($file_types[$upfile_type]))
			{
				$error = 'Картинка должна быть в формате JPEG, JPG';
				return $error;
			}
			
			if ($upfile_size > $max_size){
				$error = 'Картинка должна быть не более 20КБ';
				return $error;
			}
			
			if ($width!=$max_width || $height!=$max_height)
			{
				$error = 'Размер должен быть 150х200px';
				return $error;
			}
			
			$new_fullpath = "$root/$upfile_name";
			
			if (file_exists($new_fullpath))
			{
				$error = 'Файл с таким именем уже существует не перезаписуем!';
				return $error;
			}
			
			if (!copy($upfile, $new_fullpath))
			{
				$error = 'Ошибка копирования!';
				return $error;
			} 
			else 
			{
				$error = 'Файл успешно скопирован';
				return $error;
			}		
		}
