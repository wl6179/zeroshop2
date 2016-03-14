<?php
/**
 * 更多可以研究 入口文件 中的 app->run() 源码，trigger(self::EVENT_AFTER_REQUEST)+trigger(AFTER)
 * @author 44533
 * 订阅者！
 */
namespace app\controllers;

use yii\web\Controller;
use yii\base\Event;
use vendor\animal\Cat;
use vendor\animal\Mouse;
use vendor\animal\Dog;
use app\behaviors\Behavior1;

/**
 * 事件机制 的应用场景
 */
class AnimalController extends Controller
{
    /**
     * 事件触发机制I
     */
    public function actionIndex()
    {
        //实例化猫和老鼠
        $cat = new Cat;
        $mouse = new Mouse;
        
        //在控制器里
        //绑定事件（为猫的某些个事件，绑定若干其它类方法~如老鼠跑等）
        $cat->on('miao', [$mouse, 'run']);     //on方法来自继承的Component父类[第一个参数是指绑定什么事件如miao；第二个参数是要做什么；]
        
        //猫叫一下（触发事件）
        $cat->shout();      //将触发miao事件！（导致上边的绑定：老鼠run！！）
    }
    
    /**
     * 事件触发机制II - 类级别的‘监听’！！
     */
    public function actionIndex2()
    {
        //实例化猫和老鼠
        $cat = new Cat;
        $cat2 = new Cat;        //只有是类级别的 Event：：on（定义的事件绑定！） 才能让cat2触发miao~
        $mouse = new Mouse;
        
        //在控制器里
        //绑定事件（为猫的某些个事件，绑定若干其它类方法~如老鼠跑等）
        Event::on(Cat::className(), 'miao', [$mouse, 'run']);     //on方法来自继承的Component父类[第一个参数是指绑定什么事件如miao；第二个参数是要做什么；]
        
        //猫叫一下（触发事件）
        $cat->shout();      //将触发miao事件！（导致上边的绑定：老鼠run！！）
        $cat2->shout();     //类级别的监听，所以cat2对象依然可以触发事件 miao！~
    }
    
    /**
     * 事件触发机制III - $app事件捕捉！（非类级别的‘监听’！！）
     * 【$app 也是继承自 Compenent 组件类，所以也有 on 方法。】
     */
    public function actionIndex3()
    {
        //实例化猫
        $cat = new Cat;
        
        //先定义
        //$app 的处理请求，前后都触发了事件！如何监听之
       \YII::$app->on(\yii\base\Application::EVENT_AFTER_ACTION, [$cat, 'shout']);      // app 事件带动了 猫叫，猫叫又带动了老鼠跑路。。。（联动机制！）
       
       //后定义（整个app请求结束后）
       //定义老鼠 随猫联动~
       $mouse = new Mouse;
       $cat->on('miao', [$mouse, 'run']);
       
       //此echo仍在 app 的整个请求之中（参照物）
       echo 'Hello index3 action...<br>';
    }
    
    /**
     * MixIn注入（新属性）机制 之 行为【类的混合】
     */
    public function actionDogmixin()
    {
        //实例化猫
        $dog = new Dog();
        
        $dog->look();
        $dog->eat();    //Component父类，提供了事件机制的on；以及Mixin机制的行为注入；
        
        //触发wang事件
        $dog->trigger('wang');
    }
    
    /**
     * MixIn注入（新属性）机制 之 行为【对象的混合】
     * 将某些个对象的属性，注入另一个对象中使用！
     */
    public function actionDogmixin2()
    {
        //实例化猫
        $dog = new Dog();
    
        $behavior1 = new Behavior1();   //行为的对象
        $dog->attachBehavior('beh1', $behavior1);
        
        $dog->eat();    //
    }
}
