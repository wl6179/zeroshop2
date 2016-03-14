<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "test".
 *
 * @property integer $id
 * @property string $title
 */
class Test extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'test';
    }
    
    /**
     * 场景设置：Add、Edit
     */
    public function scenarios()
    {
        return [
            'scenario1'=>['id', 'title'],
            'scenario2'=>['id']
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],        //MySQL中不要选择 EmptyString 即可，那样不会有 NOT NULL
            [['title'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '编号'),
            'title' => Yii::t('app', '标题'),
        ];
    }
}
