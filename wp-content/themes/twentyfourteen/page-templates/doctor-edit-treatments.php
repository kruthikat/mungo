<?php
/**
 * Template Name: Doctor Edit Treatment Details
 */
get_header();
if(!isset($_GET['patient_id']) || !isset($_GET['patient_id'])) {
	header('Location:' . get_permalink(get_page_by_title('View all appointments')));
}
else {
	/* Only if a doctor is logged in, the following content will be displayed */
	if(isset($_SESSION['userid']) && isset($_SESSION['usertype']) && $_SESSION['usertype'] == 3) {
		$patient_id = isset($_GET['patient_id']) ? $_GET['patient_id'] : '';
		$apt_date = isset($_GET['apt_date']) ? $_GET['apt_date'] : '';
		$patient_type = new UpdateDatabaseOptions('in_patients');
		$patient_type1 = $patient_type->selectValue(array('userid'), array('userid' => $patient_id,'discharge_date'=>'9999-12-01'));
		/* extract 	bill no for the patient*/
		global $wpdb;
		$tablename = $wpdb->prefix;
		$query = 'SELECT T.bill_no,TR.diagnosis,TR.prescribed_med FROM ' . $tablename. 'treats T,' .$tablename. 'treatments TR
	WHERE T.doctor_id = "' . $_SESSION['userid']. '" AND T.patient_id = "' . $patient_id . '"
	AND T.bill_no=TR.bill_no AND TR.apt_date="' .$apt_date .'"';
		//echo $query;
		$billno = $wpdb->get_results($query, ARRAY_A);
		//echo count($billno);
		//echo '<pre>';
		//print_r($billno);
		//echo '</pre>';
		$pres_med_p=$billno[0]['prescribed_med'];
		$diag_p=$billno[0]['diagnosis'];
		//echo $pres_med_p;
		//echo $diag_p;
		/*Update treatments*/
		$treatments = new UpdateDatabaseOptions('treatments');
		if(isset($_POST['psubmit'])) {
			$error = 0;
			$diagnosis = mysql_real_escape_string($_POST['diagnosis']);
			$pres_med = mysql_real_escape_string($_POST['pres_med']);
			//echo $diagnosis;
			//echo $pres_med;

			if($diagnosis !='' && $pres_med!=''){
				if(!$treatments->updateRow(
				array('diagnosis' => $diagnosis,
						'prescribed_med' => $pres_med),
				array('apt_date' => $apt_date,
						'bill_no'=>$billno[0]['bill_no']),
				array('%s', '%s'),
				array('%s','%d')))
				$error++;
			}
			else {
				echo "'Diagnosis', 'Prescribed Medicines' cannot be left blank";
			}

			$patient_status = mysql_real_escape_string($_POST['PatientStatus']);
			//echo $patient_status;
			if($patient_status==1)
			{
				global $wpdb;
				$tablename = $wpdb->prefix;
				$query1 = 'SELECT R.roomno FROM ' . $tablename. 'rooms R
	WHERE R.typeid=1 AND R.roomno!=310 AND R.roomno NOT IN ( SELECT I.roomno FROM ' .$tablename. 'nurses I)';
				//echo $query1;
				$roomno = $wpdb->get_results($query1, ARRAY_A);
				//echo '<pre>';
				//print_r($roomno);
				//echo '</pre>';
				$chosenRoom = $roomno[0]['roomno'];
				//do {
				//		$roomNo = rand(100,400);
				//		$checkroomNo = $room->selectValue(array('COUNT(*)'), array('roomno' => $roomNo));
				//	} while($checkroomNo[0]['COUNT(*)'] != 0);

				//echo $chosenRoom;

				$treats = new UpdateDatabaseOptions('in_patients');
				$treatment = $treats->insertRow(array('userid' => $patient_id,
									'admit_date' => $apt_date,
									'discharge_date'=> '9999-12-01',
									'roomno' => $chosenRoom), array('%s', '%s', '%s','%d'));
					
				//echo '<pre>';
				//print_r($treatment);
				//echo '</pre>';

				$nurse = new UpdateDatabaseOptions('nurses');
				$nurseAssigned = $nurse->selectValue(array('userid'), array('available' => 1));
				$chosenNurse = array_rand($nurseAssigned);

				//echo '<pre>';
				//print_r($chosenNurse);
				//echo '</pre>';

				if(!$nurse->updateRow(
				array('available' => 0,
						'roomno' => $chosenRoom),
				array('userid' => $nurseAssigned[$chosenNurse]['userid']),
				array('%s', '%d'),
				array('%s')))
				$error++;
			}


			if($error != 0) {
				echo 'Sorry! Please try again.';
			}
			else {
				echo 'Changes successfully saved.';
			}


		}


		//	$treatmentsDetails = $treatments->selectValue(array('patient_id', 'appointment_date', 'diagnosis', 'prescribed_medicines','status'), array('userid' => $_SESSION['userid']));
		?>
<div class="leftnav">
<?php get_sidebar('doctor');?>
</div>
<div class="main_content">
<?php if($message != '') {?>
	<div class="infobar">
	<?php echo $message;?>
	</div>
	<?php }?>
	<h2>Edit Treatment Details</h2>
	<form name="EDIT TREATMENT DETAILS" action="" method="post">
		<p>
			Patient
			ID:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<strong><?php echo $patient_id;?> </strong>
		</p>
		<p>
			Appointment
			Date:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<strong><?php echo $apt_date;?> </strong>
		</p>
		<p>
			<label for="diagnosis">Diagnosis</label> <input type="text"
				name="diagnosis" id="diagnosis" value="<?php echo $diag_p;?>" />
		</p>
		<p>
			<label for="pres_med">Prescribed Medicines</label> <input type="text"
				name="pres_med" id="pres_med" value="<?php echo $pres_med_p;?>" />
		</p>
		<p>
			<label for="Patient_Status">Patient Status</label>
			<?php
			$inselected = '';
			$outselected = '';
			$checked = 'checked="checked"';
			if(!$patient_type1) $outselected = $checked;
			else if($patient_type1) $inselected = $checked;
			?>
			<input type="radio" name="PatientStatus" value="0" id="Out-Patient"
			<?php echo $outselected; ?> /> Out-Patient <input type="radio"
				name="PatientStatus" value="1" id="In-Patient"
				<?php echo $inselected; ?> /> In-Patient
		</p>

		<p>
		<?php
		if ($patient_type1)
		{
			$discharge_date = mysql_real_escape_string($_POST['discharge_date']);
			//echo $discharge_date;
			if($discharge_date==1)
			{
				global $wpdb;
				$tablename = $wpdb->prefix;
				$query2 = 'SELECT R.roomno FROM ' . $tablename. 'in_patients R
	WHERE R.userid="' .$patient_id.'"'; 
				//echo $query2;
				$roomno = $wpdb->get_results($query2, ARRAY_A);
				//echo '<pre>';
				//print_r($roomno);
				//echo '</pre>';
				$chosenRoom = $roomno[0]['roomno'];
				$query3 = 'SELECT N.userid FROM ' . $tablename. 'nurses N
	WHERE N.roomno="' .$chosenRoom.'"'; 
				//echo $query3;
				$NurseSel = $wpdb->get_results($query3, ARRAY_A);
				//echo '<pre>';
				//print_r($NurseSel);
				//echo '</pre>';
				//echo $NurseSel[0]['userid'];
				//nurseAssigned[$chosenNurse]
				$FreeNurse = new UpdateDatabaseOptions('nurses');
				if(!$FreeNurse->updateRow(
				array('available' => 1,
						'roomno' => 310),
				array('userid' => $NurseSel[0]['userid']),
				array('%s', '%d'),
				array('%s')))
				$error++;
				$query4 = 'SELECT current_date';
				//echo $query4;
				$get_date = $wpdb->get_results($query4, ARRAY_A);
				//echo '<pre>';
				//print_r($get_date);
				//echo '</pre>';
				//echo $get_date[0];
				//$getdate[0][current_date]
				$In_Patients=new UpdateDatabaseOptions('in_patients');
				if(!$In_Patients->updateRow(
				array('discharge_date'=>$get_date[0][current_date]),
				array('userid'=>$patient_id),
				array('%s'),
				array('%s')))
				$error++;
					
			}
			?>
			<label for="discharge_date">Discharge</label>
			<?php
			$yesselected = '';
			$noselected = '';
			$checked = 'checked="checked"';
			if($patient_type1) $yesselected = $checked;
			else if(!$patient_type1) $noselected = $checked;
			?>
			<input type="radio" name="discharge_date" value="1" id="YES"
			<?php echo $yesselected; ?> /> YES<input type="radio"
				name="discharge_date" 'value="0" id="NO"
				' <?php echo $noselected; ?> /> NO
				<?php
		}
		?>
		</p>

		<p>
			<input type="submit" name="psubmit" id="psubmit" value="Save Changes" />
		</p>
	</form>
</div>
		<?php } else {
			header("Location:" . site_url());
		}
		get_footer();
}