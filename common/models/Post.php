<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\AttributeBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property string $image_path
 * @property string $alias
 * @property string $description
 * @property string $keywords
 * @property string $page_title
 * @property string $created_at
 * @property string $updated_at
 * @property integer $parent
 * @property string $status
 * @property string $params
 * @property integer $isParent
 * @property integer $created_by
 * @property integer $updated_by
 */
class Post extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            'UserID' => [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                  ActiveRecord::EVENT_BEFORE_INSERT => 'created_by',
                  ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_by',
                ],
                'value' => function ($event) {
                  return  Yii::$app->user->id;
                },
            ],
             
        ];
    }

    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }    
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'text'], 'required'],
            [['text', 'status', 'params'], 'string'],
            [['parent', 'isParent', 'created_by', 'updated_by'], 'integer'],
            [['title', 'image_path', 'alias', 'description', 'keywords', 'page_title', 'created_at', 'updated_at'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'text' => Yii::t('app', 'Text'),
            'image_path' => Yii::t('app', 'Image Path'),
            'alias' => Yii::t('app', 'Alias'),
            'description' => Yii::t('app', 'Description'),
            'keywords' => Yii::t('app', 'Keywords'),
            'page_title' => Yii::t('app', 'Page Title'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'parent' => Yii::t('app', 'Parent'),
            'status' => Yii::t('app', 'Status'),
            'params' => Yii::t('app', 'Params'),
            'isParent' => Yii::t('app', 'Is Parent'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }
    
    public function ParentList()
    {
        $resultM = ArrayHelper::map(Post::find()->all(), 'id', 'title');        
        // сам у себя наследовать не может!
        ArrayHelper::remove($resultM, $this->id);
        return $resultM;
        // return  ArrayHelper::map(Post::find()->all(), 'id', 'title');
    }
    
    public function getOwner()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);        
    }
    
    public function getUpdater()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);        
    }
    
    public function getParentObj()
    {
        return $this->hasOne(Post::className(), ['id' => 'parent']);
    }

    
    
}
