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

	jQuery('div.withImage').find('.eventMeta').fadeOut('fast');
	jQuery('div.withImage').hover(function(){
		jQuery(this).find('.eventMeta').fadeIn("fast");
		jQuery(this).find('img').fadeOut("slow");
	}, function(){
		jQuery(this).find('.eventMeta').fadeOut("fast");
		jQuery(this).find('img').fadeIn("slow");
	});
	
	/* begin: image hovers on calendar */
	/*
	jQuery('div.eventArea').hover(function(){
		jQuery(this).find('img').fadeOut("fast"); //.css({visibility: 'hidden'}); //animate({top:'182px'},{queue:false,duration:500});
	}, function(){
		jQuery(this).find('img').fadeIn("fast"); //.css({visibility: 'visible'});
	});
	*/
	/* end: image hovers in calendar */
});
