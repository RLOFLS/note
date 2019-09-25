<?php
/**
 * 电话
 */

class Phone {
    /**
     * 打电话
     */
    public function call($phone) {
        echo '正在向：'.$phone . ' 拨打电话'.PHP_EOL;
    }
}

//现在在拨打电话的时候需要播放铃声
class PhoneDecoration {

    private $phone = null; //电话实体

    public function __construct(Phone $phone)
    {
        $this->phone = $phone;
    }

    public function call($phone){
        $this->phone->call($phone);
        echo '播放拨打电话铃声'.PHP_EOL;
    }
}

$phone = new Phone();
$phoneDecoration = new PhoneDecoration($phone);
$phoneDecoration->call('123141414');

