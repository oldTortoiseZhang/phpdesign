<?php
/**
 * Created by PhpStorm.
 * User: zhangmin
 * Date: 2017/5/18
 * Time: 15:32
 * 设计模式之访问者模式
 * 使用场景：实体是固定的，但行为却是多变的
 */
header("Content-type: text/html; charset=utf-8");

/*吕治会装逼时,没人能拦得住他;姜智装逼时,大家怒怼他一脸
吕治会被cao时,大家都在鼓掌;姜智被cao时,路过一只吃瓜土狗*/

//抽象状态
abstract class State{
    protected $state_name;      //状态名称

    //得到吕治会的反应
    public abstract function GetLzhAction($element);

    //得到姜智的反应
    public abstract function GetJzAction($element);

}

//装逼状态
class Zhuangbi extends State{

    public function __construct(){
        $this->state_name = '装逼';
    }

    public function GetJzAction($element)
    {
        // TODO: Implement GetJzAction() method.
        echo "{$element->name}{$this->state_name}时,大家怒怼他一脸!!!<br>";
    }

    public function GetLzhAction($element)
    {
        // TODO: Implement GetLzhAction() method.
        echo "{$element->name}{$this->state_name}时,没人能拦得住他...<br>";
    }
}

//装逼状态
class Beicao extends State{

    public function __construct(){
        $this->state_name = '被cao';
    }

    public function GetJzAction($element)
    {
        // TODO: Implement GetJzAction() method.
        echo "{$element->name}{$this->state_name}时,路过一只吃瓜土狗...<br>";
    }

    public function GetLzhAction($element)
    {
        // TODO: Implement GetLzhAction() method.
        echo "{$element->name}{$this->state_name}时,大家都在鼓掌!!!<br>";
    }
}

//抽象状态
abstract class Person{
    public $name;

    public abstract function Accept($visitor);
}

//LZH
class LZH extends Person{

    public function __construct()
    {
        $this->name = '吕治会';
    }

    public function Accept($visitor)
    {
        // TODO: Implement Accept() method.
        $visitor->GetLzhAction($this);
    }
}

//JZ
class JZ extends Person{

    public function __construct()
    {
        $this->name = '姜智';
    }

    public function Accept($visitor)
    {
        // TODO: Implement Accept() method.
        $visitor->GetJzAction($this);
    }
}

//结构对象类，用于聚合实体信息
class ObjectStruct{

    private $elements=array();
    //增加
    public function Add($element)
    {
        array_push($this->elements,$element);
    }
    //移除
    public function Remove($element)
    {
        foreach($this->elements as $k=>$v)
        {
            if($v==$element)
            {
                unset($this->elements[$k]);
            }
        }
    }
    //查看显示
    public function Display($visitor) {
        foreach ($this->elements as $v) {
            $v->Accept($visitor);
        }
    }
}

$os = new ObjectStruct();
$os->Add(new LZH());
$os->Add(new JZ());

$zb = new Zhuangbi();
$os->Display($zb);

$bc = new Beicao();
$os->Display($bc);
