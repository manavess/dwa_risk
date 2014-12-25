<div class="studentAlotments index">
    <h2><?php echo __('Student Alotments'); ?></h2>
    <fieldset>
        <div width="100%">

	<?php echo $this->Form->input('searchtext',array('label'=>'Search nominated student by name or by colleges ','onblur'=>'getnominated_student()'));?>
        </div>
        <table cellpadding="0" cellspacing="0">
            <tr class="headblock">
                <th><?php echo $this->Paginator->sort('id'); ?></th>
                <th><?php echo $this->Paginator->sort('student_registration_id'); ?></th>
                <th><?php echo $this->Paginator->sort('allotted_college'); ?></th>
                <th><?php echo $this->Paginator->sort('group_subject_name'); ?></th>
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
      <?php echo $studentAlotment['CollegeGroupSubject']['College']['name']; ?>
                </td>
                <td>
      <?php echo $studentAlotment['CollegeGroupSubject']['GroupSubjects']['name']; ?>
                </td>
                <td><?php echo $studentAlotment['StudentAlotment']['grade']; ?>&nbsp;</td>
                <td><?php echo $studentAlotment['StudentAlotment']['allocation_year']; ?>&nbsp;</td>
                <td><?php echo date('d-m-Y',strtotime($studentAlotment['StudentAlotment']['created'])); ?>&nbsp;</td>
                <td width="10%">
			<?php echo $this->Html->image('view.png', array('url' => array('action' => 'view', $studentAlotment['StudentAlotment']['id']))); ?>
			<?php echo $this->Html->image('edit_button.png', array('action' => 'edit', $studentAlotment['StudentAlotment']['id'])); ?>
			<?php echo $this->Form->postLink($this->Html->image('delete_button.png'), array('action' => 'delete', $studentAlotment['StudentAlotment']['id']), array('escape' => false), __('Are you sure you want to cancel Admission # %s?', $studentAlotment['StudentAlotment']['id'])); ?>

                </td>
            </tr>
<?php endforeach; ?>
        </table>
    </fieldset>
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
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('List Student Alotments'), array('action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__('New Student Alotment'), array('action' => 'add')); ?></li>
        <li><?php echo $this->Html->link(__('List Student Registrations'), array('controller' => 'student_registrations', 'action' => 'index')); ?> </li>

        <li><?php echo $this->Html->link(__('List College Group Subjects'), array('controller' => 'college_group_subjects', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New College Group Subject'), array('controller' => 'college_group_subjects', 'action' => 'add')); ?> </li><li><?php echo $this->Html->link('Download Nominated Students List',array('action'=>'download_nominated_student'))?></li>

    </ul>
</div>
<script>
    function getnominated_student() {
        var stdname = $("#searchtext").val();

        if (stdname != '') {

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
