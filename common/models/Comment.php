<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\AttributeBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "comment".
 *
 */
class Comment extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [           
        ];
    }

    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }    
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text', 'created_at', 'created_by', 'ip_address', 'parent', 'parent_type'], 'required'],
            [['text', 'ip_address'], 'string'],
            [['created_at', 'created_by', 'parent', 'parent_type'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'text' => Yii::t('app', 'Text'),
            'created_at' => Yii::t('app', 'Created at'),
            'created_by' => Yii::t('app', 'Created by'),
            'ip_address' => Yii::t('app', 'IP address'),
            'parent' => Yii::t('app', 'Parent'),
            'parent_type' => Yii::t('app', 'Parent type'),
        ];
    }

    /**
     * 
     * @Parent_id   ID of Post/Comment
     * @Parent_type Post/Comment
     */
    
    
    static function CommentList($Parent_id, $Parent_type='Post')
    {
        $resultM = [];
        switch ($Parent_type){
            case 'Post': $type = 0; break;
            case 'Comment': $type = 1; break;
            default : $type = 0; break;
        }
        $object_arr = Comment::find()->where(['parent' => $Parent_id, 'parent_type' => $type])->all();

        foreach ($object_arr as $key => $comment) {
            $resultM[$key]['comment'] = $comment;
            $resultM[$key]['answers'] = Comment::CommentList($comment->id, 'Comment');
        }
        return $resultM;
        // return  ArrayHelper::map(Post::find()->all(), 'id', 'title');
    }
    
    public function getOwner()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);        
    }
    
    
    public function getParentObj()
    {
        return $this->hasOne(Post::className(), ['id' => 'parent']);
    }

    
    
}
