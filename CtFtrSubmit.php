<?php 
/* ============================================================ */
/* The script handler with the form pushes the data 			*/
/* to this document which adds the contact infomraiton 			*/
/* to the database and sends an email to the correct recipeient */
/* ============================================================ */

$toEmail = ''; // email address to send the contact form to.
$subject = 'Email from contact form in footer of TGHR'; // email subject line. 

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
/* Fields from the contact form on HTML page */ 

$fname= $_POST['jfname'];
$lname = $_POST['jlname'];
$email = $_POST['jemail'];
$reason = $_POST['jreason'];
/* Send an email to the recipeind using the above information */
$html = '<ul>';
$html .= '<li> First Name: '.$fname.'</li>';
$html .= '<li> Last Name: '.$lname.'</li>';
$html .= '<li> Email: '.$email.'</li>';
$html .= '<li> Reason: '.$reason.'</li>';
$html .='</ul>';

/* if the toEmail is not set do not send an email */
if( isset($toEmail) && !empty($toEmail) ){ mail($toEmail, $subject, $html, $headers); }
/* ===================================================================== */
/* ===================================================== */
/* the following code connect to the database that will  */
/* hold all of the information in the database 			 */ 
/* ===================================================== */

$dbHost = '';
$dbUser = '';
$dbPassword = '';
$dbName = '';
$dbTable = '';
$orderby = false; 

mysql_connect($dbHost, $dbUser, $dbPassword) || die (mysql_error());
mysql_select_db($dbName) || die( mysql_error() );

/* creates a new table if it does not already exsist */ 
$query1 = "CREATE TABLE IF NOT EXISTS ".$dbTable." (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`fname` text NOT NULL,
	`lname` text NOT NULL,
	`email` text NOT NULL,
	`reason` text NOT NULL,
	PRIMARY KEY (`id`)
)ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1"; 
mysql_query($query1);

/* addds the following data to the new or exsisting table */
$query2 = "INSERT INTO ".$dbTable." VALUES('',";
	$query2 .= $fname.",";
	$query2 .= $lname.","; 
	$query2 .= $email.","; 
	$query2 .= $reason; // the last query value does not need a comma! 
	$query2 .= ")";
mysql_query($query2) || die (mysql_error());
?>