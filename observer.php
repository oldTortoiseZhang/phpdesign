<?php
/**
 * Created by PhpStorm.
 * User: zhangmin
 * Date: 2017/5/17
 * Time: 09:28
 * 设计模式之观察者模式
 * 一个目标物件管理所有相依于它的观察者物件，并且在它本身的状态改变时主动发出通知。这通常透过呼叫各观察者所提供的方法来实现。
 * 使用场景 订阅信息，消息推送
 */


/**
 * 抽象通知者
 */
abstract class Subject{
    private $observers = array();

    public function Attach($observer) {
        array_push($this->observers, $observer);
    }

    public function Detach($observer) {
        foreach ($this->observers as $k=>$v) {
            if ($v == $observer) {
                unset($this->observers[$k]);
            }
        }
    }

    public function Notify() {
        foreach ($this->observers as $k=>$v) {
            $v->Update();
        }
    }
}

/**
 * 具体通知者
 */
class ConcreteSubject extends Subject{
    public $subject_state;
}

/**
 * 抽象观察者
 */
abstract class Observer{
    public abstract function Update();
}

/**
 * 具体观察者
 */
class ConcreteObserver extends Observer{
    #观察者名称
    private $name;
    #推送内容
    private $observerState;
    #通知者实例，作用是保证大家都在同一频道内
    public $subject;

    # 初始化成员属性
    public function __construct($_sub, $_name) {
        $this->name = $_name;
        $this->subject = $_sub;
    }

    public function Update() {
        // TODO: Implement Update() method.
        $this->observerState = $this->subject->subject_state;
        echo "观察者：" .$this->name. "接受到的内容是:" .$this->observerState. "<br/>";
    }
}

$demo = new ConcreteSubject();

$zs = new ConcreteObserver($demo, '张三');
$ls = new ConcreteObserver($demo, '李四');

$demo->Attach($zs);
$demo->Attach($ls);

$demo->subject_state = '老板来了!';
$demo->Notify();