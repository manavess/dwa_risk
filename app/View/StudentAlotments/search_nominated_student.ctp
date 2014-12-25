	<h2><?php echo __('Student Alotments'); ?></h2>
	<div>
	<fieldset><?php echo $this->Form->input('searchtext',array('label'=>'search nominated student by name or by colleges ','onblur'=>'getnominated_student()','value'=>$searchtext));?></fieldset>
	</div>
	<table cellpadding="0" cellspacing="0">
	<tr class="headblock">
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('student_registration_id'); ?></th>
			<th><?php echo $this->Paginator->sort('college_group_subject_id'); ?></th>
			<th><?php echo $this->Paginator->sort('college_group_subject_name'); ?></th>
			<th><?php echo $this->Paginator->sort('grade'); ?></th>
			<th><?php echo $this->Paginator->sort('allocation_year'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($studentAlotments as $studentAlotment): ?>
	<tr>
		<td><?php echo $studentAlotment['StudentAlotment']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($studentAlotment['StudentRegistration']['applicant_name'], array('controller' => 'student_registrations', 'action' => 'view', $studentAlotment['StudentRegistration']['id'])); ?>
		</td>
		<td>
      <?php echo $this->Html->link($studentAlotment['CollegeGroupSubject']['College']['name'].'('. $studentAlotment['CollegeGroupSubject']['GroupSubjects']['name'].')', array('controller' => 'group_subjects', 'action' => 'view', $studentAlotment['CollegeGroupSubject']['GroupSubjects']['id'])); ?>
		</td>
		<td>
      <?php echo $this->Html->link($studentAlotment['CollegeGroupSubject']['GroupSubjects']['name'].'('. $studentAlotment['CollegeGroupSubject']['GroupSubjects']['name'].')', array('controller' => 'group_subjects', 'action' => 'view', $studentAlotment['CollegeGroupSubject']['GroupSubjects']['id'])); ?>
		</td>
		<td><?php echo $studentAlotment['StudentAlotment']['grade']; ?>&nbsp;</td>
		<td><?php echo $studentAlotment['StudentAlotment']['allocation_year']; ?>&nbsp;</td>
		<td><?php echo $studentAlotment['StudentAlotment']['created']; ?>&nbsp;</td>
		<td class="">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $studentAlotment['StudentAlotment']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $studentAlotment['StudentAlotment']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $studentAlotment['StudentAlotment']['id']), null, __('Are you sure you want to delete # %s?', $studentAlotment['StudentAlotment']['id'])); ?>
			
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
	<script type='text/javascript' >
		
		data = $('#searchtext').val();
		$('#searchtext').focus().val('').val(data);
		
		function getnominated_student(){
var stdname = $("#searchtext").val();

		if(stdname!=''){
		
		$.ajax({
		type: 'POST',
		data: {searchtext: stdname},
		url: "<?php echo $this->webroot; ?>StudentAlotments/nominatedstudent",
		success: function(data) {
			$('#content').find('.studentAlotments').html(data);
		  	$('#totalPercentage').val(data);
		}
		});
		return true;
		}
}
		
	</script>
