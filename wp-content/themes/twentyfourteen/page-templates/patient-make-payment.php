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
<table>
	<thead>
		<tr class="header_row">
			<th>Appointment Date</th>
			<th>Bill Number</th>
			<th>Bill Amount</th>
			<th>Status</th>
		</tr> 
		<?php foreach ($bills as $bill) { ?>
		<tr>
			<td><?php echo $bill['apt_date'];?></td>
			<td><?php echo $bill['bill_no']; ?></td>
			<td>
			<?php 
			$query = 'SELECT I.admit_date, I.discharge_date, RT.rent FROM ' . $tablename. 'roomtype RT, ' . $tablename. 'rooms R, ' . $tablename. 'in_patients I WHERE I.userid = "' . $_SESSION['userid'] . '" AND I.admit_date = "' . $bill[apt_date] . '" I.roomno = R.roomno AND R.typeid = RT.typeid;';
			$rooms = $wpdb->get_results($query, ARRAY_A);
			$billAmount = 'Not available';
			if(count($rooms) != 0 || $bill['prescribed_med'] != '')
				$billAmount = getTotalBillAmount($rooms[0]['admit_date'], $rooms[0]['discharge_date'], $rooms[0]['rent'], $bill['prescribed_med']);
			echo $billAmount;
			?>
			</td>
			<td><?php if($billAmount != 'Not available') {?><a>Pay</a> <?php } else { echo 'N/A'; }?></td>
		</tr>
		<?php }?>
	</thead>
</table>
<?php }?>
