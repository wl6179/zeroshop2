<?php
/* use yii\helpers\Html;
use yii\helpers\HtmlPurifier; */
?>
<div>
123
</div>

<?php if ($this->beginCache('cache_view', ['duration'=>5])) { ?>
<div id="cache_div">
    <div>这里将会被缓存！</div>
</div>
<?php $this->endCache(); } ?>

<div>
456
</div>