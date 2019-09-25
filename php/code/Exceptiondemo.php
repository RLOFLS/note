<?php
class EmailException extends Exception {

}
class Demo {

    public function test() {
        

        try {
            echo 'try body'.PHP_EOL;
            throw new Exception("异常");
            throw new BadMethodCallException("badMethod");
        } catch (BadMethodCallException $e) {
            echo $e->getMessage();
            echo '----------'.PHP_EOL;
        } catch (Exception $e2) {
            echo $e2->getMessage();
        }
        
    }
}
$demo = new Demo;
$demo->test();