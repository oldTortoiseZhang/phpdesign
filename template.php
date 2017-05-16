<?php
/**
 * Created by PhpStorm.
 * User: zhangmin
 * Date: 2017/5/16
 * Time: 11:07
 * 设计模式之模板模式
 * 优势在 将不变的方法和多变的方法分离。
 * 模板模式准备一个抽象类，将部分逻辑以具体方法以及具体构造形式实现，然后声明一些抽象方法来迫使子类实现剩余的逻辑。
 * 不同的子类可以以不同的方式实现这些抽象方法，从而对剩余的逻辑有不同的实现。
 */

abstract Class MakePhone{
    protected $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function MakeFlow() {
        $this->MakeBattery();

        $this->MakeCamera();

        $this->MakeScreen();

        echo $this->name."手机生产完毕!<hr/>";
    }

    public abstract function MakeScreen();
    public abstract function MakeBattery();
    public abstract function MakeCamera();

}

Class Xiaomi extends MakePhone{
    public function __construct($name) {
        parent::__construct($name);
    }

    public function MakeScreen() {
        echo "夏普独家授权,".$this->name."屏幕制造完毕<br/>";
    }

    public function MakeBattery() {
        echo "经过自主研发,".$this->name."电池制造完毕<br/>";
    }

    public function MakeCamera() {
        echo "SONY独家授权,".$this->name."摄像头组装完毕<br/>";
    }
}

Class Meizu extends MakePhone{
    public function __construct($name) {
        parent::__construct($name);
    }

    public function MakeScreen() {
        echo "国产自强!".$this->name."屏幕制造完毕<br/>";
    }

    public function MakeBattery() {
        echo "国产自强,".$this->name."电池制造完毕<br/>";
    }

    public function MakeCamera() {
        echo "国产自强,".$this->name."摄像头制造完毕<br/>";
    }

}

$xiaomi = new Xiaomi('小米6');
$xiaomi->MakeFlow();

$meizu = new Meizu('魅蓝5');
$meizu->MakeFlow();









