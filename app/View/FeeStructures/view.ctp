<div class="feeStructures view">
<?php echo $this->Html->addCrumb('Fee Structure', '/FeeStructures');?>
<h2><?php  echo __('Fee Structure'); ?></h2>
	<dl>
		<dt><?php echo __('Fee Structure'); ?></dt>
		<dd>
			<?php echo h($feeStructure['FeeStructure']['pagetext']); ?>
			&nbsp;
		</dd>
		
		<dt><?php echo __('Fees for Domestic & International Students'); ?></dt>
		<dd><?php if(!empty($fees)){ foreach($fees as $tutionfees): ?>
			For Domestic Applicants:<?php echo $tutionfees['AdminPreference']['domestic_application_fee']; ?>
			&nbsp;</BR>
			For International Applicants:<?php echo $tutionfees['AdminPreference']['international_application_fee']; ?>
			&nbsp;
			<?php endforeach; } ?>
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($feeStructure['FeeStructure']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created By'); ?></dt>
                <dd>
                        <?php echo h($createuser); ?>
			&nbsp;
                </dd>
                <dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($feeStructure['FeeStructure']['modified']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Modified By'); ?></dt>
                <dd>
                        <?php echo h($modifyuser); ?>
			&nbsp;
                </dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Fee Structure'), array('action' => 'edit', $feeStructure['FeeStructure']['id'])); ?> </li>
		<li><?php //echo $this->Form->postLink(__('Delete Fee Structure'), array('action' => 'delete', $feeStructure['FeeStructure']['id']), null, __('Are you sure you want to delete # %s?', $feeStructure['FeeStructure']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Fee Structures'), array('action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Fee Structure'), array('action' => 'add')); ?> </li>
	</ul>
</div>
