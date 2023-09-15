<?php
/**
 * Template Name: Contact Form Handler
 */

require_once __DIR__ . '/../lib/http.php';

/**
 |
 | Script Bootstrapping
 |
 |
 */
# * - Error Reporting
ini_set( 'display_errors', 1 );
ini_set( 'error_reporting', E_ALL );
# * - Request Permissions
header( 'Access-Control-Allow-Origin: *' );
# * - Date and Timezone
date_default_timezone_set( 'Asia/Kolkata' );
# * - Prevent Script Cancellation by Client
ignore_user_abort( true );
# * - Script Timeout
set_time_limit( 0 );





/**
 |
 | Response Preparation
 |
 |
 */
# Set Headers
header_remove( 'X-Powered-By' );
header( 'Content-Type: application/json' );





/**
 |
 | Request Parsing
 |
 |
 */
$name = $_POST[ 'username' ];
$phoneNumber = $_POST[ 'phoneNumber' ];
$emailAddress = $_POST[ 'email' ];
$company = $_POST[ 'company' ];
$message = $_POST[ 'message' ] ?? '';

if ( empty( $name ) or empty( $phoneNumber ) or empty( $emailAddress ) or empty( $company ) ) {
	ThisProject\HTTP::respond( [
		'status' => 0,
		'message' => 'Data not provided',
	], 400 );
	exit;
}





/**
 |
 | Import dependencies
 |
 |
 */
require_once __DIR__ . '/../lib/datetime.php';





/**
 |
 | Prepare data for submission
 |
 |
 */
$data = [
	'entry.125001999' => ThisProject\DateTime::getCurrentTimestamp__SpreadsheetCompatible(),
	'entry.586112043' => $name,
	'entry.425291794' => $phoneNumber,
	'entry.1650789803' => $emailAddress,
	'entry.979150883' => $company,
	'entry.1426017662' => $message,
];

ThisProject\HTTP::post( 'https://docs.google.com/forms/d/e/1FAIpQLSdhH4LrFXu_dLDZ-p1v7yPlmP4KbXnDcj2gD6zZKKdwQxzg-w/formResponse', [
	'data' => $data,
	'contentType' => 'multipart/form-data'
] );

ThisProject\HTTP::respond( [
	'status' => 0,
	'message' => 'All good.',
] );
