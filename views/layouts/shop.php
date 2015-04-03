<!DOCTYPE html>
<html>
<head>
<title>Книжный каталог</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<link rel="stylesheet" type="text/css"  href="resources/css/style.css" />
<!--script type="text/javascript"  src="resources/js/formvalidate.js"></script-->
</head>
<body>	
	<div id="header" align="center">
	  <h1><a href="index.php">Booking.com</a></h1>
	</div>
	
	<div id="navigation">
		<div style="width:250px;margin:0 auto;">
			<a href="index.php">Главная</a>
			<a href="index.php?view=author">Авторы</a>
			<a href="index.php?view=genre">Жанры</a>
		</div>
		<div style="float:right;margin-right:20px;">
		<?php
			if($_SESSION['user'])
			{
		?>		
			<a href="index.php?view=cabinet"><?=$_SESSION['user'];?></a>
			<a href="index.php?view=destroy">Выход</a>
		<?php
			}
			else
			{
			?>
				<a href="index.php?view=login">Вход</a> 
			<?php
			}
			?>
		<a href="index.php?view=cart">Корзина(<?=$_SESSION['total_items'];?>) <?=$_SESSION['total_price'];?> грн.</a>
	 </div>
	</div>
	
	<div id="content-wrapper">
		<div id="content">
			<?php
				require_once ('resources/templates/'.$view.'.php');
			?>
		</div>
	</div>
	<div id="footer">
	  <div id="copyright" align="center">Design copyright &copy; 2014 by AlexSoft</div>
	</div>
	
</body>
</html>
