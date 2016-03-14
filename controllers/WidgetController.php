<?php
/**
 * 自定义 小部件Widget
 * @author 44533
 *
 */
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Test;

class WidgetController extends Controller
{
    public function actionIndex()
    {
        return $this->renderPartial('index');
    }
}
