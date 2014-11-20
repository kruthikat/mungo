<?php 
/**
 * Template Name: Patient Make Payment
 */
get_header();
/* Only if a patient is logged in, the following content will be displayed */
if(isset($_SESSION['userid'])) {
	global $wpdb;
	$tablename = $wpdb->prefix;
	$query = 'SELECT A.apt_date, T.bill_no, T.prescribed_med FROM ' . $tablename. 'appointments A, ' . $tablename. 'treatments T, ' . $tablename. 'treats T2 WHERE A.patient_id = "' . $_SESSION['userid']. '" AND A.patient_id = T2.patient_id AND T2.bill_no = T.bill_no;';
	$bills = $wpdb->get_results($query, ARRAY_A);
 ?>
 
 <?php }?>
