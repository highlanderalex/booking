<script type="text/javascript" src="resources/js/myscript.js">
</script>

<div>
<?php 
	if ($this->msg == '')
	{
?>
<h4>Ваши заказы</h4>
<?php
	foreach($this->userorders as $item) : 
?>
		<div class="orders" idorder="<?=$item['id'];?>">
			<b>Дата: </b><?=$item['datetime'];?>
			<b>Система оплаты</b> <?=$item['pay'];?>
			<b>Статус</b> <?=$item['status'];?><br />
			<div class="foods" style="display:none;"></div>
		</div>
		
<?php 
	endforeach;
	}
	else
	{
?>
		<h3><?=$this->msg;?></h3>
<?php
	}
?>
</div>	

