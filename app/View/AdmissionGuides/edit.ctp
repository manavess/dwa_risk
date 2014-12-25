<?php $this->TinyMCE->editor(array('theme' => 'advanced', 'mode' => 'textareas'));?>
<div class="admissionGuides form">
<?php echo $this->Html->addCrumb('Admission Guide', '/AdmissionGuides');?>

        <?php echo $this->Form->create('AdmissionGuide',array('enctype'=>'multipart/form-data','onsubmit'=>'return checkblank()')); ?>
        <fieldset>
            <legend><?php echo __('Edit Admission Guide'); ?></legend>
            <?php
            echo $this->Form->input('id');
            echo $this->Form->input('admission_guide', array('required'=>false));
            echo $this->Form->input('image', array('type' => 'file'));
            
         ?><p id="msg_error"><p>
            <img src="data:image/jpeg;base64, <?php echo @base64_encode($this->data['AdmissionGuide']['image']);?>" />
        </fieldset>
        <?php echo $this->Form->end(__('Submit')); ?>

</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('AdmissionGuide.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('AdmissionGuide.id'))); ?></li>
        <li><?php echo $this->Html->link(__('List Admission Guides'), array('action' => 'index')); ?></li>
    </ul>
</div><?php echo $this->element('sql_dump');?>

<script>
//function checkblank(){

//var content = tinyMCE.get('tinyeditor').getContent();  // msg = textarea id
//alert(content); return false;
//if(content == "<p> </p>" ){
//alert('hello'); return false;
//}
//return false;
//}

</script>
