<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;


/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <div style="float: left; width: 25%;">
                <?= $form->field($model, 'title')->textInput(['maxlength' => 250]) ?>
                <?= $form->field($model, 'parent')->dropDownList($model->ParentList(), ['prompt' => '']) ?>
                <?= $form->field($model, 'image_path')->textInput(['maxlength' => 250]) ?>
                <?= $form->field($model, 'alias')->textInput(['maxlength' => 250]) ?>
                <?= $form->field($model, 'description')->textInput(['maxlength' => 250]) ?>
                <?= $form->field($model, 'keywords')->textInput(['maxlength' => 250]) ?>
                <?= $form->field($model, 'page_title')->textInput(['maxlength' => 250]) ?>
        </div>
    <div style="width: 70%; float: right;">
    <?= $form->field($model, 'text')->widget(CKEditor::className(),[
        'editorOptions' => [
        'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
        'inline' => false, //по умолчанию false
        ],
        ]);
    ?>
    </div>

        
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
