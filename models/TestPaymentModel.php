<?php
    include 'PaymentModel.php';
    
    class TestPaymentModel extends PHPUnit_Framework_TestCase
    {
        public function testreturnPayment()
        {
            $pay = new PaymentModel();
            $this->assertTrue(is_array($pay->returnPayment()));
            $this->assertEmpty(array($pay->returnPayment()));
        }
    }

?>
