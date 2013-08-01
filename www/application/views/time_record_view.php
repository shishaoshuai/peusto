
		<script>
			$(document).ready(function() {
				var date = new Date();
				var d = date.getDate();
				var m = date.getMonth();
				var y = date.getFullYear();
				
				var calendar = $('#calendar').fullCalendar({
					header: {
						left: 'prev,next today',
						center: 'title',
						right: 'month,agendaWeek,agendaDay'
					},
					selectable: true,
					selectHelper: true,
					select: function(start, end, allDay) {
						var title = prompt('ÈÎÎñÃû³Æ:');
						if (title) {
							calendar.fullCalendar('renderEvent',
								{
									title: title,
									start: start,
									end: end,
									allDay: allDay
								},
								true // make the event "stick"
							);
						}
						calendar.fullCalendar('unselect');
					},
					editable: true,
					events: [
					]
				});
				
			});
		</script>

				
				<div class="span10" id='calendar'></div>							
			</div>
		</div>

