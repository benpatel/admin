/**
* Theme: Uplon Admin Template
* Author: Coderthemes
* Component: Full-Calendar
* 
*/




!function($) {
    "use strict";

    var CalendarApp = function() {
        this.$body = $("body")
        this.$modal = $('#event-modal'),
        this.$event = ('#external-events div.external-event'),
        this.$calendar = $('#calendar'),
        this.$saveCategoryBtn = $('.save-category'),
        this.$categoryForm = $('#add-category form'),
        this.$extEvents = $('#external-events'),
        this.$calendarObj = null
    };


    /* on drop 
    CalendarApp.prototype.onDrop = function (eventObj, date) { 
        var $this = this;
            // retrieve the dropped element's stored Event Object
            var originalEventObject = eventObj.data('eventObject');
            var $categoryClass = eventObj.attr('data-class');
            // we need to copy it, so that multiple events don't have a reference to the same object
            var copiedEventObject = $.extend({}, originalEventObject);
            // assign it the date that was reported
            copiedEventObject.start = date;
            if ($categoryClass)
                copiedEventObject['className'] = [$categoryClass];
            // render the event on the calendar
            $this.$calendar.fullCalendar('renderEvent', copiedEventObject, true);
            // is the "remove after drop" checkbox checked?
            if ($('#drop-remove').is(':checked')) {
                // if so, remove the element from the "Draggable Events" list
                eventObj.remove();
            }
    },*/
    /* on click on event */
    CalendarApp.prototype.onEventClick =  function (calEvent, jsEvent, view) {
        var $this = this;
            var form = $("<form></form>");
            form.append("<label>Change event name</label>");
            form.append("<div class='input-group'><input class='form-control' type=text value='" + calEvent.title + "' /><span class='input-group-btn'><button type='submit' class='btn btn-success waves-effect waves-light'><i class='fa fa-check'></i> Save</button></span></div>");
            $this.$modal.modal({
                backdrop: 'static'
            });
            var evt_title;
            var evt_start;
            var evt_end;
            var evt_class; 
            $this.$modal.find('.delete-event').show();
            $this.$modal.find('.save-event').hide();
            $this.$modal.find('.modal-body').empty().prepend(form);
            $this.$modal.find('.delete-event').unbind('click').click(function () {
                $this.$calendarObj.fullCalendar('removeEvents', function (ev) {

                    evt_title =calEvent.title;
                    evt_start = moment(calEvent.start).format("YYYY-MM-DD");
                    evt_end = moment(calEvent.end).subtract(1, 'days').format("YYYY-MM-DD");
                    evt_class = calEvent.className[0];

                    return (ev._id == calEvent._id);

                });

                console.log(evt_title);
                console.log(evt_start);
                console.log(evt_end);
                console.log(evt_class);


                var post_data = {
                    "start_date" : evt_start,
                    "end_date" : evt_end,
                    "city_name":evt_title,
                    "class":evt_class
                }

                $.ajax({
                    url: "delete_schedule.php",
                    method: "POST",
                    data: post_data,
                    dataType: "json",
                    beforeSend:function(){

            
                    }, 
                    success: function(data){
                            if(data.status=='success'){
                               
                               console.log("success");
                            }   
                    },
                     error:function(){
                      
                      }
                });

                $this.$modal.modal('hide');
            });
            $this.$modal.find('form').on('submit', function () {
                calEvent.title = form.find("input[type=text]").val();
                console.log(calEvent);

                evt_title =calEvent.title;
                evt_start = moment(calEvent.start).format("YYYY-MM-DD");
                evt_end = moment(calEvent.end).subtract(1, 'days').format("YYYY-MM-DD");
                evt_class = calEvent.className[0];

                console.log(evt_title);
                console.log(evt_start);
                console.log(evt_end);
                console.log(evt_class);


                var post_data = {
                    "start_date" : evt_start,
                    "end_date" : evt_end,
                    "city_name":evt_title,
                    "class":evt_class
                }
                $.ajax({
                    url: "edit_schedule.php",
                    method: "POST",
                    data: post_data,
                    dataType: "json",
                    beforeSend:function(){

            
                    }, 
                    success: function(data){
                            if(data.status=='success'){
                               
                               console.log("success");
                            }   
                    },
                     error:function(){
                      
                      }
                });



                $this.$calendarObj.fullCalendar('updateEvent', calEvent);
                $this.$modal.modal('hide');
                return false;
            });
    },
    /* on select */
    CalendarApp.prototype.onSelect = function (start, end, allDay) {
        var $this = this;
            $this.$modal.modal({
                backdrop: 'static'
            });
            var form = $("<form></form>");
            form.append("<div class='row'></div>");
            form.find(".row")
                .append("<div class='col-md-6'><div class='form-group'><label class='control-label'>City Name</label><input class='form-control' placeholder='Insert Event Name' type='text' name='title'/></div></div>")
                .append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Color</label><select class='form-control' name='category'></select></div></div>")
                .find("select[name='category']")
                .append("<option value='bg-danger'>Red</option>")
                .append("<option value='bg-success'>Green</option>")
                .append("<option value='bg-purple'>Purple</option>")
                .append("<option value='bg-primary'>Blue</option>")
                .append("<option value='bg-pink'>Pink</option>")
                .append("<option value='bg-warning'>Yellow</option></div></div>");
            $this.$modal.find('.delete-event').hide().end().find('.save-event').show().end().find('.modal-body').empty().prepend(form).end().find('.save-event').unbind('click').click(function () {
                form.submit();
            });
            $this.$modal.find('form').on('submit', function () {
                var title = form.find("input[name='title']").val();
                var beginning = form.find("input[name='beginning']").val();
                var ending = form.find("input[name='ending']").val();
                var categoryClass = form.find("select[name='category'] option:checked").val();

                var start_date = moment(start._d).add(1, 'days').format("YYYY-MM-DD");
                var end_date = moment(end._d).format("YYYY-MM-DD");
                
                var post_data = {
                    "start_date" : start_date,
                    "end_date" : end_date,
                    "city_name":title,
                    "class":categoryClass
                }

                $.ajax({
                    url: "add_schedule.php",
                    method: "POST",
                    data: post_data,
                    dataType: "json",
                    beforeSend:function(){

            
                    }, 
                    success: function(data){
                            if(data.status=='success'){
                               
                               console.log("success");
                            }   
                    },
                     error:function(){
                      
                      }
                });
                    
                if (title !== null && title.length != 0) {
                    $this.$calendarObj.fullCalendar('renderEvent', {
                        title: title,
                        start:start,
                        end: end,
                        allDay: true,
                        className: categoryClass
                    }, true);  
                    $this.$modal.modal('hide');
                }
                else{
                    alert('You have to give a title to your event');
                }
                return false;
                
            });
            $this.$calendarObj.fullCalendar('unselect');
    },
    CalendarApp.prototype.enableDrag = function() {
        //init events
        $(this.$event).each(function () {
            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
                title: $.trim($(this).text()) // use the element's text as the event title
            };
            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);
            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 999,
                revert: true,      // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
            });
        });
    }


    CalendarApp.prototype.init = function() {
        this.enableDrag();
        /*  Initialize the calendar  */
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        var form = '';
        var today = new Date($.now());
/*
        var defaultEvents =  [{
                title: 'Hey!',
                start: new Date($.now() + 158000000),
                className: 'bg-purple'
            }, {
                title: 'See John Deo',
                start: today,
                end: today,
                className: 'bg-danger'
            }, {
                title: 'Buy a Theme',
                start: new Date($.now() + 338000000),
                className: 'bg-primary'
            }];
*/
        
          var defaultEvents =  [{
                title: 'Hey!',
                start: new Date($.now() + 158000000),
                className: 'bg-purple',
                allDay: true
            }, {
                title: 'See John Deo',
                start:new Date('08/06/2018'),
                end: new Date('08/12/2018'),
                className: 'bg-danger',
                allDay: true
            }, {
                title: 'Buy a Theme',
                start: new Date($.now() + 338000000),
                className: 'bg-primary',
                allDay: true
            },{
                title: 'newTheme',
                start: new Date($.now() + 338000000),
                className: 'bg-danger',
                allDay: true
            }];
        
        var $this = this;
        $this.$calendarObj = $this.$calendar.fullCalendar({
            slotDuration: '00:15:00', /* If we want to split day time each 15minutes */
            minTime: '00:00:00',
            maxTime: '24:00:00',  
            defaultView: 'month',  
            handleWindowResize: true,   
            height: $(window).height() - 200,
            timezone:'local',   
            header: {
                left: 'prev',
                center: 'title',
                right: 'next'
            },
          //  events: defaultEvents,
            
            events: function (start, end,timezone, callback) {
                $.ajax({
                    type:'POST',
                    url: 'calender_data.php',
                    dataType: 'json',
                    data: {
                        start: start.toLocaleString("yyyy-mm-dd"),
                        end: end.toLocaleString("yyyy-mm-dd")
                    },
                    error: function (xhr, type, exception) { alert("Error: " + exception); },
                    success: function (response) {
                        var events = [];
            
                        
                        for (var event_key in response) {
                            events.push(response[event_key]);
                        }
                        
                        
                        
                        
                        callback(events);
                    }
                    });  
            },
            selectable: true,
            drop: function(date) { $this.onDrop($(this), date); },
            select: function (start, end, allDay) { $this.onSelect(start, end, allDay); },
            eventClick: function(calEvent, jsEvent, view) { $this.onEventClick(calEvent, jsEvent, view); }

        });

   /*     //on new event
        this.$saveCategoryBtn.on('click', function(){
            var categoryName = $this.$categoryForm.find("input[name='category-name']").val();
            var categoryColor = $this.$categoryForm.find("select[name='category-color']").val();
            if (categoryName !== null && categoryName.length != 0) {
                $this.$extEvents.append('<div class="external-event bg-' + categoryColor + '" data-class="bg-' + categoryColor + '" style="position: relative;"><i class="fa fa-move"></i>' + categoryName + '</div>')
                $this.enableDrag();
            }

        });
        */
    },

   //init CalendarApp
    $.CalendarApp = new CalendarApp, $.CalendarApp.Constructor = CalendarApp
    
}(window.jQuery),

//initializing CalendarApp
function($) {
    "use strict";
    $.CalendarApp.init()
}(window.jQuery);
