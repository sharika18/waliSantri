<?php
    class Testclass

    {
        private $testvar = "default value";
    
        public function setTestvar($testvar) { 
            $this->testvar = $testvar; 
        }
        public function getTestvar() { 
            return $this->testvar; 
        }
    
        function dosomething()
        {
            echo $this->getTestvar();
        }
    }
    
    
?>