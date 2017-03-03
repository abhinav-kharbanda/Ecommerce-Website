jQuery(document).ready(function() {
	jQuery( '.cgd_eer_static_rating' ).raty( {
		path: CGD_EER_Helper.path,
		halfShow: true,
		score: function() {
			return jQuery( this ).attr( 'data-rating' );
		},
		readOnly: true
	});
	
	// Update after quick edit
	jQuery("body.edit-comments-php").bind("ajaxComplete", function() {
		jQuery( ".cgd_eer_static_rating" ).raty( {
			path: CGD_EER_Helper.path,
			halfShow: true,
			score: function() {
				return jQuery( this ).attr( 'data-rating' );
			},
			readOnly: true
		});
	});

	jQuery( '#review_stars_setter' ).raty( {
		path: CGD_EER_Helper.path,
		click: function( score, evt ) {
			jQuery( '#review_rating_input' ).val( score );
		},
		cancel: true,
		hints: [null, null, null, null, null]
	});
	
	jQuery(".eer-feedback-button").click(function(e) {
		e.preventDefault();
		
		var comment_id = jQuery(this).data("eer-comment-id");
		var vote = jQuery(this).data("eer-response");
		
		var data = {
			action: 'eer_vote',
            response_comment_id: comment_id,
            response_vote: vote
        };
        
        jQuery.getJSON(CGD_EER_Helper.ajaxurl, data, function(response) {
        	var span = ''; 
        	
        	if ( response.hasOwnProperty('error') ) {
	        	span = '<span class="eer-feedback-response error">' + response.error + '</span>';	
        	} else if ( response.hasOwnProperty('success') ) {
	        	span = '<span class="eer-feedback-response success">' + response.success + '</span>';
        	}
        	
        	jQuery('.eer-feedback-' + comment_id + ' .eer-feedback-inner').fadeOut(100, function() {
	        	jQuery(this).html(span);
	        	jQuery(this).fadeIn(100);
        	})
        });
	});
});