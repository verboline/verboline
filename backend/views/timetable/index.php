<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\widgets\eventcalendar\EventCalendar;
/* @var $this yii\web\View */
/* @var $searchModel common\models\TimetableSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Timetables');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timetable-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Start new Course'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php
    echo EventCalendar::widget();
?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'start',
            [
              'attribute' => 'lesson_id',
              'value' => function ($model, $key, $index, $grid){return $model->lesson->title;}
            ],
            
            [
                'attribute' => 'course_uid',
                'value' => function ($model, $key, $index, $grid){return $model->course->title;}
            ]    ,   
            [
              'label' => 'teacher',
              'value' => function ($model, $key, $index, $grid){return $model->teacher->name;}
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
