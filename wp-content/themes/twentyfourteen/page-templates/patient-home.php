<?php 
/**
 * Template Name: Patient Home
 */
get_header();
 ?>
<div class="options">
	<div class="option one">
		<a href="<?php echo get_permalink(get_page_by_title('Make Appointment'));?>">Make an appointment</a>
	</div>
	<div class="option two">
		<a href="<?php echo get_permalink(get_page_by_title('View Appointment'));?>">View all your appointments</a>
	</div>
	<div class="option three">
		<a href="<?php echo get_permalink(get_page_by_title('Make Payment'));?>">Make payment</a>
	</div>
	<div class="option four">
		<a href="<?php echo get_permalink(get_page_by_title('Edit Profile'));?>">Edit profile</a>
	</div>
</div>