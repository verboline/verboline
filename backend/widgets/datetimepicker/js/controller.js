/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var logger = function(current_time,input) {
  $(input).val(current_time.dateFormat('d/m/Y H:i'));
  $(input).next().val(current_time.getTime());
} 
$('#day0').datetimepicker({onClose:logger,validateOnBlur:false
});
var n=1;


$("#addDay").click(function(){
                                        tmp=$("#form .formrow:first").clone();
                                        $('input:first',tmp).datetimepicker( {onClose:logger,validateOnBlur:false});
                                        $("input:first",tmp).attr("id","day"+n);
                                        $("input:last",tmp).attr("id","dayts"+n);
                                        $("#form .formrow:last").after(tmp);
                                        $("#form .formrow:last input").removeClass("hasDatepicker");
                                        $("#form .formrow:last a").removeClass("hidden");
                                        $("#form .formrow:last input:first").attr("name","TimetableInitForm[time]["+n+"]");
                                        $("#form .formrow:last input:last").attr("name","TimetableInitForm[timestamp]["+n+"]");
                                        $("#form .formrow:last input").attr("value","");
                                        n++;
                                        });
                                        
$(".remDay").click(function(){
                                        $($(this).parent().parent()).remove();
                                        });