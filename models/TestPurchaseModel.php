<?php
    include 'PurchaseModel.php';
    
    class TestPurchaseModel extends PHPUnit_Framework_TestCase
    {
        public function testreturnPurchases()
        {
            $purchases = new PurchaseModel();
            $id = 9;
            $this->assertTrue(is_array($purchases->returnPurchases($id)) || empty($purchases->returnPurchases($id)));
        }
        
        public function testinsertPurchases()
        {
            $purchases = new PurchaseModel();
            $lastId = 2;
            $idProduct = 5;
            $qty = 4;
            $price = 100;
            $this->assertTrue($purchases->insertPurchases($lastId, $idProduct, $qty, $price) > 0 );
        }        
    }

?>
