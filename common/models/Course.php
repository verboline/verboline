<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "course".
 *
 * @property integer $id
 * @property string $description
 * @property string $title
 * @property integer $cost
 *
 * @property Lesson[] $lessons
 * @property TeacherCourse[] $teacherCourses
 */
class Course extends \yii\db\ActiveRecord
{   
   
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'course';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'title', 'cost'], 'required'],
            [['description'], 'string'],
            [['cost'], 'integer'],
            [['title'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'description' => Yii::t('app', 'Description'),
            'title' => Yii::t('app', 'Title'),
            'cost' => Yii::t('app', 'Cost'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLessons()
    {
        return $this->hasMany(Lesson::className(), ['course_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacherCourses()
    {
        return $this->hasMany(TeacherCourse::className(), ['course_id' => 'id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeachers() 
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])
                ->via('teacherCourses');
    }
    
    public static function coursesList()
    {
        $array = self::find()->all();
        return ArrayHelper::map($array,'id','title');
    }

}
