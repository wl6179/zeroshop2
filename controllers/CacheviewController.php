<?php
/**
 * 如何操作 缓存页面
 * @author 44533
 *
 */
namespace app\controllers;      #所有控制器都按约定，放在此命名空间下；

use yii\web\Controller;             #继承Controller时所需命名空间前缀；
use yii\web\Cookie;                 #使用cookies时，所需命名空间前缀；

class CacheviewController extends Controller
{
    /**
     * 片段缓存
     */
    public function actionIndex(){
        return $this->render('index');      //注意return必须有！！否则没反应~ VS Yii1.1
    }
    
    
    /**
     * 页面级缓存
     * 两步：
     *  1.先定义behaviors；
     *  2.过程
     */
    public function behaviors(){
        return [
	       [
	           'class'=>'yii\filters\PageCache',        //检查并将页面进行Page缓存！
	           'duration'=>1000,
	           'only'=>['cachepage'],                  //仅对cachepage进行缓存
	           'dependency'=>[
	               'class'=>'yii\caching\FileDependency',
	               'fileName'=>'hw.txt'
                ]
            ]
        ];
    }
    public function actionCachepage(){
        return $this->render('cachepage');      //注意return必须有！！否则没反应~ VS Yii1.1
    }
}
