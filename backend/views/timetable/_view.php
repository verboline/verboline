<div class="row course">
    <div class="col-md-12">
<?php
use yii\helpers\Html;

    echo Html::activeLabel($model->lesson->course, 'title');
    echo Html::a($model->lesson->course->title, null, ['class'=>'accordeon']);
    echo '<br>';
    echo Html::activeLabel($model->lesson, 'start');
    echo Html::encode($model->start);
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


?>


</div>
</div>