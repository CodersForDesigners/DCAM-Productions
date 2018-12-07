<?php

/**
 * Template Name: Contact Form Handler
 */

ini_set( "display_errors", 1 );
ini_set( "error_reporting", E_ALL );

// Set the timezone
date_default_timezone_set( 'Asia/Kolkata' );
// Do not let this script timeout
set_time_limit( 0 );

require_once __DIR__ . '/../inc/mailer.php';





/*
 *
 * Prepare the "envelope"
 *
 */
$name = $_POST[ 'username' ];
$phoneNumber = $_POST[ 'phoneNumber' ];
$email = $_POST[ 'email' ];
$company = $_POST[ 'company' ];
$message = $_POST[ 'message' ] ?? '';

if ( empty( $name ) or empty( $phoneNumber ) or empty( $email ) or empty( $company ) )
	exit;

$body = <<<BOUNDARY

<p>
	{$name} visited the website and left his/her/their phone number ( {$phoneNumber} ) and email address ( {$email} ). {$name} works at {$company} and left the following message:
</p>
<p>{$message}</p>
<p>
	Now do something about it.
</p>

BOUNDARY;

$envelope = [
	'username' => 'google@lazaro.in',
	'password' => 't34m,l4z4r0',
	'from' => [
		'email' => 'google@lazaro.in',
		'name' => 'DCAM'
	],
	'to' => [
		'email' => 'jude@lazaro.in',
		// 'email' => 'mario@lazaro.in',
		'name' => $name,
		// 'additionalEmails' => [ 'mario@lazaro.in' ]
	],
	'subject' => 'DCAM Website Lead – ' . $name,
	'body' => $body
];



/*
 *
 * "Post" the mail
 *
 */
try {
	$response[ 'status' ] = 0;
	$response[ 'message' ] = Mailer\send( $envelope );
} catch ( \Exception $e ) {
	$response[ 'status' ] = 1;
}
die( json_encode( $response ) );
