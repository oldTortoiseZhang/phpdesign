<?php
/**
 * Created by PhpStorm.
 * User: zhangmin
 * Date: 2017/5/18
 * Time: 15:32
 * 设计模式之备忘录模式
 * 使用场景：编辑器后退操作/数据库事物/存档
 * 在不破坏封闭的前提下，捕获一个对象的内部状态，并在该对象之外保存这个状态
 */
header("Content-type: text/html; charset=utf-8");

/**
 * 角色类
 */
class GameRole{
    #角色属性
    public $name = '姜智';
    public $hp = 100;
    public $mp = 20;
    public $equip = '赤膊';

    //保存状态
    public function SaveState() {
        return (new RoleStateMemo($this->name, $this->hp, $this->mp, $this->equip));
    }

    //恢复状态
    public function RecoveryState($_memo) {
        $this->hp = $_memo->hp;
        $this->mp = $_memo->mp;
        $this->equip = $_memo->equip;
    }

    //获取状态
    public function GetState() {
        echo "角色状态：<br/>";
        echo "角色名称: {$this->name}<br>";
        echo "HP：{$this->hp}<br/>";
        echo "MP：{$this->mp}<br/>";
        echo "装备：{$this->equip}<br/>";
    }

    //事件,打怪
    public function Fight() {
        if ($this->hp <= 0) {
            echo "呃，大侠请重新来过吧！<br/>";
            return false;
        }
        $n = mt_rand(1, 5);
        for ($i = 0; $i <= $n; $i++) {
            $hp = mt_rand(0,10);
            $mp = mt_rand(0,3);
            $this->hp -= $hp;
            $this->mp -= $mp;
            if ($this->mp <= 0) {
                $this->mp = 0;
            }
            if ($this->hp <= 0) {
                echo "呃，该角色阵亡了！<br/>";
                echo "Game Over!<br/>";
                return;
            }
        }
        if ($this->hp > 0) {
            $lucky = mt_rand(0, 10);
            if ($lucky == 7) {
                echo "Lucky，爆装备了！<br/>";
                $this->equip = '屠龙刀';
            }
        }

    }

}

/**
 * 角色状态存储箱类
 */
class RoleStateMemo {
    public $name;
    public $hp;
    public $mp;
    public $equip;

    public function __construct($_name,$_hp,$_mp, $_equip)
    {
        $this->name = $_name;
        $this->hp = $_hp;
        $this->mp = $_mp;
        $this->equip = $_equip;
    }
}

/**
 * 游戏角色状态管理者类
 */
class RoleStateManager
{
    public $memento;
}

$jz = new GameRole();
echo "<span style='color:#ff0000'>----------------开战前,我先保存一下-----------------</span><br/>";
$jz->GetState();
#存档
$save = new RoleStateManager();
$save->memento = $jz->SaveState();

echo "<span style='color:#ff0000'>----------------战斗中-----------------</span><br/>";
for($i = 0; $i <10;$i++) {
    $jz->Fight();
}
echo "<span style='color:#ff0000'>----------------战斗后-----------------</span><br/>";
$jz->GetState();
echo "<span style='color:#ff0000'>----------------读档-----------------</span><br/>";
#恢复
$jz->RecoveryState($save->memento);
$jz->GetState();
