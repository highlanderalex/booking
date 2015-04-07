<?php
    include 'OrderModel.php';
    
    class TestOrderModel extends PHPUnit_Framework_TestCase
    {
        public function testreturnOrders()
        {
            $orders = new OrderModel();
            $id = 1;
            $this->assertTrue(is_array($orders->returnOrders($id)) || empty($orders->returnOrders($id)));
        }
        
        public function testinsertOrder()
        {
            $orders = new OrderModel();
            $arr['idUser'] = 2;
            $arr['idPay'] = 2;
            $this->assertTrue($orders->insertOrder($arr) > 0 );
        }

        public function testreturnLastId()
        {
            $orders = new OrderModel();
            $this->assertTrue($orders->returnLastId() > 0 );
        }   
        
    }

?>
