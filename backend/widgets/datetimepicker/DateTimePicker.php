<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dateTimePickerWidget
 *
 * @author OCRV_KroshilinAM
 */

namespace backend\widgets\datetimepicker;

use backend\widgets\datetimepicker\DateTimeAsset;
use yii\helpers\Html;

class DateTimePicker extends \yii\widgets\InputWidget {
    
    
    public $id;
    
    public function run() {
        
        $view = $this->getView();
        DateTimeAsset::register($view);
        $this->renderItem();
        
        
    }
    
    public function renderItem() {
        if ($this->hasModel()) {
           echo Html::activeTextInput($this->model, $this->attribute, $this->options);
           echo Html::input('hidden',Html::getInputName($this->model, 'timestamp[0]'),null,$this->options); 
        }
    }
    
}
