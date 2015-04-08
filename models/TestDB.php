<?php
    include 'DB.php';
    
    class TestDB extends PHPUnit_Framework_TestCase
    {
        public function testrun()
        {
            $obj1 = DB::run();
            $obj2 = DB::run();
            $this->assertTrue( $obj1 == $obj2 );
        }           
        
        public function testSelect()
        {
            $fld = 'id, name';
            $this->assertInstanceOf('DB', DB::run()->Select($fld));
        }           
        
        public function testDelete()
        {
            $this->assertInstanceOf('DB', DB::run()->Delete());
        }           
        
        public function testInsert()
        {
            $tbl = 'cart';
            $this->assertInstanceOf('DB', DB::run()->Insert($tbl));
        }           
        
        public function testUpdate()
        {
            $tbl = 'cart';
            $this->assertInstanceOf('DB', DB::run()->Update($tbl));
        }           
        
        public function testSet()
        {
            $exp = 'id=5';
            $this->assertInstanceOf('DB', DB::run()->Set($exp));
        }           
        
        public function testFields()
        {
            $arr['idUser'] = 3;
            $arr['idProducts'] = 3;
            $this->assertInstanceOf('DB', DB::run()->Fields($arr));
        }           
        
        public function testValues()
        {
            $arr['idUser'] = 3;
            $arr['idProducts'] = 3;
            $this->assertInstanceOf('DB', DB::run()->Values($arr));
        }           
        
        public function testFrom()
        {
            $tbl = 'cart';
            $this->assertInstanceOf('DB', DB::run()->From($tbl));
        }
        
        public function testInnerJoin()
        {
            $tbl = 'cart';
            $this->assertInstanceOf('DB', DB::run()->InnerJoin($tbl));
        }           
        
        public function testOn()
        {
            $exp = 'idProduct=2';
            $this->assertInstanceOf('DB', DB::run()->On($exp));
        }           
        
        public function testJoin()
        {
            $tbl = 'cart';
            $this->assertInstanceOf('DB', DB::run()->Join($tbl));
        }           
        
        public function testWhere()
        {
            $exp = 'idProduct=';
            $this->assertInstanceOf('DB', DB::run()->Where($exp));
        }           
        
        public function testI()
        {
            $exp = 'idProduct=2';
            $this->assertInstanceOf('DB', DB::run()->I($exp));
        }           
        
        public function testOrder()
        {
            $fld = 'id';
            $this->assertInstanceOf('DB', DB::run()->Order($exp));
        }           
        
        public function testDesc()
        {
            $this->assertInstanceOf('DB', DB::run()->Desc());
        } 
        
        public function testLimit()
        {
            $this->assertInstanceOf('DB', DB::run()->Limit(1));
        }
        
        public function testExecute()
        {
            $this->assertInstanceOf('DB',DB::run()->Select('id, name')
                                                ->From('books'));
        }



    }

?>
