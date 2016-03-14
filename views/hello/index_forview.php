<?php
use yii\helpers\Html;       //layer和这里，都需要引入，它俩是不相关的！
use yii\helpers\HtmlPurifier;
?>
<?php
//如何定义 layer 中的 title 之 百变无常！< ?php echo $this->blocks['block_title']; ? >
//使用 数据块 灵活定义功能：（就在当前的子视图中 灵活定义！）
?>
<?php $this->beginBlock('block_title'); ?>
Layer 详情页 AK47
<?php $this->endBlock(); ?>


Hello World!Chris.Wang~（layer）
<h1><?php echo Html::encode($test_str); //过滤各种代码通用过滤输出函数！ ?></h1>
<h1><?php echo HtmlPurifier::process($test_arr[0]); //专门取出js的过滤输出函数！ ?></h1>


<h3>显示其它视图：</h3>
<?php echo $this->render("index", array('test_str'=>'嵌套了视图index！', 'test_arr'=>[111,222])); ?>