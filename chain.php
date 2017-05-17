<?php
/**
 * Created by PhpStorm.
 * User: zhangmin
 * Date: 2017/5/17
 * Time: 11:26
 * 设计模式之职责链模式
 * 使用场景：
 * 1、当不确定该使用某个处理对象时，可动态指定一组对象来进行业务处理。
 * 2、当需要进行任务层级递交处理时，可以进行上级关联，进行业务递交申请。
 */

/**
 * 模拟一个 业务实例
 */
class Request{
    public $user;               // 业务员
    public $num;                // 请假天数
    public $requestType;        // 业务类型
    public $requestMsg;         // 业务内容
}

/**
 * 抽象管理者
 */
abstract class Manager{
    protected $name;

    protected $manager;         // 管理者上级

    public function __construct($_name) {
        $this->name = $_name;
    }

    public function SetHeader($_manager) {
        $this->manager = $_manager;
    }

    public abstract function Apply($_reg);
}


/**
 * 经理
 */
class CommonManager extends Manager{
    public function __construct($_name)
    {
        parent::__construct($_name);
    }


    public function Apply($_reg)
    {
        // TODO: Implement Apply() method.
        if ($_reg->requestType == '请假' && $_reg->num <= 2) {
            echo "{$this->name}:{$_reg->user}{$_reg->requestMsg}申请{$_reg->requestType}{$_reg->num}天,被批准<br>";
        } else {
            if (isset($this->manager)) {
                $this->manager->Apply($_reg);
            }
        }
    }
}

/**
 * 总监
 */
class MajorDomo extends Manager{
    public function __construct($_name)
    {
        parent::__construct($_name);
    }

    public function Apply($_reg)
    {
        // TODO: Implement Apply() method.
        if ($_reg->requestType == '请假' && $_reg->num <= 5) {
            echo "{$this->name}:{$_reg->user}{$_reg->requestMsg}申请{$_reg->requestType}{$_reg->num}天,被批准<br>";
        } else if ($_reg->requestType == '加薪' && $_reg->num <= 200) {
            echo "{$this->name}:{$_reg->user}{$_reg->requestMsg}申请{$_reg->requestType}{$_reg->num},被批准<br>";
        } else {
            if (isset($this->manager)) {
                $this->manager->Apply($_reg);
            }
        }
    }
}

/**
 * CEO
 */
class GeneralManager extends Manager{
    public function __construct($_name)
    {
        parent::__construct($_name);
    }

    public function Apply($_reg)
    {
        // TODO: Implement Apply() method.
        if ($_reg->requestType == '请假') {
            echo "{$this->name}:{$_reg->user}{$_reg->requestMsg}申请{$_reg->requestType}{$_reg->num}天,被批准<br>";
        } else if ($_reg->requestType == '加薪' && $_reg->num <= 500) {
            echo "{$this->name}:{$_reg->user}{$_reg->requestMsg}申请{$_reg->requestType}{$_reg->num},被批准<br>";
        } else if ($_reg->requestType == '加薪' && $_reg->num > 500) {
            echo "{$this->name}:{$_reg->user}{$_reg->requestMsg}申请{$_reg->requestType}{$_reg->num},我再考虑考虑吧...<br>";
        }
    }
}

# 实例化所有处理者
$manager = new CommonManager('张三');
$cto = new MajorDomo('老刘');
$ceo = new GeneralManager('马化腾');
$manager->SetHeader($cto);
$cto->SetHeader($ceo);

$demo = new Request();
$demo->user = '小会';
$demo->requestType = '请假';
$demo->requestMsg = '撸管太多';
$demo->num = 4;
$manager->Apply($demo);

$demo = new Request();
$demo->user = '小会';
$demo->requestType = '加薪';
$demo->requestMsg = '拍姜智马屁';
$demo->num = 1000;
$manager->Apply($demo);