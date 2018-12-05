<?php
?>

<style>
	.pricing-section {
		padding: 60px 0;
		color: #FFFFFF;
		background-color: #005AEE;
	}

	.pricing-section .title {
		text-align: center
	}
	.pricing-section .description {
		text-align: center;
		margin: 0 auto;
	}


	.block-inline {
		display: inline-block;
		vertical-align: baseline;
	}

	.pricing-section .radio-group {
		position: relative;
		margin: 0 auto;
		margin-top: 15px;
		margin-bottom: 30px;
		white-space: nowrap;
		font-size: 0;
	}

	.pricing-section .radio-group .radio-input {
		position: relative;
		text-align: center;
		width: 20%;
	}

	.pricing-section .radio-group .radio-input input {
		position: absolute;
		opacity: 0;
		z-index: 1;
	}

	.pricing-section .radio-group .radio-input input + span {
		position: relative;
		z-index: 2;
		display: inline-block;
		line-height: 30px;
		width: 34px;
		color: #D5D9E0;
		border: solid 2px #D5D9E0;
		border-radius: 100%;
		cursor: pointer;
		font-size: 15px;
		transition: color .3s ease-out, border .3s ease-out, background .3s ease-out;
	}

	.pricing-section .radio-group .radio-input input:disabled + span {
		cursor: not-allowed;
		opacity: 0.5;
	}

	.pricing-section .radio-group .radio-input input:checked + span {
		color: #FFFDE7;
		/*border-color: #8BC34A;*/
		border-color: #FD8320;
		/*background-color: #8BC34A;*/
		background-color: #FD8320;
	}

	.pricing-section .total {
		position: relative;
		display: inline-block;
		margin: 0 auto 1.5rem;
		border-top: solid 2px #D5D9E0;
		border-bottom: solid 2px #D5D9E0;
		padding: 10px 0;
	}

	.pricing-section .total .price {
		color: #FD8320;
		white-space: nowrap;
	}

	.pricing-section .question {
		margin-bottom: 0;
		font-weight: 400;
		text-transform: none;
	}

	@media (min-width: 992px){
		.pricing-section {
			padding: 100px 0;
		}
		.pricing-section .description {
			width:80%;
		}

		.pricing-section .radio-group {
			width: 60%;
		}

	}

</style>

<div id="pricing" class="pricing-section">
	<div class="row justify-content-center">
		<form class="col-10 text-center js_cost_estimator">
			<div class="section-heading">
				<div class="section-heading-content">
					<h1 class="title"><?php echo $title ?></h1>
					<p class="description"><?php echo $description ?></p>
				</div>
			</div>

			<h2 class="total">
				<span>Estimated Budget Range</span>
				<span class="price">
					<span class="js_min_estimate">6.51</span><span> — </span><span class="js_max_estimate">8.82</span><span>L</span>
				</span>
			</h2>

			<h4 class="question">How many **cities would we have to shoot in?</h6>
				<div class="radio-group">
					<label class="radio-input block-inline"><input type="radio" name="city" value="1" class="js_input_cities" checked><span>1</span></label>
					<label class="radio-input block-inline"><input type="radio" name="city" value="2" class="js_input_cities"><span>2</span></label>
					<label class="radio-input block-inline"><input type="radio" name="city" value="3" class="js_input_cities"><span>3</span></label>
					<label class="radio-input block-inline"><input type="radio" name="city" value="4" class="js_input_cities"><span>4</span></label>
					<label class="radio-input block-inline"><input type="radio" name="city" value="5" class="js_input_cities"><span>5</span></label>
				</div>
			<h4 class="question">How many *locations would we need to shoot at?</h6>
				<div class="radio-group">
					<label class="radio-input block-inline"><input type="radio" name="location" value="1" class="js_input_locations" checked><span>1</span></label>
					<label class="radio-input block-inline"><input type="radio" name="location" value="2" class="js_input_locations"><span>2</span></label>
					<label class="radio-input block-inline"><input type="radio" name="location" value="3" class="js_input_locations"><span>3</span></label>
					<label class="radio-input block-inline"><input type="radio" name="location" value="4" class="js_input_locations"><span>4</span></label>
					<label class="radio-input block-inline"><input type="radio" name="location" value="5" class="js_input_locations"><span>5</span></label>
				</div>
			<h4 class="question">Number of iterations included on script and edit.</h6>
				<div class="radio-group">
					<label class="radio-input block-inline"><input type="radio" name="iteration" value="1" class="js_input_iterations" disabled><span>1</span></label>
					<label class="radio-input block-inline"><input type="radio" name="iteration" value="2" class="js_input_iterations" checked><span>2</span></label>
					<label class="radio-input block-inline"><input type="radio" name="iteration" value="3" class="js_input_iterations"><span>3</span></label>
					<label class="radio-input block-inline"><input type="radio" name="iteration" value="4" class="js_input_iterations"><span>4</span></label>
					<label class="radio-input block-inline"><input type="radio" name="iteration" value="5" class="js_input_iterations"><span>5</span></label>
				</div>

			<div class="disclaimers">
				<small>*If you need to travel a minimum of 2 kms to reach the next location, then it counts as a second location</small><br>
				<small>**Accomodation and Travel will be charged at actuals outside Bangalore City limits</small><br>
				<small>This estimate is indicative and will not be considered a formal quote.</small><br>
			</div>

		</form>
	</div>



