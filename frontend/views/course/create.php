<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Course */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Course',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Courses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>