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

namespace common\widgets\eventcalendar;

class EventCalendarAsset extends \yii\web\AssetBundle {
    
      public $publishOptions = [
    'forceCopy' => true
    ];
    
    public function init()
    {
        $this->sourcePath = __DIR__."/";
        parent::init();
    }
    public $js = [
        'js/dhtmlxscheduler.js',
        'js/startCalendar.js',
    ];
    public $css = [
        'css/dhtmlxscheduler.css',
        'css/dhtmlxscheduler_flat.css',
        
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\web\YiiAsset',
    ];
}
