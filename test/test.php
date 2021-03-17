<?php
     class Test {
          public function __construct() {
              echo __CLASS__ . " ";
          }

          public function foo() {
              echo __FUNCTION__ . " ";
         }

         public function __call($name, $arguments) {
                   if($name !== 'foo'){
                            echo $name . " ";
            }
        }
      }

       $testObj = new Test();
       $testObj->foo();
    $testObj->bar();
   ?>

