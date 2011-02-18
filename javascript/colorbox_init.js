;(function($) {
	$(document).ready(function() {
		$('.colorbox').colorbox({
				current: "Image {current} of {total}" 
			});
			$('.colorboxPage').colorbox({  
				href: function() {
					return $(this).attr("href")+"/colorboxpage?debug_request=1"
				}
			});
			$('.colorboxIframe').colorbox({ innerWidth:"644", innerHeight:"540", iframe:true });
		});
})(jQuery);