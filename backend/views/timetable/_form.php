<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JqueryAsset;
use yii\jui\DatePickerAsset;
use yii\jui\SliderAsset;
use yii\jui\InputWidget;
use common\models\Course;
use common\models\User;
use backend\widgets\datetimepicker\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Timetable */
/* @var $courseInstanse common\models\TeacherCourse */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="row">
    <div class="col-sm-12">
        <div class="alert alert-success">
            Добавляйте необходимое количество дней в неделю для проведения курса по вашему предмету. Когда вы нажмете кнопку создать, будет сгенерировано расписание вашего курса.
            Ваши занятия будут повторяться каждую неделю по выбранным дням, пока не закончатся уроки курса. После генерации расписания вы сможете вручную изменять дни время проведения занятий 
            для каждого отдельно взятого урока.
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
            <?php $form = ActiveForm::begin(['id'=>'form']);?>
                <div class="row courserow">
                     <div class="col-sm-6">
                   <?php              
                   echo $form->field($model,"courseId",['labelOptions'=>
                                                                 ['class'=>'','label'=>Yii::t('app','COURSE')]
                                                      ])->dropDownList(Course::coursesList());?> 
                    </div>
                </div> 
                <div class="row teacherrow">
                    <div class="col-sm-6">
                   <?php              
                   echo $form->field($model,"teacherId",['labelOptions'=>
                                                                 ['class'=>'','label'=>Yii::t('app','TEACHER')]
                                                      ])->dropDownList(User::usersList());?> 
                    </div>
                </div> 
                <div class="row formrow">
                    <div class="col-sm-6">
                    <?php 
                    
                    echo $form->field($model,"time[0]",['labelOptions'=>
                                                                 ['class'=>'sr-only']
                                                      ])->widget(DateTimePicker::className(),['options'=>
                                                          ['class'=>'form-control','id'=>'day0','placeholder'=>Yii::t('app','START')]
                                                          ]);?>
                    </div>
                    <div class="col-sm-6">
                       <?php echo  Html::a(Yii::t('app','REMOVE'),'#',['class'=>'btn btn-danger remDay hidden']);?> 
                    </div>
                    </div>
                    <div class="form-group">
                            <?php echo Html::submitButton('Create', ['class' => 'btn btn-success']); 
                                echo  Html::a(Yii::t('app','ADD_DAY_TIME'),'#',['class'=>'btn btn-success pull-right','id'=>'addDay']);
                             ?>
                    </div>
            <?php ActiveForm::end(); ?>
    </div>
</div>
