$(document).ready(function() {

    // page is now ready, initialize the calendar...
    $('#calendar').fullCalendar({
       
         dayClick: function(date, jsEvent, view){
            var clickDate = date.format();
            $("#start").val(clickDate);
                $("#dialog").dialog("open");

         },
    	theme: true,
    	locale: "ru",
    	eventSources: [
	    	{
	    		events: events,
	    		color: '#ff6b7f',
	    		/*OEB6A2*/
	    	}
    	],
    	/*eventSources:[
    	"file.json"
    	],*/
    	/*events:[
    	{
    		title: "Событие 1",
    		start: "2017-12-04"
    	},
    	{
    		title: "Событие 2",
    		start: "2017-12-17"
    	},
    	{
    		title: "Событие 3",
    		start: "2017-12-02"
    	},
    	],*/
    });

    

    $("#dialog").dialog({
    	autoOpen: false,
    	show: {
    		effect: "drop",
    		duration: 500
    	},
    	hide: {
    		effect: "clip",
    		duration: 500

    	}

    });

    $(".datepicker").datepicker({
    	dateFormat:"yy-mm-dd",
    	monthNames: ['Январь', 'Февраль', 'Март', 'Апрель',
		'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь',
		'Октябрь', 'Ноябрь', 'Декабрь'],
		 dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
		 firstDay: 1
		     });

	

});