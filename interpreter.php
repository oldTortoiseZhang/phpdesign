<?php
/**
 * 设计模式之解释器模式
 * 给定一个语言, 定义它的文法的一种表示，并定义一个解释器，该解释器使用该表示来解释语言中的句子。
 * 解释器模式是一个比较少用的模式
 * zhangmin
 */
header("Content-type: text/html; charset=utf-8");

/**
 * 环境角色
 */
Class PlayContent{
    public $content;
}

/**
 * 抽象解释器
 */
abstract Class IEpress{
    #解析器方法
    public function Translate($val) {
        echo $this->Excute($val);
    }

    #抽象方法
    public abstract function Excute($val);
}

/**
 * 具体解释器A
 */
Class MusicNote extends IEpress{
    public function Excute($val) {
        $note = '';
        switch ($val) {
            case 'A':
                $note = 'do';
                break;
            case 'B':
                $note = 're';
                break;
            case 'C':
                $note = 'mi';
                break;
            case 'D':
                $note = 'fa';
                break;
            case 'E':
                $note = 'so';
                break;
            case 'F':
                $note = 'la';
                break;
            case 'G':
                $note = 'so';
                break;
        }
        return $note;
    }
}

/**
 * 具体解释器B
 */
Class MusicScale extends IEpress{
    public function Excute($val) {
        $note = '';
        switch ($val) {
            case '1':
                $note = '哆';
                break;
            case '2':
                $note = '瑞';
                break;
            case '3':
                $note = '咪';
                break;
            case '4':
                $note = '发';
                break;
            case '5':
                $note = '唆';
                break;
            case '6':
                $note = '啦';
                break;
            case '7':
                $note = '西';
                break;
        }
        return $note;
    }
}

/**
 * 派生出的具体解析器C
 */
class CoNote extends IEpress{
    public function Excute($val){
        return ' ~ ';
    }
}

$play_content=new PlayContent();
$play_content->content="1C2 EB5 A3E6 F5DB";
$expre = null;

try{
    for ($i=0; $i < strlen($play_content->content); $i++) {
        $content = $play_content->content[$i];
        switch ($content) {
            case '1':
                $expre = new MusicScale();
                break;
            case '2':
                $expre = new MusicScale();
                break;
            case '3':
                $expre = new MusicScale();
                break;
            case '4':
                $expre = new MusicScale();
                break;
            case '5':
                $expre = new MusicScale();
                break;
            case '6':
                $expre = new MusicScale();
                break;
            case '7':
                $expre = new MusicScale();
                break;
            case 'A':
                $expre = new MusicNote();
                break;
            case 'B':
                $expre = new MusicNote();
                break;
            case 'C':
                $expre = new MusicNote();
                break;
            case 'D':
                $expre = new MusicNote();
                break;
            case 'E':
                $expre = new MusicNote();
                break;
            case 'F':
                $expre = new MusicNote();
                break;
            case 'G':
                $expre = new MusicNote();
                break;
            default:
                $expre = new CoNote();
                break;
        }
        $expre->Translate($content);
    }
} catch(Exception $e) {
    echo $e->getMessage();
}
