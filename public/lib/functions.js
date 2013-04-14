//********************* UI *********************//
			$(function(){

				// Accordion
				$("#accordion").accordion({ header: "h3" });
	
				// Tabs
				$('#tabs').tabs();
				$('#tabs-two').tabs();
				$('#tabs-three').tabs();

				// Dialog			
				$('#dialog').dialog({
					autoOpen: false,
					width: 600,
					buttons: {
						"Ok": function() { 
							$(this).dialog("close"); 
						}, 
						"Cancel": function() { 
							$(this).dialog("close"); 
						} 
					}
				});
				
				// Dialog Link
				$('#dialog_link').click(function(){
					$('#dialog').dialog('open');
					return false;
				});

				// Datepicker
				$('#datepicker').datepicker({
					inline: true
				});
				$('#inline-datepicker').datepicker({
					inline: true
				});
				
				// Slider
				$( "#slider" ).slider();
				
				$( "#slider2" ).slider({
						value:100,
						min: 0,
						max: 500,
						step: 1,
						slide: function( event, ui ) {
							$( "#amount" ).val( "$" + ui.value );
						}
					});
				$( "#amount" ).val( "$" + $( "#slider" ).slider( "value" ) );
				$( "#slider-range" ).slider({
					range: true,
					min: 0,
					max: 500,
					values: [ 75, 300 ],
					slide: function( event, ui ) {
						$( "#amount2" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
					}
				});
				$( "#amount2" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
					" - $" + $( "#slider-range" ).slider( "values", 1 ) );
					// setup graphic EQ
				$( "#eq > span" ).each(function() {
					// read initial values from markup and remove that
					var value = parseInt( $( this ).text(), 10 );
					$( this ).empty().slider({
						value: value,
						range: "min",
						animate: true,
						orientation: "vertical"
					});
				});
				$( "#slider-range-min" ).slider({
					range: "min",
					value: 23,
					min: 23,
					max: 500,
					slide: function( event, ui ) {
						$( "#amount3" ).val( "$" + ui.value );
					}
				});
				$( "#amount3" ).val( "$" + $( "#slider-range-min" ).slider( "value" ) );
				$( "#slider-range-max" ).slider({
					range: "max",
					value: 56,
					min: 1,
					max: 350,
					slide: function( event, ui ) {
						$( "#amount4" ).val( "$" + ui.value );
					}
				});
				$( "#amount4" ).val( "$" + $( "#slider-range-min" ).slider( "value" ) );
				// Progressbar
				$("#progressbar").progressbar({
					value: 20
				});
				
				//hover states on the static widgets
				$('#dialog_link, ul#icons li').hover(
					function() { $(this).addClass('ui-state-hover'); }, 
					function() { $(this).removeClass('ui-state-hover'); }
				);
				
			});
			
//********************* TABLE (NEWS) *********************//
  $(document).ready(function() {
	$('#example').dataTable( {
		"aaSorting": [[ 0, "desc" ]]
	} );
		$('#exampl2e').dataTable( {
		"aaSorting": [[ 0, "desc" ]]
	} );

   });
//********************* Fancybox *********************//

	$(document).ready(function() {
				$("a.fancybox").fancybox({
				'titlePosition'		: 'outside',
				'overlayColor'		: '#000',
				'overlayOpacity'	: 0.8
			});
	});

//********************* Delete *********************//
	$(document).ready(function(){
		
		$('.item .delete').click(function(){
			
			var elem = $(this).closest('.item');
			
			$.confirm({
				'title'		: 'Delete Confirmation',
				'message'	: 'You are about to delete this item. <br />It cannot be restored at a later time! Continue?',
				'buttons'	: {
					'Yes'	: {
						'class'	: 'blue',
						'action': function(){
							elem.slideUp();
						}
					},
					'No'	: {
						'class'	: 'gray',
						'action': function(){}	// Nothing to do in this case. You can as well omit the action property.
					}
				}
			});
			
		});
		
	});
//********************* Select all Checkbox *********************//
	function setChecked(obj) 
		{
	
		var check = document.getElementsByName("id[]");
		for (var i=0; i<check.length; i++) 
		   {
		   check[i].checked = obj.checked;
		   }
	}

//********************* Contact list *********************//	
	 $(document).ready(function(){
         $('#slider-contact').sliderNav();
     });
//********************* Information messages *********************//
	$(document).ready(function() {
		$(".hideit").click(function() {
			$(this).fadeOut(1000);
		});
		
	});

//********************* FORMS  *********************//
	//select
	$(document).ready(function() {
	 $(".chzn-select").chosen(); $(".chzn-select-deselect").chosen({allow_single_deselect:true}); 
	});
	
	$(document).ready(function(){
	$("input[type=file]").change(function(){$(this).parents(".uploader").find(".filename").val($(this).val());});
	$("input[type=file]").each(function(){
	if($(this).val()==""){$(this).parents(".uploader").find(".filename").val("No file selected...");}
	});
	});
//********************* CALENDAR *********************//			
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
				var title = prompt('Event Title:');
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
				{
					title: 'All Day Event',
					start: new Date(y, m, 1)
				},
				{
					title: 'Long Event',
					start: new Date(y, m, d-5),
					end: new Date(y, m, d-2)
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: new Date(y, m, d-3, 16, 0),
					allDay: false
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: new Date(y, m, d+4, 16, 0),
					allDay: false
				},
				{
					title: 'Meeting',
					start: new Date(y, m, d, 10, 30),
					allDay: false
				},
				{
					title: 'Lunch',
					start: new Date(y, m, d, 12, 0),
					end: new Date(y, m, d, 14, 0),
					allDay: false
				},
				{
					title: 'Birthday Party',
					start: new Date(y, m, d+1, 19, 0),
					end: new Date(y, m, d+1, 22, 30),
					allDay: false
				},
				{
					title: 'Click for Google',
					start: new Date(y, m, 28),
					end: new Date(y, m, 29),
					url: 'http://google.com/'
				}
			]
		});
		
	});


