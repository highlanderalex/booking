<!DOCTYPE html>
<html>
<head>
<title>Книжный каталог</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css"  href="resources/css/style.css" />
</head>
<body>

<div id="lang">
    <form action="" method="post">
        <input type="hidden" name="lang" value="ru" />
        <input type="submit" name="change_lang" value="RU"  <?=($_SESSION['lang']=='ru') ? "class='lang-active'" : "";?> />
    </form>
    <form action="" method="post">
        <input type="hidden" name="lang" value="en" />
        <input type="submit" name="change_lang" value="EN" <?=($_SESSION['lang']=='en') ? "class='lang-active'" : "";?> />
    </form>   
</div>
	
	<div id="header" align="center">
	  <h1><a href="index.php">Booking.com</a></h1>
	</div>
	
	<div id="navigation">
		<div style="width:250px;margin:0 auto;">
			<a href="index.php"><?=$this->LANG_menu_main;?></a>
			<a href="index.php?view=author"><?=$this->LANG_menu_authors;?></a>
			<a href="index.php?view=genre"><?=$this->LANG_menu_genres;?></a>
		</div>
		<div style="float:right;margin-right:20px;">
		<?php
			if(isset($_SESSION['user']))
			{
		?>		
			<a href="index.php?view=cabinet"><?=$_SESSION['user'];?></a>
			<a href="index.php?view=destroy"><?=$this->LANG_menu_quit;?></a>
		<?php
			}
			else
			{
			?>
				<a href="index.php?view=login"><?=$this->LANG_menu_enter;?></a> 
			<?php
			}
			?>
		<a href="index.php?view=cart"><?=$this->LANG_menu_cart;?>(<?=$_SESSION['total_items'];?>) <?=$_SESSION['total_price'];?> грн.</a>
	 </div>
	</div>
	
	<div id="content-wrapper">
		<div id="content">
			<?php
				require_once ('resources/templates/'.$view.'.php');
			?>
		</div>
	</div>
	<!--div id="footer">
	  <div id="copyright" align="center">Design copyright &copy; 2014 by AlexSoft</div>
	</div-->
	
</body>
</html>
