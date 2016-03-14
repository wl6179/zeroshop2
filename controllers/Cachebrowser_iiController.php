<?php
/**
 * 如何操作 浏览器缓存
 * @author 44533
 *
 */
namespace app\controllers;      #所有控制器都按约定，放在此命名空间下；

use yii\web\Controller;             #继承Controller时所需命名空间前缀；
use yii\web\Cookie;                 #使用cookies时，所需命名空间前缀；

class Cachebrowser_iiController extends Controller
{
    /**
     * 浏览器级缓存
     * 两步：
     *  1.先定义behaviors；
     *  2.过程
     */
    public function behaviors(){
        return [
	       [
	           'class'=>'yii\filters\HttpCache',
	           'lastModified'=>function (){
	               return filemtime('hw.txt');              //一般根据自己情况，使用业务规则控制！
	           },
	           'etagSeed'=>function (){
	               $fp = fopen('hw.txt', 'r');
	               $title = fgets($fp);            //fgets一下，获取第一行（标题）文字！
	               var_dump($title);
	               fclose($fp);
	               return $title;                  //【会根据此种子，自动进行哈希】一般根据自己情况，使用业务规则控制！
	           },
            ]
        ];
    }
    /**
     * 浏览器缓存
     */
    public function actionIndex(){
        $content = file_get_contents('hw.txt');
        return $this->render('index', ['new'=>$content]);      //注意return必须有！！否则没反应~ VS Yii1.1
    }
}
