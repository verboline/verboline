<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Post',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php 
    
    echo 
     GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'title',
            //'text:ntext',
            //'image_path',
            //'alias',
             'description',
            // 'keywords',
            // 'page_title',
            // 'created_at',
             [
                 'attribute' => 'updated_at',
                 'label' => 'Обновлено последний раз',
                 'value' => function ($model, $key, $index, $grid){
                    return date("d-m-y H:i:s", $model->updated_at);
                 }
             ],
            // 'parent',
             'status',
            // 'params:ntext',
            // 'isParent',
            // 'created_by',
             [
                 'attribute' =>  'updated_by', 
                 'label' => 'Кем последний раз изменялось',
                 'value' => function ($model, $key, $index, $grid){
                    return (!empty($model->updater)) ? $model->updater->username : 'noname';
                 }
             ],
             [
                 'attribute' =>  'parent', 
                 'label' => 'Родительский материал',
                 'value' => function ($model, $key, $index, $grid){
                    return (!empty($model->parentObj)) ? $model->parentObj->title : 'no';
                 }
             ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
