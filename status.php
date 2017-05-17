<?php
/**
 * Created by PhpStorm.
 * User: zhangmin
 * Date: 2017/5/16
 * Time: 13:52
 * 设计模式之状态模式
 * 使用场景 大量和对象状态相关的条件语句
 * 状态模式当一个对象的内在状态改变时允许改变其行为，这个对象看起来像是改变了其类。
 * 状态模式主要解决的是当控制一个对象状态的条件表达式过于复杂时的情况。
 * 把状态的判断逻辑转移到表示不同状态的一系列类中，可以把复杂的判断逻辑简化。
 */

header("Content-type: text/html; charset=utf-8");

/**
 * 状态接口
 */
interface IState{
    function WriteCode($work);
}

/**
 * 上午状态
 */
class AmState implements IState{

    public function WriteCode($work)
    {
        // TODO: Implement WriteCode() method.
        if ($work->hour <= 11 && $work->hour >= 8) {
            echo "当前时间:{$work->hour}点,疯狂码代码中!<br/>";
        } else {
            $work->SetState(new NmState());
            $work->WriteCode();
        }
    }
}

/**
 * 中午状态
 */
class NmState implements IState{

    public function WriteCode($work)
    {
        // TODO: Implement WriteCode() method.
        if ($work->hour >= 12 && $work->hour <= 13) {
            echo "当前时间:{$work->hour}点,午休中!<br/>";
        } else {
            $work->SetState(new PmState());
            $work->WriteCode();
        }
    }
}

/**
 * 下午状态
 */
class PmState implements IState{

    public function WriteCode($work)
    {
        // TODO: Implement WriteCode() method.
        if ($work->hour > 13 && $work->hour <= 17) {
            echo "当前时间:{$work->hour}点,怎么还不下班!<br/>";
        } else {
            $work->SetState(new NightState());
            $work->WriteCode();
        }
    }
}

/**
 * 晚上状态
 */
class NightState implements IState{

    public function WriteCode($work)
    {
        // TODO: Implement WriteCode() method.
        if ($work->hour > 17 && $work->hour <= 23) {
            echo "当前时间:{$work->hour}点,LOL努力上分中!<br/>";
        } else {
            $work->SetState(new SleepState());
            $work->WriteCode();
        }
    }
}

/**
 * 睡觉状态
 */
class SleepState implements IState{

    public function WriteCode($work)
    {
        // TODO: Implement WriteCode() method.
        if ($work->hour > 23 || $work->hour < 8) {
            echo "当前时间:{$work->hour}点,宝宝睡觉中!<br/>";
        } else {
            $work->SetState(new PmState());
            $work->WriteCode();
        }
    }
}

/**
 * 处理状态类
 */
class Work{
    public $hour;
    private $current;

    #默认第一个状态
    public function __construct() {
        $this->current = new AmState();
    }

    #切换状态
    public function SetState($work) {
        $this->current = $work;
    }

    #调用方法
    public function WriteCode() {
        $this->current->WriteCode($this);
    }

}

$work = new Work();
$work->hour = 16;
$work->WriteCode();

$work->hour = 20;
$work->WriteCode();

$work->hour = 16;
$work->WriteCode();

$work->hour = 2;
$work->WriteCode();