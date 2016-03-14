<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
Hello World!Chris.Wang~
<h1><?php echo Html::encode($test_str); //过滤各种代码通用过滤输出函数！ ?></h1>
<h1><?php echo HtmlPurifier::process($test_arr[0]); //专门取出js的过滤输出函数！ ?></h1>