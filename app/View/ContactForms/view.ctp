<div class="contactForms view">
<h2><?php  echo __('ContactForm'); ?></h2>
	<dl>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($contactForm['ContactForm']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email Id'); ?></dt>
		<dd>
			<?php echo h($contactForm['ContactForm']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contact No'); ?></dt>
		<dd>
			<?php echo h($contactForm['ContactForm']['phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Subject'); ?></dt>
		<dd>
			<?php echo h($contactForm['ContactForm']['subject']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comments'); ?></dt>
		<dd>
			<?php echo h($contactForm['ContactForm']['comment']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php //echo $this->Html->link(__('Edit ContactForm'), array('action' => 'edit', $contactForm['ContactForm']['id'])); ?> </li>
		<li><?php //echo $this->Form->postLink(__('Delete ContactForm'), array('action' => 'delete', $contactForm['ContactForm']['id']), null, __('Are you sure you want to delete # %s?', $contactForm['ContactForm']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List ContactForms'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New ContactForm'), array('action' => 'add')); ?> </li>
	</ul>
</div>
