<div class="upgradedStudents index">
	<h2><?php echo __('Upgraded Students'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Student Name</th>
			<th>Student Application Number</th>
			<th>From Course</th>
			<th>To Course</th>
			<th>Date</th>

	</tr>
	<?php  foreach ($upgradedStudents as $upgradedStudent): ?>
	<tr>
		<td><?php echo $upgradedStudent['StudentRegistration']['applicant_name']; ?>&nbsp;</td>
		<td><?php echo $upgradedStudent['StudentRegistration']['application_number']; ?>&nbsp;</td>
		<td><?php echo $upgradedStudent['fromCourse']['name']; ?>&nbsp;</td>
		<td><?php echo $upgradedStudent['toCourse']['name']; ?>&nbsp;</td>
		<th><?php echo date('d-m-Y',strtotime($upgradedStudent['UpgradedStudent']['created'])); ?></th>
		
	</tr>
<?php endforeach; ?>
	</table>
</div>
