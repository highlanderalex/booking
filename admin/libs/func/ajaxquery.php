<?php
require_once ('func.php');
if(isset($_GET['id']))
{
	$id = $_GET['id'];
	$food = new PurchaseController();
	$data = $food->getPurchases($id);
	echo json_encode($data);
}
			
?>