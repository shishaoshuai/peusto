$(function() {
				var spinner_hour = $( "#duration_hour" ).spinner({
					min: 0,
					max: 500,
					step: 1,
					start: 0
				});
				var spinner_minute = $( "#duration_minute" ).spinner({
					min: 0,
					max: 60,
					step: 5,
					start: 0
				});
				 $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
				 $('.due_time').datetimepicker({
					language:  'zh-CN',
					weekStart: 1,
					todayBtn:  1,
					autoclose: 1,
					todayHighlight: 1,
					startView: 2,
					forceParse: 0,
					showMeridian: 1
				});

				
				$('.start_time').datetimepicker({
					language:  'zh-CN',
					weekStart: 1,
					todayBtn:  1,
					autoclose: 1,
					todayHighlight: 1,
					startView: 2,
					forceParse: 0,
					showMeridian: 1
				});

			});
			
