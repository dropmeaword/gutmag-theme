/* @begin scrolling shenannigans */
function moveScroller() {
  var a = function() {
    var b = $(window).scrollTop();
    var d = $("#scroller-anchor").offset().top;
    if ( b > (d-40) ) {
      $("#scroller").css({position:"fixed",top:"40px"})
    } else {
      if ( b <= d) {
        $("#scroller").css({position:"relative",top:""})
      }
    }
  };
  $(window).scroll(a);a()
}

function scrollToId(id){
     	$('html,body').animate({scrollTop: $("#"+id).offset().top},'slow');
}
/* @end scrolling shenannigans */

/* on document load */
jQuery(document).ready(function() {
	jQuery('ul.sf-menu').superfish();

	/* begin: code for the city selector */
	var tabId = jQuery.cookie('whichcalendar');
	if(tabId && 0 != tabId.length) {
		jQuery('li#'+tabId).addClass('highlight');
	}
	
	jQuery('.calendarSwitch').click(function(event) {
		var calId = event.target.id;
		if( !jQuery(event.target).hasClass('highlight') ) {
			jQuery('.highlight').removeClass('highlight');
			jQuery(event.target).addClass('highlight');
			jQuery.cookie('whichcalendar', calId, { expires: (365*4), path: '/' });
			window.location.reload();
		}
	});
	/* end: code for the city selector */
	
});
