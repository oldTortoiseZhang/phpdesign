<?php
/**
 * Created by PhpStorm.
 * User: zhangmin
 * Date: 2017/5/16
 * Time: 11:07
 * 设计模式之策略模式
 * 策略模式定义了一系列的算法，并将每一个算法封装起来，而且使它们还可以相互替换。
 * 策略模式让算法独立于使用它的客户而独立变化，即封装变化的算法。
 */

/**
 * 抽象策略类
 * 派生出相关的算法和行为
 */
abstract class RotateItem{
    public abstract function inertiaRotate();

    public abstract function unInertisRotate();
}

/**
 * 策略角色类 - X
 */
class XItem extends RotateItem{
    public function inertiaRotate()
    {
        // TODO: Implement inertiaRotate() method.
        echo "我是X产品，aaa。<br/>";
    }

    public function unInertisRotate()
    {
        // TODO: Implement unInertisRotate() method.
        echo "我是X产品，bbb。<br/>";
    }

}

/**
 * 策略角色类 - Y
 */
class YItem extends RotateItem{
    public function inertiaRotate()
    {
        // TODO: Implement inertiaRotate() method.
        echo "我是Y产品，aaa。<br/>";
    }

    public function unInertisRotate()
    {
        // TODO: Implement unInertisRotate() method.
        echo "我是Y产品，bbb。<br/>";
    }

}

/**
 * 策略角色类 - Z
 */
class ZItem extends RotateItem{
    public function inertiaRotate()
    {
        // TODO: Implement inertiaRotate() method.
        echo "我是Z产品，aaa。<br/>";
    }

    public function unInertisRotate()
    {
        // TODO: Implement unInertisRotate() method.
        echo "我是Z产品，bbb。<br/>";
    }
}

/**
 * 环境角色类 - 通过这个类调用对应的策略算法
 */
class contexItem{
    #用户存储一个策略类的引用，最终返还给客户端调用。
    private $item;

    public function getItem($item_name, $func_name) {
        try{
            #建立$item_name这个类的反射类
            $class = new ReflectionClass($item_name);
            #实例化$item_name类
            $this->item = $class->newInstance();
            #调用$func_name这个方法
            $this->item->$func_name();
        }catch(ReflectionException $e){
            $this->item = "";
        }
    }
}

$strategy = new contexItem();

$strategy->getItem('XItem', 'inertiaRotate');

$strategy->getItem('YItem', 'unInertisRotate');


