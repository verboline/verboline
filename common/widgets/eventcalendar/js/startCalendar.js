/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//var superGlobalId;


scheduler.config.xml_date="%Y-%m-%d %H:%i:%s";

scheduler.init('scheduler_here', new Date(),"month");
scheduler.load("/timetable/calendar","json");
var dp = new dataProcessor("/timetable/update-lesson");

dp.serialize = function(data, id){
    	if (typeof data == "string")
    		return data;
    	if (typeof id != "undefined")
    		return this.serialize_one(data,"");
    	else{
    		var stack = [];
    		var keys = [];
    		for (var key in data)
    			if (data.hasOwnProperty(key)){
    				stack.push(this.serialize_one(data[key],key+this.post_delim));
    				keys.push(key);
				}
    		stack.push("ids="+this.escape(keys.join(",")));
                stack.push(yii.getCsrfParam()+"="+yii.getCsrfToken());
    		if (dhtmlx.security_key)
				stack.push("dhx_security="+dhtmlx.security_key);
    		return stack.join("&");
    	}
    };

dp.setTransactionMode("POST",true);
dp.init(scheduler);


