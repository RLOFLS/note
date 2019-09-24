<?php

interface IEmployee {
    public function working();
}

class Teacher implements IEmployee {

    public function working()
    {
        echo '教书'.PHP_EOL;
    }
}

class Manager implements IEmployee {

    public function working()
    {
        echo '管理'.PHP_EOL;
    }
}

class Work {

    public static function doWork(IEmployee $employee) {
        $employee->working();
    }
}

$teacher = new Teacher();
$manager = new Manager();

Work::doWork($teacher);
Work::doWork($manager);