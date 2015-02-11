<?php

echo $this->Html->script('jquery.js'); ?>
<div class="secondarySchoolCertificates form">
<?php  echo $this->Html->addCrumb('Secondary School Certificate', '/SecondarySchoolCertificates'); ?>
<?php echo $this->Form->create('SecondarySchoolCertificate', array('url' => '','enctype'=>"multipart/form-data",'name' => 'uploadcertificate', 'id' => 'certificateupload','onsubmit'=>'return checkvalidation()')); ?>
    <fieldset>
        <legend><?php echo __('Upload Secondary School Certificate data'); ?></legend>
	<?php
		
		
	?><input type="file" name="data[SecondarySchoolCertificate][excel]" id="FileImage" /> 

        <div id="rightbody">
            <div class="submit" title="Download Secondary School Certificate Template" style="float:left; margin-top:-20px;"><a href="download_secschool_template" target="_blank"><h1>Download Secondary School Certificate Template</h1></a>&nbsp;
            </div>
        </div>

    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('SecondarySchoolCertificate.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('SecondarySchoolCertificate.id'))); ?></li>
        <li><?php echo $this->Html->link(__('List Secondary School Certificates'), array('action' => 'index')); ?></li>
    </ul>
</div>

<script>
    function checkvalidation() {
        var certificatefile = $("#FileImage").val();

        if (certificatefile == '') {
            alert("Please select file to upload");
            return false;
        } else {
            return true;
        }
    }
</script>
