<div class="modal hide fade" id="sss">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            &times;
        </button>
        <h3>
            Modal header
        </h3>
    </div>
    <div class="modal-body">
        <p>
            <input type="text" id="txtname" />
        </p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn">
            Close
        </a>
        <a href="#" class="btn btn-primary">
            Save changes
        </a>
    </div>
</div>
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
                        alert($('#sss').val());
                      //  $('#mymodal').innerHTML.modal('toggle');

                        var title="shit";
                        //var title = window.showModalDialog('http://localhost');

						//var title = prompt('任务名称:');
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




