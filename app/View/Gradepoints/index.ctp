<div class="gradepoints index">
	<h2><?php echo __('Gradepoints'); ?></h2>
        <?php /*search student by colleges*/ ?>
        

	<?php echo $this->Form->create('Gradepoint', array('url' => "index",'onsubmit'=>'return checkvalidation()')); ?>
	<div class="form-area2">
    
    
    
    <div class="left-area" style="width:41%!important">
    	<?php if(!empty($selectedyear)) { $selectedyear = $selectedyear; }else{ $selectedyear = '';}?>
	<?php echo $this->Form->input('year',array('id'=>'year','type'=>'year','default'=>$selectedyear));?>
	
	</div>
    </div>
    <div class="right-area">
	<div id="form-button">
	
	<?php echo $this->Form->end(__('Search')); ?>
	<div class="submit" style="padding-left:8px;">

	<?php echo $this->Form->reset('Reset', array('title' => 'Reset','value'=>'Reset','type' => 'submit')); ?>
	</div>
	</div>
	</div>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('gradepoints'); ?></th>
			<th><?php echo $this->Paginator->sort('lowerlimit'); ?></th>
			<th><?php echo $this->Paginator->sort('higherlimit'); ?></th>
			<th><?php echo $this->Paginator->sort('remarks'); ?></th>
			<th><?php echo $this->Paginator->sort('year'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($gradepoints as $gradepoint): ?>
	<tr>
		<td><?php echo h($gradepoint['Gradepoint']['gradepoints']); ?>&nbsp;</td>
		<td><?php echo h($gradepoint['Gradepoint']['lowerlimit']); ?>&nbsp;</td>
		<td><?php echo h($gradepoint['Gradepoint']['higherlimit']); ?>&nbsp;</td>
		<td><?php echo h($gradepoint['Gradepoint']['remarks']); ?>&nbsp;</td>
                <td><?php echo h($gradepoint['Gradepoint']['year']); ?>&nbsp;</td>
		
		<td>
                    <?php echo $this->Html->image('view.png', array('url' => array('action' => 'view', $gradepoint['Gradepoint']['id']),'title'=>'View')); ?>
                    <?php echo $this->Html->image('edit_button.png', array('url' => array('action' => 'edit', $gradepoint['Gradepoint']['id']),'title'=>'Edit')); ?>
                    <?php echo $this->Form->postLink($this->Html->image('delete_button.png'), array('action' => 'delete', $gradepoint['Gradepoint']['id']), array('escape' => false,'title'=>'Delete'), __('Are you sure you want to delete # %s?', $gradepoint['Gradepoint']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Gradepoint'), array('action' => 'add')); ?></li>
	</ul>
</div>
