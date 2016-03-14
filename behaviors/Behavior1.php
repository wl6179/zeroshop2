<?php
/**
 * 行为类 之 MixIn新属性注入！
 * @author 44533
 *
 */
namespace app\behaviors;

use yii\base\Behavior;

class Behavior1 extends Behavior
{
    public $height;
    
    public function eat() {
    	echo 'dog eat.';
    }
    
    /**
     * 还能在行为中，定义（监听）wang的事件机制！
     */
    public function events(){
        return [
	       'wang'=>'shout',
        ];
    }
    
    public function shout($event) {
    	echo 'wang wang wang<br>';
    }
}