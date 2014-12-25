<ul class="breadcrum breadcrum1"><li><?php echo $this->Html->addCrumb('Contact Us >>','#'); ?>      
		Contact Form</li></ul>
		
<div class="contactForms form">
    <?php echo $this->Form->create('ContactForm'); ?>
    <fieldset>
        <legend><?php echo __('Contact Form'); ?></legend>
        <?php
        echo $this->Form->input('name', array('required' => 'false'));
        echo $this->Form->input('email', array('required' => 'false', 'type' => 'text','lower' => true));
        echo $this->Form->input('phone', array('required' => 'false'));
        echo $this->Form->input('subject', array('required' => 'false'));
        echo $this->Form->input('comment', array('required' => 'false'));
        ?>
    </fieldset>
    <div id="form-button">
        <div class="submit" style="margin-top:6px;">
            <?php echo $this->Form->reset('Reset', array('title' => 'Custom Title','type'=>'submit','value'=>'Reset')); ?>
        </div>
        <div class="submit">
        <?php echo $this->Form->end(__('Submit')); ?>
        </div>
    </div>
    
</div>