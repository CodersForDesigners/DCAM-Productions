jQuery( document ).ready( function( $ ) {
	$( '.vidiho-pro-onboarding-notice' ).on( 'click', '.notice-dismiss', function( e ) {
		$.ajax( {
			type: 'post',
			url: ajaxurl,
			data: {
				action: 'vidiho_pro_dismiss_onboarding',
				nonce: vidiho_pro_Onboarding.dismiss_nonce,
				dismissed: true
			},
			dataType: 'text',
			success: function( response ) {
				// console.log( response );
			}
		} );
	});
} );
