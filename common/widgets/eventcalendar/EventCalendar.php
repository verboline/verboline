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

namespace common\widgets\eventcalendar;

use common\widgets\eventcalendar\EventCalendarAsset;
use yii\helpers\Html;

class EventCalendar extends \yii\base\Widget {
    
    
    public $id;
    
    public function run() {
        
        $view = $this->getView();
        EventCalendarAsset::register($view);
        $this->renderItem();
        
        
    }
    
    public function renderItem() {
    echo ' 
        <div id="scheduler_here" class="dhx_cal_container" style="width:900px%; height:500px;">
    <div class="dhx_cal_navline">
        <div class="dhx_cal_prev_button">&nbsp;</div>
        <div class="dhx_cal_next_button">&nbsp;</div>
        <div class="dhx_cal_today_button"></div>
        <div class="dhx_cal_date"></div>
        <div class="dhx_cal_tab" name="day_tab" style="right:204px;"></div>
        <div class="dhx_cal_tab" name="week_tab" style="right:140px;"></div>
        <div class="dhx_cal_tab" name="month_tab" style="right:76px;"></div>
    </div>
    <div class="dhx_cal_header"></div>
    <div class="dhx_cal_data"></div>       
</div>
        ';        
    }
}
