<div class="colleges index">
<?php echo $this->Html->addCrumb('College', '/Colleges');?>
    <h2><?php echo __('Colleges'); ?></h2>
    <?php echo $this->Form->create('College',array('url'=>'index')); ?>
	<div class="form-area2">
    
    
	<div class="left-area">
	
	<?php if(!empty($universitydata)){ $universitydata = $universitydata;}else{ $universitydata = '';} echo $this->Form->input('university_name',array('select'=>true,'options'=>array('' => ' Select ',$universities),'selected'=>$universitydata,'style' => 'width:200px;','id'=>'universityID','required'=>false));?>
	
	</div>
	
	<div class="right-area">
	<?php echo $this->Form->input('collegecode',array('label'=>'College Code','id' => 'collegecode','style' => 'width:200px;','required'=>false));?>
	
	</div>
	<div style="clear:both; margin: 0px 0px 0px 0px;"></div>
	<div class="left-area">
	<?php echo $this->Form->input('college_name',array('select'=>true,'options'=>array('' => 'Select',$collegedata),'style' => 'width:200px;','id'=>'collegedata','required'=>false));?>
	</div>
	
	<div class="right-area">

	<div id="form-button" style="width:52%!important">
	
	<?php echo $this->Form->end(__('Search')); ?>
	<div class="submit" style="padding-left:8px;">
	<?php echo $this->Form->reset('Reset', array('title' => 'Reset','value'=>'Reset','type' => 'submit')); ?>
	</div>
	</div>
	</div>
	</div>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th width="12%"><?php echo $this->Paginator->sort('college_code'); ?></th>
            <th width="26%"><?php echo $this->Paginator->sort('name'); ?></th>
            <th width="18%"><?php echo $this->Paginator->sort('university_id'); ?></th>
            <th width="10%"><?php echo $this->Paginator->sort('no_of_seats'); ?></th>
            <th width="12%"><?php echo $this->Paginator->sort('affilated_from'); ?></th>
            <th width="12%"><?php echo $this->Paginator->sort('affilated_to'); ?></th>
            <th width="88%" class="action" style="padding-top:19px;"><?php echo __('Actions'); ?></th>
        </tr>
        <?php foreach ($colleges as $college): ?>
            <tr>
                <td><?php echo $college['College']['college_code']; ?></td>
                <td><?php echo $college['College']['name']; ?></td>
                <td><?php echo $college['University']['name']; ?></td>
                <td><?php echo $college['College']['no_of_seats']; ?></td>
                <td><?php $affilatedddate = date("d-m-Y", strtotime($college['College']['affilated_from'])); ?><?php echo h($affilatedddate); ?></td>
                <td><?php $affilatedtoddate = date("d-m-Y", strtotime($college['College']['affilated_to'])); ?><?php echo h($affilatedtoddate); ?></td>
                <td>
                    <?php echo $this->Html->image('view.png', array('url' => array('action' => 'view', $college['College']['id']),'title'=>'View')); ?>
                    <?php echo $this->Html->image('edit_button.png', array('url' => array('action' => 'edit', $college['College']['id']),'title'=>'Edit')); ?>
                    <?php echo $this->Form->postLink($this->Html->image('delete_button.png'), array('action' => 'delete', $college['College']['id']), array('escape' => false,'title'=>'Delete'), __('Are you sure you want to delete # %s?', $college['College']['id'])); ?>
                </td>

            </tr>
        <?php endforeach; ?>
    </table>
    <p>
        <?php
        $this->Paginator->options(array('url' => $this->passedArgs));
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
        <li><?php echo $this->Html->link(__('New College'), array('action' => 'add')); ?></li>
        <li><?php echo $this->Html->link(__('List Cities'), array('controller' => 'cities', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New City'), array('controller' => 'cities', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List States'), array('controller' => 'states', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New State'), array('controller' => 'states', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Universities'), array('controller' => 'universities', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New University'), array('controller' => 'universities', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List College Group Subjects'), array('controller' => 'college_group_subjects', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link('Download list of Colleges',array('action' => 'download_list_of_colleges'));?></li>
    </ul>
</div>

<script>
 $('#universityID').change(function() {
 $('#collegecode').val('');
        $.ajax({
            type: 'POST',
            data: {university_id: $("#universityID option:selected").val()},
            url: "<?php echo $this->webroot; ?>StudentAlotments/getcollegelist",
            success: function(data) {
                $('#collegedata').html(data);
            }
        });
        return true;
    });
    $('#collegedata').change(function() {
        $.ajax({
            type: 'POST',
            data: {college_id: $("#collegedata option:selected").val()},
            url: "<?php echo $this->webroot; ?>Colleges/getcollecode",
            success: function(data) {
            
                $('#collegecode').val(data);
            }
        });
        return true;
    });
</script>

