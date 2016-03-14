<?php
/**
 * 如何操作 缓存&高级
 * @author 44533
 *
 */
namespace app\controllers;      #所有控制器都按约定，放在此命名空间下；

use yii\web\Controller;             #继承Controller时所需命名空间前缀；
use yii\web\Cookie;                 #使用cookies时，所需命名空间前缀；

class WorldController extends Controller
{
    /**
     * 缓存组件
     */
    public function actionIndex(){
        //获取缓存组件
        $cache = \YII::$app->cache;
        
        //写入缓存
        $cache->add('key1', 'hello world!~', 15);       //15秒 有效期
        
        //读缓存
        echo $cache->get('key1');
        //更多还有set、delete、flush
    }
    
    /**
     * 依赖缓存 - 文件
     */
    public function actionFile(){
        //获取缓存组件
        $cache = \YII::$app->cache;
        
        //文件依赖
        $dependency = new \yii\caching\FileDependency(['fileName'=>'hw.txt']);
        $cache->add('file_key3', 'hello world2', 3000, $dependency);       //3000秒有效期，并且依赖某一个文件的修改时间（变化即刻失效！）
        
        //读此依赖缓存
        echo $cache->get('file_key3');
    }
    
    /**
     * 依赖缓存 - 表达式
     */
    public function actionExpression(){
        //获取缓存组件
        $cache = \YII::$app->cache;
        
        //表达式依赖
        $dependency = new \yii\caching\ExpressionDependency(
            ['expression'=>'\YII::$app->request->get("name")']
        );
        $cache->add('expression_key3', 'hello world3', 3000, $dependency);       //3000秒有效期，并且依赖某一个表达式（变化即刻失效！）
        
        //读此依赖缓存
        echo $cache->get('expression_key3');
        //$cache->delete('file_key');
    }
    
    /**
     * 依赖缓存 - DB
     */
    public function actionDb(){
        //获取缓存组件
        $cache = \YII::$app->cache;
        
        //DB依赖
        $dependency = new \yii\caching\DbDependency(
            ['sql'=>'SELECT COUNT(*) FROM zeroshop.order']      //假如是3
        );
        $cache->add('db_key', 'hello world db', 3000, $dependency);       //3000秒有效期，并且依赖某一个数据库DB数据集（变化即刻失效！）
        
        //读此依赖缓存
        echo $cache->get('db_key');
    }
}
