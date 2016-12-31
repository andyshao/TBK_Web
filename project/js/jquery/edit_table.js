;(function($){
	$.fn.extend({
		"edit_table":function(options){
			var opt=$.extend(defaults,options);
			$(this).live("click",function(){
				var cur_ob=$(this);
				var orig_value=$(this).html();
				var this_parent=$(this).parent();
				var rdId=is_null(cur_ob.attr('id'))?this_parent.siblings(".rdId").find("input").attr("value"):cur_ob.attr('id');
				var curr_index=this_parent.parent().children("td").index(this_parent);
				var col_value=is_null(cur_ob.attr('f'))?$("#trth th").eq(curr_index).attr("id"):cur_ob.attr('f');
				if($(this).find("input").length==0) $(this).html("<input class='inputstyle' type='text' size='30' value='"+orig_value+"' />");
				$(this).find("input").focus();
				$(this).find("input").blur(function(){
					var input_value=$(this).val();
					if (input_value!=orig_value)
					{
						if( ! is_null(cur_ob.attr('dataType')))
						{
							if(cur_ob.attr('dataType') == 'Currency')
							{
								var reg = new RegExp(/^\d+(\.\d+)?$/);
								if( ! reg.test(input_value))
								{
									alert('输入的价格有误');
									return;
								}
							}
						}
						var pvalue=escape(input_value);
						var param='';
						if(opt.param)
						{
							$.each(opt.param,function(k,v){
									param += '&' + k + '=' + escape(v);	
								});
						}
						cur_ob.html("数据处理中，请稍等...");
						$.ajax({
							 type: "POST",
							 url: js_root_path+'common/ajax_save',
							 data: "rd_id="+rdId+"&form_value="+pvalue+"&field_value="+col_value+param,
							 success: function(msg){ 
								if(msg==1) {
									cur_ob.html(input_value);
								} else {
									cur_ob.html(orig_value);
								}
							 },
							 error: function(){ 
								cur_ob.html(orig_value);
							 }
						}); 
					}
					else
					{
						cur_ob.html(orig_value);
					}
				});
			});
			function is_null(v)
			{
				if(typeof(v) == 'undefined') return true;
				else if(v == '') return true;
				else return false;
			}
		}
	});
	var defaults={
		param:false
	};
})(jQuery);