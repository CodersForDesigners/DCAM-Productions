var vidiho_pro_repeating_sortable_init = function( selector ) {
	if ( typeof selector === 'undefined' ) {
		jQuery('.ci-repeating-fields .inner').sortable({ placeholder: 'ui-state-highlight' });
	} else {
		jQuery('.ci-repeating-fields .inner', selector).sortable({ placeholder: 'ui-state-highlight' });
	}
};

var vidiho_pro_repeating_colorpicker_init = function( selector ) {
	if ( selector === undefined ) {
		var ciColorPicker = jQuery( '#widgets-right .vidiho-pro-color-picker, #wp_inactive_widgets .vidiho-pro-color-picker' ).filter( function() {
			return !jQuery( this ).parents( '.field-prototype' ).length;
		} );

		ciColorPicker.wpColorPicker();
	} else {
		jQuery( '.vidiho-pro-color-picker', selector ).wpColorPicker();
	}
};

jQuery(document).ready(function($) {
	"use strict";
	var $body = $( 'body' );

	// Repeating fields
	vidiho_pro_repeating_sortable_init();

	$body.on( 'click', '.ci-repeating-add-field', function( e ) {
		var repeatable_area = $( this ).siblings( '.inner' );
		var fields = repeatable_area.children( '.field-prototype' ).clone( true ).removeClass( 'field-prototype' ).removeAttr( 'style' ).appendTo( repeatable_area );
		vidiho_pro_repeating_sortable_init();
		vidiho_pro_repeating_colorpicker_init();
		e.preventDefault();
	} );


	$body.on( 'click', '.ci-repeating-remove-field', function( e ) {
		var field = $(this).parents('.post-field');
		field.remove();
		e.preventDefault();
	});
});
