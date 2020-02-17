<?php

/**
 * Template Name: Spreadsheet
 */

ini_set( "display_errors", 1 );
ini_set( "error_reporting", E_ALL );

// Set the timezone
date_default_timezone_set( 'Asia/Kolkata' );
// Do not let this script timeout
set_time_limit( 0 );

require __DIR__ . '/../vendor/autoload.php';

/*
 * Open the workbook
 */
$workbookFilename = __DIR__ . '/Corporate Video - DCAM - Price Calculator.xlsx';
$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader( 'Xlsx' );
// $reader->setPreCalculateFormulas( false );
$reader->setReadDataOnly( true );
$workbook = $reader->load( $workbookFilename );

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
var_dump( FS_CHMOD_FILE );
$outputFilename = wp_upload_dir()[ 'path' ] . '/workbook.json';
$wp_filesystem->put_contents( $outputFilename, json_encode( $workbookData ), FS_CHMOD_FILE );

// var_dump( get_template_directory() );
// var_dump( get_theme_root() );
