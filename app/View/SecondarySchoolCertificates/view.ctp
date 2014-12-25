<div class="secondarySchoolCertificates view">
<?php  echo $this->Html->addCrumb('Secondary School Certificate', '/SecondarySchoolCertificates'); ?>
<h2><?php  echo __('Secondary School Certificate'); ?></h2>
	<dl>
		
		<dt><?php echo __('Certificate Number'); ?></dt>
		<dd>
			<?php echo h($secondarySchoolCertificate['SecondarySchoolCertificate']['certificate_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Certificate Type'); ?></dt>
		<dd>
			<?php echo h($secondarySchoolCertificate['SecondarySchoolCertificate']['certificate_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Of Birth'); ?></dt>
		<dd>
			<?php echo h($secondarySchoolCertificate['SecondarySchoolCertificate']['date_of_birth']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Certificate Date'); ?></dt>
		<dd>
			<?php echo h($secondarySchoolCertificate['SecondarySchoolCertificate']['certificate_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Year'); ?></dt>
		<dd>
			<?php echo h($secondarySchoolCertificate['SecondarySchoolCertificate']['year']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($secondarySchoolCertificate['SecondarySchoolCertificate']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created By'); ?></dt>
		<dd>
			<?php if(!empty($createdby['User']['username'])){ echo h($createdby['User']['username']);} else{  } ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($secondarySchoolCertificate['SecondarySchoolCertificate']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified By'); ?></dt>
		<dd>
			<?php if(!empty($modifiedby['User']['username'])){ echo h($modifiedby['User']['username']);} else{  }; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php //echo $this->Html->link(__('Edit Secondary School Certificate'), array('action' => 'edit', $secondarySchoolCertificate['SecondarySchoolCertificate']['id'])); ?> </li>
		<li><?php //echo $this->Form->postLink(__('Delete Secondary School Certificate'), array('action' => 'delete', $secondarySchoolCertificate['SecondarySchoolCertificate']['id']), null, __('Are you sure you want to delete # %s?', $secondarySchoolCertificate['SecondarySchoolCertificate']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Secondary School Certificates'), array('action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Secondary School Certificate'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Upload Secondary School Certificate'), array('action' => 'uploadsecondarycertificate')); ?></li>
	</ul>
</div>
