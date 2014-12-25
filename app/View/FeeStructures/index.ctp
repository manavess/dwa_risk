<div class="feeStructures index">
<?php echo $this->Html->addCrumb('Fee Structure', '/FeeStructures');?>
	<h2><?php echo __('Fee Structures'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			
			<th><?php echo $this->Paginator->sort('Fee Structure text'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($feeStructures as $feeStructure): ?>
	<tr>
		
		<td><?php echo h(strip_tags($feeStructure['FeeStructure']['pagetext'])); ?>&nbsp;</td>
                <td>
                    <?php echo $this->Html->image('view.png', array('url' => array('action' => 'view', $feeStructure['FeeStructure']['id']),'title'=>'View')); ?>
                    <?php echo $this->Html->image('edit_button.png', array('url' => array('action' => 'edit', $feeStructure['FeeStructure']['id']),'title'=>'Edit')); ?>
                    <?php //echo $this->Form->postLink($this->Html->image('delete_button.png'), array('action' => 'delete', $feeStructure['FeeStructure']['id']), array('escape' => false,'title'=>'Delete'), __('Are you sure you want to delete # %s?', $feeStructure['FeeStructure']['id'])); ?>
                </td>
	</tr>
<?php endforeach; ?>
	</table>
</div>
<!--<div class="actions">
	<h3><?php //echo __('No Action'); ?></h3>
	<ul>
		<li><?php //echo $this->Html->link(__('New Fee Structure'), array('action' => 'add')); ?></li>
	</ul>
</div>-->