//********************* File explorer *********************//
	$(document).ready(function(){
			
			var f = $('#finder').elfinder({
				url : 'lib/elfinder/connectors/php/connector.php',
				lang : 'en',
				docked : true

				// dialog : {
				// 	title : 'File manager',
				// 	height : 500
				// }

				// Callback example
				//editorCallback : function(url) {
				//	if (window.console && window.console.log) {
				//		window.console.log(url);
				//	} else {
				//		alert(url);
				//	}
				//},
				//closeOnEditorCallback : true
			})
			// window.console.log(f)
			$('#close,#open,#dock,#undock').click(function() {
				$('#finder').elfinder($(this).attr('id'));
			})
			
		});
		
		
//********************* EDITOR *********************//
		$(document).ready(function(){
			$('#editor').wysiwyg({
				controls:"bold,italic,|,undo,redo,image"
			});
		});
		
//********************* ACCARDION *********************//	
	$(document).ready(function(){
		$('.accordion h2').click(function(){
		if( $(this).next().is(':hidden') )
			{
			$('.accordion h2').removeClass('active').next().slideUp();		
			$(this).addClass('active').next().slideDown();
			}
			return false;
		});
	});


//********************* Tooltip *********************//	
	$(function(){
		
		$(".tip-top").tipTip({defaultPosition: "top", delay: 1000});
		$(".tip-bottom").tipTip({defaultPosition: "bottom", delay: 1000});
		$(".tip-left").tipTip({defaultPosition: "left", delay: 1000});
		$(".tip-right").tipTip({defaultPosition: "right", delay: 1000});
	});
	
//********************* autorisize *********************//	

	$(document).ready(function() {
	$('textarea.resize-text').autoResize({});
	});
	
//********************* Auto TAB (Input) *********************//
	$(document).ready(function() {
		$('#autotab_example').submit(function() { return false; });
		$('#autotab_example :input').autotab_magic();
		// Number example
		$('#area_code, #number1, #number2').autotab_filter('numeric');
		$('#ssn1, #ssn2, #ssn3').autotab_filter('numeric');
		// Text example
		$('#text1, #text2, #text3').autotab_filter('text');
		// Alpha example
		$('#alpha1, #alpha2, #alpha3, #alpha4, #alpha5').autotab_filter('alpha');
		// Alphanumeric example
		$('#alphanumeric1, #alphanumeric2, #alphanumeric3, #alphanumeric4, #alphanumeric5').autotab_filter({ format: 'alphanumeric', uppercase: true });
		$('#regex').autotab_filter({ format: 'custom', pattern: '[^0-9\.]' });
	});

//********************* ProgressBar *********************//
	$(document.body).ready(function()
	{
		
		$('a').click(function()
		{
			
			$('#pb div').stop(true).animate({width: $(this).attr('class') + '%'},
			{
				
				step: function(now)
				{
					
					$(this).text(Math.round(now) + '%');
				},
				duration: 2000
			});
		});

		
		setInterval(function()
		{
			x = parseInt($('#pb div').css('background-position-x')) + 1;
			$('#pb div').css('background-position-x', '' + x + 'px');
		}, 35);
	});	
	
//****************** CHARTS ****************//
