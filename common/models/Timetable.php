<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "timetable".
 *
 * @property integer $id
 * @property string $start
 * @property string $finish
 * @property integer $lesson_id
 * @property string $course_uid
 *
 * @property Lesson $lesson
 * @property TeacherCourse $courseU
 */
class Timetable extends \yii\db\ActiveRecord
{
      const IMENIT=1;
        const RODIT=2;
        const DATEL=3;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'timetable';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start', 'lesson_id'], 'required'],
            [['start', 'finish'], 'safe'],
            [['lesson_id'], 'integer'],
            [['course_uid'], 'string', 'max' => 15]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'start' => Yii::t('app', 'Start'),
            'finish' => Yii::t('app', 'Finish'),
            'lesson_id' => Yii::t('app', 'Lesson ID'),
            'course_uid' => Yii::t('app', 'Course Uid'),
            'description' => Yii::t('app', 'Description')
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLesson()
    {
        return $this->hasOne(Lesson::className(), ['id' => 'lesson_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacherCourse()
    {
        return $this->hasOne(TeacherCourse::className(), ['course_uid' => 'course_uid']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['id' => 'course_id'])
                ->via('teacherCourse');
    }
    public function getTeacher()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id'])
            ->via('teacherCourse');
    }
    
    
        /*
         * Switches words (days of weeks) to rusian-specific cases
         * среда - средам, пятница - пятницам
         * @var $days array of short-names of days
         * @var $case predefined constants like RODIT, VINIT, IMENIT... 
         */
        public static function daysOfWeekCases($days,$case){
            switch ($case) 
            {
                case self::IMENIT:
                    foreach ($days as $day)
                    {
                        switch ($day)
                        {
                            case 'Mon':
                                $newdays[]='понедельник';
                            break;
                            case 'Tue':
                                $newdays[]='вторник';
                            break;
                            case 'Sun':
                                $newdays[]='воскресенье';
                            break;
                            case 'Wed':
                                $newdays[]='среда';
                            break;
                            case 'Thu':
                                $newdays[]='четверг';
                            break;
                            case 'Fri':
                                $newdays[]='пятница';
                            break;
                            case 'Sat':
                                $newdays[]='суббота';
                            break;
                        }
                    }
                break;
                case self::RODIT:
                    foreach ($days as $day)
                    {
                        switch ($day)
                        {
                            case 'Mon':
                                $newdays[]='понедельникa';
                            break;
                            case 'Tue':
                                $newdays[]='вторникa';
                            break;
                            case 'Sun':
                                $newdays[]='воскресенья';
                            break;
                            case 'Wed':
                                $newdays[]='среды';
                            break;
                            case 'Thu':
                                $newdays[]='четверга';
                            break;
                            case 'Fri':
                                $newdays[]='пятницы';
                            break;
                            case 'Sat':
                                $newdays[]='субботы';
                            break;
                        }
                    }
                break;
            case self::DATEL:
                    foreach ($days as $day)
                    {
                        switch ($day)
                        {
                            case 'Mon':
                                $newdays[]='понедельникам';
                            break;
                            case 'Tue':
                                $newdays[]='вторникам';
                            break;
                            case 'Sun':
                                $newdays[]='воскресеньям';
                            break;
                            case 'Wed':
                                $newdays[]='средам';
                            break;
                            case 'Thu':
                                $newdays[]='четвергам';
                            break;
                            case 'Fri':
                                $newdays[]='пятницам';
                            break;
                            case 'Sat':
                                $newdays[]='субботам';
                            break;
                        }
                    }
                break;
            }
            return implode(', ',$newdays);
        }
    
}
