<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "lesson".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $num
 * @property integer $course_id
 *
 * @property CurrentLesson $currentLesson
 * @property Course $course
 * @property Timetable[] $timetables
 */
class Lesson extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lesson';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'course_id'], 'required'],
            [['description'], 'string'],
            [['num', 'course_id'], 'integer'],
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
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'num' => Yii::t('app', 'Num'),
            'course_id' => Yii::t('app', 'Course ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrentLesson()
    {
        return $this->hasOne(CurrentLesson::className(), ['lesson_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['id' => 'course_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTimetables()
    {
        return $this->hasMany(Timetable::className(), ['lesson_id' => 'id']);
    }
    
}
