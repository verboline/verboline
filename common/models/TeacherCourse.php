<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "teacherCourse".
 *
 * @property integer $id
 * @property integer $finished
 * @property integer $user_id
 * @property string $course_uid
 * @property integer $course_id
 * @property timestamp $start
 * @property string $days
 *
 * @property Course $course
 * @property User $user
 * @property Timetable[] $timetables
 * @property UserCourse[] $userCourses
 */
class TeacherCourse extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'teacherCourse';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['finished', 'user_id', 'course_id'], 'integer'],
            [['user_id', 'course_uid', 'course_id', 'start'], 'required'],
            [['start'], 'safe'],
            [['course_uid'], 'string', 'max' => 15],
            [['days'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'finished' => Yii::t('app', 'Finished'),
            'user_id' => Yii::t('app', 'User ID'),
            'course_uid' => Yii::t('app', 'Course Uid'),
            'course_id' => Yii::t('app', 'Course ID'),
            'start' => Yii::t('app', 'Start'),
            'days' => Yii::t('app', 'Days'),
        ];
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTimetables()
    {
        return $this->hasMany(Timetable::className(), ['course_uid' => 'course_uid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserCourses()
    {
        return $this->hasMany(UserCourse::className(), ['course_uid' => 'course_uid']);
    }
}
