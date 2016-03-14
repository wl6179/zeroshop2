<?php
/**
 * Debug工具 之 Profile性能信息 之 调试断点
 * @author 44533
 *
 */
namespace app\controllers;

use Yii;
use yii\web\Controller;

class DebugtoolController extends Controller
{
    public function actionIndex()
    {
        //开始断点start
        \YII::beginProfile('profile1');
        
        //--------------------------断点监测范围-------------------------------
        //1.输出并sleep延迟1秒
        echo 'hello world;';
        sleep(1);
        
        //2.查询生成器-DB
        (new \yii\db\Query())
        ->select('*')
        ->from('user')
        ->all();
        //---------------------------------------------------------
        
        //结束断点end
        \YII::endProfile('profile1');
    }
}
