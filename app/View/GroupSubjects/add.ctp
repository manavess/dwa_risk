<div class="groupSubjects form">
<?php  echo $this->Html->addCrumb('Group Subject', '/GroupSubjects'); ?>
    <?php echo $this->Form->create('GroupSubject',array('onsubmit' => 'return validatecourse()')); ?>
    <fieldset>
        <legend><?php echo __('Add Group Subject'); ?></legend>
        <?php
        $options = array('N' => 'No', 'Y' => 'Yes');
        echo $this->Form->input('name', array('required' => false));
        echo $this->Form->input('course_id',array('empty' => 'Select','id' => 'studentcourse','options' => $courses,'required' => false));
        echo $this->Form->input('status', array('type' => 'radio', 'class' => 'radio', 'options' => $options, 'checked' => 'checked'));
        ?> 
        <div class="subject-multi"> 
            <?php echo $this->Form->input('GroupSubSubject.subject_id', array('type' => 'select', 'multiple' => 'checkbox', 'options' => $subjects));
            ?>
        </div>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Html->link(__('List Group Subjects'), array('action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__('List Group Sub Subjects'), array('controller' => 'group_sub_subjects', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('List College Group Subjects'), array('controller' => 'college_group_subjects', 'action' => 'index')); ?> </li>
    </ul>
</div>
<script>
    function validatecourse() {

        var sub_count = 0;
        $('input[type=checkbox]').each(function(index, ele) {

            if ($(ele).is(':checked')) {
                sub_count++;
            }
        });
        if ($("#studentcourse").val() == '1' && sub_count < 7) {
            alert("Subjects must be greater than or equal to 7");
            return false;
        } else if ($("#studentcourse").val() == '2' && sub_count < 5) {
            alert("Subjects must be greater than or equal to 5");
            return false;
        } else {
            return true;
        }
    }
</script>