<?php
/**
 * Plugin Name:   Pricing Calculator
 * Description:   It provides a cost estimate for a shoot
 * Version:       0.1
 * Author:        Lazaro
 */

/*
 *
 * TODO:
 * 1. Track the selected file in the media library on re-opening it.
 * 2. Update version of XLSX-CALC.
 * 3. Add the processed workbook "formally" to the media library. Creating and deleting it through the FileSystem API ain't cutting it.
 *
 */

class WidgetCostEstimator extends WP_Widget {

	function __construct () {
		$options = [
			'classname' => 'lazaro-pricing-calculator',
			'description' => esc_html__( 'It provides a cost estimate for a shoot', 'text_domain' ),
		];
		parent::__construct( 'lazaro_pricing_calculator', esc_html__( 'Pricing Calculator' ), $options );
	}

	public function widget ( $args, $instance ) {

		// The "Before" widget markup, i.e. closing / opening tag(s)
		echo $args[ 'before_widget' ];

		// The "meat" of the UI
		echo $this->render( $instance );

		// The "After" widget markup, i.e. closing / opening tag(s)
		echo $args[ 'after_widget' ];

		// Load the Spreadsheet Formula Calculator library, i.e. XLSX Calc
		wp_enqueue_script( 'lazaro-xlsx-calc' );
		// Load our custom spreadsheet formulae implementations
		wp_enqueue_script( 'lazaro-spreadsheet-formulae' );

	}

