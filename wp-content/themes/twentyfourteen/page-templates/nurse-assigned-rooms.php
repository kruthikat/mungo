<?php
/**
 * Template Name: Nurse View Assigned Rooms
 */
get_header();
/* Only if a nurse is logged in, the following content will be displayed */
if(isset($_SESSION['userid'])) {
	global $wpdb;
	$tablename = $wpdb->prefix;
	$query = 'SELECT U.userid, U.name, I.roomno FROM ' . $tablename. 'hpusers U, ' . $tablename. 'in_patients I WHERE U.userid=I.userid AND I.roomno IN (SELECT N.roomno FROM ' . $tablename. 'nurses N WHERE N.userid="' . $_SESSION['userid']. '")';
	$assignedRooms = $wpdb->get_results($query, ARRAY_A);
	if(count($assignedRooms) != 0) {
		?>
		<table border="1">
	<thead>
		<tr>
			<th>Patient ID</th>
			<th>Patient Name</th>
			<th>Room Number</th>
		</tr>
		<?php foreach ($assignedRooms as $room) { ?>
		<tr>
			<td><?php echo $room['userid'];?></td>
			<td><?php if($room['name'] != '') echo $room['name']; else echo 'please check records';?>
			</td>
			<td><?php if($room['roomno'] != '') echo $room['roomno']; else echo 'Please check records.';?>
			</td>
		</tr>
		<?php }?>
	</thead>
</table>
		<?php } else {
			echo 'You have no rooms.';
		}?>
		<?php }?>