<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Course */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Courses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('app', 'Add Lesson'), ['lesson/create', 'courseId' => $model->id], [
            'class' => 'btn btn-primary',
            'data' => [
                'method' => 'post',
            ]
                ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'description:ntext',
            'title',
            'cost',
        ],
    ]) ?>
<?php 
$lessonsProvider = new yii\data\ActiveDataProvider([
    'query' => $model->getLessons(),
    'pagination' => [
        'pageSize' => 20,
        ],
    ]
        );

echo yii\widgets\ListView::widget([
    'dataProvider' => $lessonsProvider,
    'itemView' => 'lesson/_lesson.php',
    'options' => [
        'class' => 'container'
        ],
    'itemOptions' => [
        'class' => 'row'
    ]
]);
?>
</div>
