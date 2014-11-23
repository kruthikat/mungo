<?php
/**
 * Template Name: Patient View Appointment
 */
get_header();
/* Only if a patient is logged in, the following content will be displayed */
if(isset($_SESSION['userid'])) {
	global $wpdb;
	$tablename = $wpdb->prefix;
	$query = 'SELECT A.apt_date, T.diagnosis, T.prescribed_med, D.name FROM ' . $tablename. 'appointments A, ' . $tablename. 'treatments T, ' . $tablename. 'hpusers D, ' . $tablename. 'treats T2 WHERE A.patient_id = "' . $_SESSION['userid']. '" AND A.patient_id = T2.patient_id AND T2.doctor_id = D.userid AND T2.bill_no = T.bill_no;';
	$patientAppointments = $wpdb->get_results($query, ARRAY_A);
	if(count($patientAppointments) != 0) {
		?>
<table>
	<thead>
		<tr class="header_row">
			<th>Appointment Date</th>
			<th>Diagnosis</th>
			<th>Prescribed Medicines</th>
			<th>Admission Details</th>
			<th>Reference Doctor</th>
		</tr>
		<?php foreach ($patientAppointments as $appointment) { ?>
		<tr>
			<td><?php echo $appointment['apt_date'];?></td>
			<td><?php if($appointment['diagnosis'] != '') echo $appointment['diagnosis']; else echo 'Diagnosis not available yet.';?>
			</td>
			<td><?php if($appointment['prescribed_med'] != '') echo $appointment['prescribed_med']; else echo 'Prescriptions not available yet.';?>
			</td>
			<td>
			<?php 
			$inPatient = new UpdateDatabaseOptions("in_patients");
			$admissionDetails = $inPatient->selectValue(array('roomno'), array('userid' => $_SESSION['userid'], 'admit_date' => $appointment['apt_date']));
			if(count($admissionDetails) != 0)
				echo 'In-patient: ' . $admissionDetails[0]['roomno'];
			else echo 'Out-Patient';
			?>
			</td>
			<td><?php echo $appointment['name'];?></td>
		</tr>
		<?php }?>
	</thead>
</table>
		<?php } else { ?>
			<div class="infobar">
<?php echo 'You have no appointments.';?>
</div>
<?php }
}
get_footer();
