<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\bootstrap\Collapse;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\search\CourseSearch $searchModel
 * @var array app\models\Timetable $courses
 */

?>
<div class="course-index">

<?php 
        
    foreach ($courses as $course){

     echo $course->course->title;
     echo $course->start;
     echo $course->teacher->name;               
     echo $course->teacher->surname;   
    }
 ?>
</div>