</div>

<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/xlsx-calc-v0.4.1.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/spreadsheet-formulae.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js" defer></script>
<script type="text/javascript">

	/*
	 *
	 * Animate the count-down or count-up of a number in the INR format
	 *
	 */
	// var easings = [ "linear", "easeInQuad", "easeOutQuad", "easeInOutQuad", "easeInCubic", "easeOutCubic", "easeInOutCubic", "easeInQuart", "easeOutQuart", "easeInOutQuart", "easeInQuint", "easeOutQuint", "easeInOutQuint", "easeInSine", "easeOutSine", "easeInOutSine", "easeInExpo", "easeOutExpo", "easeInOutExpo", "easeInCirc", "easeOutCirc", "easeInOutCirc", "easeInElastic", "easeOutElastic", "easeInOutElastic", "easeInBack", "easeOutBack", "easeInOutBack", "easeInBounce", "easeOutBounce", "easeInOutBounce" ];
	var easings = [ "linear", "swing", "easeOutExpo", "easeOutBack", "easeInOutBounce", "easeOutElastic" ];
	var currentEasingIndex = -1;
	function countToNumber ( $el, amount, options ) {

		options = options || { };
		var duration = 500;
		if ( options.for == "random" )
			duration += Math.round( Math.random() * 1000 )
		else if ( typeof options.for == "number" )
			duration += options.for;
		var roundPrecision = options.round;
		var formatToINR = options.INR;

		// Cancel any animations that are already in progress for this element
		$el.stop( true );

		// We want to explicitly the starting point for the animation.
		// The is only needed for the first time an animation on an element is run.
		var currentAmount = $el.text().replace( /[^\d\.]/g, "" );
		$el.animate( { amount: currentAmount }, 0 ).stop( true, true );

		// Cycle through different easing styles
		currentEasingIndex = ( currentEasingIndex + 1 ) % easings.length;
		// console.log( easings[ currentEasingIndex ], "for", duration );
		var easing = jQuery.easing.easeOutExpo ? easings[ currentEasingIndex ] : "swing";

		// Now, tween on!
		$el.animate( { amount: amount }, {
			duration: duration,
			easing: easing,
			progress: function () {
				var formattedAmount = this.amount;
				if ( roundPrecision === true )
					formattedAmount = Math.round( formattedAmount );
				else if ( roundPrecision !== false )
					formattedAmount = formattedAmount.toFixed( roundPrecision );
				if ( formatToINR )
					formattedAmount = "₹" + formattedAmount;

				$el.text( formattedAmount );
			}
		} );

	}



	/*
	 *
	 * Extend the XLSX-CALC library with s'more formulae
	 *
	 */
	XLSX_CALC.import_functions( spreadsheetFormulae );

	// Set up the interactions for the cost estimator
	jQuery( function ( $ ) {
		function getSelectedInputs ( $form ) {
			var cities = $form.find( ".js_input_cities:checked" ).val();
			var locations = $form.find( ".js_input_locations:checked" ).val();
			var iterations = $form.find( ".js_input_iterations:checked" ).val();
			// Number of "locations" must be greater than or equal to the number of "cities"
			if ( locations < cities ) {
				$form.find( ".js_input_locations[ value = " + cities + " ]" ).prop( "checked", true );
				locations = cities;
			}
			// Also, disable all the "locations" input that cannot be selected
			var locationInputs = cities - 1;
			$form.find( ".js_input_locations" ).prop( "disabled", false );
			while ( locationInputs > 0 ) {
				$form.find( ".js_input_locations[ value = " + locationInputs + " ]" ).prop( "disabled", true );
				locationInputs -= 1;
			}
			// Finally, return number of cities, locations, and iterations
			return {
				cities: cities,
				locations: locations,
				iterations: iterations,
			};
		}
		$.getJSON( "<?php echo $spreadsheet_processed_file ?>".replace( "/var/www/html/", "" ), function ( workbook ) {
				// On changing any of the variables, re-calculate the cost
				$( ".js_cost_estimator" ).on( "change", "input", function ( event ) {
					var $form = $( event.target ).closest( ".js_cost_estimator" );
					var inputData = getSelectedInputs( $form );
					var sheet = workbook.Sheets.Calculator;
					sheet.B5.v = inputData.cities;
					sheet.B3.v = inputData.locations;
					sheet.B7.v = inputData.iterations;
					XLSX_CALC( workbook );
					var minEstimate = sheet.B11.v;
					var maxEstimate = sheet.C11.v;
					countToNumber( $form.find( ".js_min_estimate" ), minEstimate, { for: "random", round: 2, INR: true } );
					countToNumber( $form.find( ".js_max_estimate" ), maxEstimate, { for: "random", round: 2, INR: true } );
				} )

				// Show the Cost Estimator
					// But first, initialize the estimates with some default input
				$( ".js_cost_estimator input" ).first().trigger( "change" );

		} )
	} );

</script>
