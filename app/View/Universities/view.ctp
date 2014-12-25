<div class="universities view">
<?php  echo $this->Html->addCrumb("University", '/Universities'); ?>
<h2><?php  echo __('University'); ?></h2>
<div class="left-side">
	<dl>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($university['University']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address1'); ?></dt>
		<dd>
			<?php echo h($university['University']['address1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address2'); ?></dt>
		<dd>
			<?php echo h($university['University']['address2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address3'); ?></dt>
		<dd>
			<?php echo h($university['University']['address3']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo $this->Html->link($university['City']['name'], array('controller' => 'cities', 'action' => 'view', $university['City']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('State'); ?></dt>
		<dd>
			<?php echo $this->Html->link($university['State']['name'], array('controller' => 'states', 'action' => 'view', $university['State']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pincode'); ?></dt>
		<dd>
			<?php echo h($university['University']['pincode']); ?>
			&nbsp;
		</dd>
        </dl>
    </div>
                <div class="right-side">  
                    <dl>  
		<dt><?php echo __('Contact Person'); ?></dt>
		<dd>
			<?php echo h($university['University']['contact_person']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email Id'); ?></dt>
		<dd>
			<?php echo h($university['University']['email_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contact No'); ?></dt>
		<dd>
			<?php echo h($university['University']['contact_no']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Website'); ?></dt>
		<dd>
			<?php echo h($university['University']['website']); ?>
			&nbsp;
		</dd>
		<!--dt><?php //echo __('No Of Seat'); ?></dt>
		<dd>
			<?php //echo h($university['University']['no_of_seat']); ?>
			&nbsp;
		</dd-->
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($university['University']['created']); ?>
			&nbsp;
		</dd>
                 <dt><?php echo __('Created By'); ?></dt>
                <dd>
                        <?php echo h($createuser); ?>
			&nbsp;
                </dd>
                <dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($university['University']['modified']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Modified By'); ?></dt>
                <dd>
                        <?php echo h($modifyuser); ?>
			&nbsp;
                </dd>
	</dl>
                </div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit University'), array('action' => 'edit', $university['University']['id'])); ?> </li>
		<li><?php //echo $this->Form->postLink(__('Delete University'), array('action' => 'delete', $university['University']['id']), null, __('Are you sure you want to delete # %s?', $university['University']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Universities'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New University'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cities'), array('controller' => 'cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New City'), array('controller' => 'cities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List States'), array('controller' => 'states', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New State'), array('controller' => 'states', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Colleges'), array('controller' => 'colleges', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New College'), array('controller' => 'colleges', 'action' => 'add')); ?> </li>
	</ul>
</div>