	public function form ( $instance ) {

		$description = $instance[ 'description' ] ?? '';
		$title = $instance[ 'title' ] ?? '';
		// Spreadsheet file-related data
		$spreadsheetBaseDir = $instance[ 'spreadsheet_base_dir' ] ?? '';
		$spreadsheetFilename = $instance[ 'spreadsheet_filename' ] ?? '';

		?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ) ?>">
					<?php esc_attr_e( 'Title:', 'text_domain' ) ?>
				</label>
				<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ) ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ) ?>" value="<?php echo esc_attr( $title ) ?>">
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ) ?>">
					<?php esc_attr_e( 'Description:', 'text_domain' ) ?>
				</label>
				<textarea id="<?php echo esc_attr( $this->get_field_id( 'description' ) ) ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'description' ) ) ?>"><?php echo esc_attr( $description ) ?></textarea>
			</p>
			<p>

				<!-- Hidden / Internal fields that store meta-data on the spreadsheet -->
				<input type="text" name="<?php echo esc_attr( $this->get_field_name( 'spreadsheet_base_dir' ) ) ?>" id="<?php echo esc_attr( $this->get_field_id( 'spreadsheet_base_dir' ) ) ?>" class="js_pc_spreadsheet_base_dir" value="<?php echo esc_attr( $spreadsheetBaseDir ) ?>" style="display: none">
				<input type="text" name="<?php echo esc_attr( $this->get_field_name( 'spreadsheet_filename' ) ) ?>" id="<?php echo esc_attr( $this->get_field_id( 'spreadsheet_filename' ) ) ?>" class="js_pc_spreadsheet_filename" value="<?php echo esc_attr( $spreadsheetFilename ) ?>" style="display: none">

				<!-- User visible fields -->
				<label for="<?php echo esc_attr( $this->get_field_id( 'spreadsheet' ) ) ?>">
					<?php esc_attr_e( 'Spreadsheet:', 'text_domain' ) ?>
				</label>
				<span type="text" class="widefat js_pc_spreadsheet_filename_text"><?php echo esc_attr( $spreadsheetFilename ) ?></span>
				<br>
				<a href="#" class="button js_pc_select_spreadsheet"><?php echo esc_html_e( 'Select', 'text_domain' ) ?></a>

			</p>

			<script type="text/javascript">

				jQuery( function ( $ ) {
					$( ".js_pc_select_spreadsheet" ).on( "click", function ( event ) {

						var $widgetForm = $( event.target ).closest( "form" );

						var fileSelectorDialog = wp.media( {
							title: "Select Spreadsheet",
							button: { text: "This one" },
							multiple: false
						} );

						fileSelectorDialog.on( "select", function () {
							var attachment = fileSelectorDialog.state().get('selection').first().toJSON();

							// Get and Set the spreadsheet-related meta-data
							var baseDirectory = attachment.url
								.replace( /[^/]+\/\/[^/]+\//, "" )
								.replace( attachment.filename, "" )
							$widgetForm.find( ".js_pc_spreadsheet_base_dir" ).val( baseDirectory ).trigger( "change" );
							$widgetForm.find( ".js_pc_spreadsheet_filename" ).val( attachment.filename ).trigger( "change" );
							$widgetForm.find( ".js_pc_spreadsheet_filename_text" ).text( attachment.filename )
							// attachment.icon	// a file type specific icon
							// attachment.name	// attachment name
							// attachment.title	// more readable name
						} );

						fileSelectorDialog.open();
					} );
				} );

			</script>
		<?php

	}

	public function update ( $new_instance, $old_instance ) {
		$instance = ! empty( $old_instance ) ? $old_instance : [ ];
		$instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );
		$instance[ 'description' ] = $new_instance[ 'description' ] ?? '';
		$instance[ 'spreadsheet_base_dir' ] = $new_instance[ 'spreadsheet_base_dir' ] ?? '';
		$instance[ 'spreadsheet_filename' ] = $new_instance[ 'spreadsheet_filename' ] ?? '';

		// Delete the current "processed spreadsheet" file
		require_once ABSPATH . 'wp-admin/includes/file.php';
		WP_Filesystem( true );
		global $wp_filesystem;
		$spreadsheetFilename = ABSPATH . $old_instance[ 'spreadsheet_base_dir' ] . 'workbook.json';
		$wp_filesystem->delete( $spreadsheetFilename );

		$spreadsheetPath = ABSPATH . $instance[ 'spreadsheet_base_dir' ] . $instance[ 'spreadsheet_filename' ];
		$instance[ 'spreadsheet_processed_file' ]  = $this->getProcessedSpreadsheet( $spreadsheetPath );
		return $instance;
	}

	/*
	 * Builds the user-facing UI for the widget
	 */
	public function render ( $context ) {
		extract( $context );
		ob_start();
		require get_template_directory() . '/templates/' . '/lazaro-pricing-calculator-ui.php';
		return ob_get_clean();
	}

	/*
	 * Processes the spreadsheet
	 */
	public function getProcessedSpreadsheet ( $workbookPath ) {

		require get_template_directory() . '/vendor/autoload.php';

		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader( 'Xlsx' );
		// $reader->setPreCalculateFormulas( false );
		$reader->setReadDataOnly( true );
		$workbook = $reader->load( $workbookPath );

		/*
		 * Iterate over all the sheets and rows and columns store the cell values
		 */
		// Get the names of all the sheets
		$sheetNames = $workbook->getSheetNames();

		$workbookData = [ 'Sheets' => [ ] ];

		// Iterate over the sheets
		foreach ( $sheetNames as $sheetName ) {
			$currentSpreadsheet = $workbook->getSheetByName( $sheetName );
			$workbookData[ 'Sheets' ][ $sheetName ] = [ ];
			// Iterate over the rows
			foreach ( $currentSpreadsheet->getRowIterator() as $row ) {
				$cellIterator = $row->getCellIterator();
				// $cellIterator->setIterateOnlyExistingCells( false );
				// Iterate over the columns
				foreach ( $cellIterator as $currentCell ) {
					$cellValue = $currentCell->getValue();
					// If the cell value is driven by formula, then
						// store it in the `f` field, else in the `v` field
							// Also, ignore cells with empty values
					if ( $currentCell->isFormula() )
						$workbookData[ 'Sheets' ][ $sheetName ][ $currentCell->getCoordinate() ][ 'f' ] = $cellValue;
					else if ( ! empty( $cellValue ) )
						$workbookData[ 'Sheets' ][ $sheetName ][ $currentCell->getCoordinate() ][ 'v' ] = $cellValue;
				}
			}
		}

		/*
		 * Write the workbook data structure to a file
		 */
		require_once ABSPATH . 'wp-admin/includes/file.php';
		WP_Filesystem( true );
		global $wp_filesystem;
		// $wp_filesystem->wp_themes_dir()
		$outputFilename = wp_upload_dir()[ 'path' ] . '/workbook.json';
		$wp_filesystem->put_contents( $outputFilename, json_encode( $workbookData ), FS_CHMOD_FILE );

		return $outputFilename;
	}

}

add_action( 'widgets_init', function () {
	register_widget( 'WidgetCostEstimator' );
} );
