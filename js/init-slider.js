/* on document load */
function cbSlider(what) {
	$('#photoLocatorPlaceholder').html(what['current'] + "/" + what['total']);
	$('#captionPlaceholder').html( what['caption'] );
	//alert( what['caption'] );
	//alert( what['current'] + " out of " + what['total'] );
}

jQuery(document).ready(function() {
	$('#coda-slider-1').codaSlider({
													dynamicArrows: false,
													dynamicTabs: false,
													autoHeight: false,
													callbackOnSlide: cbSlider
												});
});
