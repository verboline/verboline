<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\models;

use yii\base\Model;
use common\models\TeacherCourse;
use common\models\Timetable;
use Yii;
use yii\db\Exception;

/**
 * Description of TimetableInitForm
 *
 * @author OCRV_KroshilinAM
 */
class TimetableInitForm extends Model {
    
    public $courseId;
    public $teacherId;
    public $time;
    public $timestamp;
    public $uid;
        /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['courseId', 'timestamp','teacherId'], 'required'],
        ];
    }
    
    public function makeTimeTable() 
    {   
        $this->uid = uniqid();
        $teacherCourse = new TeacherCourse;
        $teacherCourse->course_id = $this->courseId;
        $teacherCourse->course_uid = $this->uid;
        $teacherCourse->user_id = $this->teacherId;
        $teacherCourse->start = date(\DateTime::W3C,(int)($this->timestamp[0]/1000));
        
        $connection = Yii::$app->db;
        $connection->beginTransaction();
        try {
            $this->sortTS();
            $teacherCourse->save();
            $this->generateLessons();
            $connection->transaction->commit();
            return true;
        } catch (Exception $ex) {
              $connection->transaction->rollBack();
              var_dump($teacherCourse->getErrors());
              var_dump($ex);
              return false;
        }

    }
    
    public function generateLessons()
    {
        $it = 0;
        $week = 0;
        $lessons = Lesson::find()
                ->where('course_id=:id',['id'=>$this->courseId])
                ->orderBy('num')
                ->all();
        $lessonCount = count($lessons);
        while ($it<$lessonCount) {
            foreach ($this->timestamp as $timestamp) {
                $lesson = new Timetable;
                $lesson->lesson_id = $lessons[$it]->id;
                $lesson->course_uid = $this->uid;
                $lesson->start =date(\DateTime::W3C,(int)($timestamp/1000 + (7 * 24 * 60 * 60)*$week));
                $lesson->save();
                //var_dump($lesson);
                $it++;
                if ($it>=$lessonCount) break;
            }
            $week++;
        }
        
    }
    
    public function sortTS()
    {
        array_multisort($this->timestamp,SORT_ASC);
    }
}
