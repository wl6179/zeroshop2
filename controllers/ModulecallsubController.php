<?php

namespace app\controllers;

use Yii;
use app\models\Test;
use app\models\TestSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TestController implements the CRUD actions for Test model.
 */
class TestController extends Controller
{
    /**
     * Lists
     */
    public function actionIndex()
    {
        //先获取子模块
        $article = \YII::$app->getModule('article');
        
        //再调用子模块的方法操作
        $article->runAction('default/index');
    }
}
