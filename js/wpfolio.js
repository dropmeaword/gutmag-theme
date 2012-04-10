/* on document load */
jQuery(document).ready(function() {
	$('ul.sf-menu').superfish();

	/* begin: code for the city selector */
	var tabId = $.cookie('whichcalendar');
	if(tabId && 0 != tabId.length) {
		$('li#'+tabId).addClass('highlight');
	}
	
	$('.calendarSwitch').click(function(event) {
		var calId = event.target.id;
		if( !$(event.target).hasClass('highlight') ) {
			$('.highlight').removeClass('highlight');
			$(event.target).addClass('highlight');
			$.cookie('whichcalendar', calId, { expires: (365*4), path: '/' });
			window.location.reload();
		}
		/*alert("You chose " + calId);*/
	});
	/* end: code for the city selector */
	
});
