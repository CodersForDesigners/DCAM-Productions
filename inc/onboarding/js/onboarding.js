jQuery( document ).ready( function ( $ ) {
	$( 'body' ).on( 'click', '.vidiho-pro-onboarding-wrap .install-now ', function () {
		var slug = $( this ).attr( 'data-slug' );

		wp.updates.installPlugin(
			{
				slug: slug
			}
		);

		return false;
	} );

	$( document ).on( 'DOMNodeInserted','.activate-now', function () {
		var activateButton = $( this );
		if (activateButton.length) {
			var url = $( activateButton ).attr( 'href' );
			if (typeof url !== 'undefined') {
				// Request plugin activation.
				$.ajax(
					{
						beforeSend: function () {
							$( activateButton ).replaceWith( '<a class="button updating-message">' + vidiho_pro_onboarding.activating_text + '</a>' );
						},
						async: true,
						type: 'GET',
						url: url,
						success: function () {
							// Reload the page.
							location.reload();
						}
					}
				);
			}
		}
	} );

	$( document ).on( 'click','.activate-now', function () {
		var activateButton = $( this );
		if (activateButton.length) {
			var url = $( activateButton ).attr( 'href' );
			if (typeof url !== 'undefined') {
				// Request plugin activation.
				$.ajax(
					{
						beforeSend: function () {
							$( activateButton ).replaceWith( '<a class="button updating-message">' + vidiho_pro_onboarding.activating_text + '</a>' );
						},
						async: true,
						type: 'GET',
						url: url,
						success: function () {
							// Reload the page.
							location.reload();
						}
					}
				);
			}
		}

		return false;
	} );

	$( '.ajax-install-plugin' ).on( 'click', function( e ) {
		var button = $(this);
		var plugin_slug = button.data('plugin-slug');
		$.ajax( {
			type: 'post',
			url: ajaxurl,
			data: {
				action: 'install_vidiho_pro_plugin',
				onboarding_nonce: vidiho_pro_onboarding.onboarding_nonce,
				plugin_slug: plugin_slug,
			},
			dataType: 'text',
			beforeSend: function() {
				button.addClass('updating-message');
				button.text(vidiho_pro_onboarding.installing_text);
			},
			success: function( response ) {
				button.removeClass('updating-message');
				button.addClass('activate-now button-primary');
				button.text(vidiho_pro_onboarding.activate_text);
			}
		} );
	} );

} );
