<h2><?php echo __('Admission Cancellations Report'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th>S.No</th>
			<th>Student Application Number</th>
			<th>Cancelled Dater</th>
			<th>Remarks</th>
			
	</tr>
	<?php $i = 1; foreach ($cancelledreport as $admissionCancellation): ?>
	<tr>
		<td><?php echo $i; ?>&nbsp;</td>
		<td>
			<?php echo $admissionCancellation['StudentRegistration']['application_number']; ?>
		</td>
		<td><?php echo date('d-m-Y',strtotime($admissionCancellation['AdmissionCancellation']['created'])); ?>&nbsp;</td>
		<td><?php echo h($admissionCancellation['AdmissionCancellation']['remarks']); ?>&nbsp;</td>
		</tr>
<?php $i++; endforeach; ?>
	</table>
