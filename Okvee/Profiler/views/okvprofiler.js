/**
 * Okvee\Profiler JS.
 * 
 * @author Vee W.
 */


function loadCSS() {
	var sheet = document.createElement("style");
	sheet.setAttribute("type", "text/css");
	sheet.innerHTML = okvprofiler_css;
	document.getElementsByTagName("head")[0].appendChild(sheet);

	delete okvprofiler_css;
}// loadCSS


jQuery.noConflict();
jQuery(document).ready(function($) {
	loadCSS();

	$('.okvprofiler-see-details').on('click', 'a', function() {
		if ($(this).closest('li').hasClass('active')) {
			$('.okvprofiler-see-details').removeClass('active');
		} else {
			$('.okvprofiler-see-details').removeClass('active');
			$(this).closest('li').addClass('active');
		}
	});
});