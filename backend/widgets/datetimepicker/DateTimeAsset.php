<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DateTimeAsset
 *
 * @author OCRV_KroshilinAM
 */

namespace backend\widgets\datetimepicker;

class DateTimeAsset extends \yii\web\AssetBundle {
    
      public $publishOptions = [
    'forceCopy' => true
    ];
    
    public function init()
    {
        $this->sourcePath = __DIR__."/";
        parent::init();
    }
    public $js = [
        'js/jquery.datetimepicker.js',
        'js/controller.js',
    ];
    public $css = [
        'css/jquery.datetimepicker.css',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
