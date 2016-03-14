<?php
/**
 * 场景的应用 - 用于在同一个Model中去区分Add和Edit的Action时的字段集
 * @author 44533
 *
 */
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Test;

class GiiscenarioController extends Controller
{
    public function actionIndex()
    {
        $test = new Test();
        
        $test->scenario = 'scenario1';      //应用 场景1（的字段集）
        
        //数据
        $testData = [
	       'data'=>['id'=>3, 'title'=>'hello girl!']
        ];
        $test->load($testData, 'data');     //（load用模型来读取）数组$testData中的 data子数组！
        
        //输出模型
        echo $test->id;
        echo $test->title;
    }
}
