/** BEGIN MAGNIFIC POPUP **/
	if ($('.magnific-popup-wrap').length > 0){
			$('.magnific-popup-wrap').each(function() {
			"use strict";
				$(this).magnificPopup({
					delegate: 'a.zooming',
					type: 'image',
					removalDelay: 300,
					mainClass: 'mfp-fade',
					gallery: {
					  enabled:true
					}
				});
			}); 
	}
	
	if ($('.inline-popups').length > 0){
			$('.inline-popups').magnificPopup({
			  delegate: 'a',
			  removalDelay: 500,
			  callbacks: {
				beforeOpen: function() {
				   this.st.mainClass = this.st.el.attr('data-effect');
				}
			  },
			  midClick: true
			});
	}
	$('.magnific-img').magnificPopup({
		type:'image',
		removalDelay: 300,
		mainClass: 'mfp-fade'
	});
	/** END MAGNIFIC POPUP **/