<?php
        // put your code here
        ?>
<div class="employees form">
<?php echo $this->Html->addCrumb('Gallery', 'Galleries/');?>
   <!--- <form action="<?php echo $this->webroot; ?>employees/add" enctype="multipart/form-data" method="post"> ---->
    <?php echo $this->Form->create('Gallery',array('url'=>array('action'=>'add','controller'=>'Galleries'),"onsubmit"=>"return documentsize();",'enctype'=>'multipart/form-data')); ?>
    <fieldset>
        <legend><?php echo __('Add New Image'); ?></legend>
        
        <label style="margin-left:220px;">Only png, jpeg files are uploaded in size not more than 1 MB/</label>
       <?php echo $this->Form->input('image', array('type' => 'file'));
        ?>

    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
   <!--- </form> --->
</div>