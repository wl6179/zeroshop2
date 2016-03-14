<?php
use app\components\TopMenu;
?>
<div>
    <?php $menu=TopMenu::begin();//自定义 小部件 的开始，会执行init+返回对象； ?>
    <?php
        echo $menu->addMenu('menu1');
        echo $menu->addMenu('menu2');
    ?>
    <?php TopMenu::end();//自定义 小部件 的结束，会执行run； ?>
</div>