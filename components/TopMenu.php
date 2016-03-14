<?php
/**
 * Widget小部件 的创建
 */
namespace app\components;

use yii\base\Widget;

class TopMenu extends Widget
{
    /**
     * 初始化
     */
    public function init()
    {
    	parent::init();
    	echo '<ul>';       //开始
    }
    
    /**
     * 结束
     */
    public function run() {
    	return '</ul>';    //结束
    }
    
    /**
     * 增加项
     */
    public function addMenu($menuName) {
        return '<li>'. $menuName .'</li>';
    }
}