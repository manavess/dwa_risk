<?php $this->TinyMCE->editor(array('theme' => 'advanced', 'mode' => 'textareas'));?>
<?php echo $this->Html->addCrumb('Admission Guide', '/AdmissionGuides');?>
<div class="admissionGuides form">
   <!--- <form action="<?php echo $this->webroot; ?>AdmissionGuides/add" enctype="multipart/form-data" method="post"> --->
        <?php echo $this->Form->create('AdmissionGuide',array('enctype'=>'multipart/form-data','onsubmit'=>'return checkforblank();')); ?>
        <fieldset>
            <legend><?php echo __('Add Admission Guide'); ?></legend>
            <?php
            echo $this->Form->input('admission_guide', array('required'=>false,'id'=>'textdata'));
            echo $this->Form->input('image', array('type' => 'file'));
            ?>
            
        </fieldset>
        <?php echo $this->Form->end(__('Submit')); ?>
    <!---</form>      --->
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Html->link(__('List Admission Guides'), array('action' => 'index')); ?></li>
    </ul>
</div>
<script>
function checkforblank(){
alert("hello"); return false;
}
</script>
