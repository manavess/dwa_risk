<?php echo $this->Html->css('jquery-ui.css'); ?>
<?php echo $this->Html->script('jquery-1.9.1.js'); ?>
<?php echo $this->Html->script('jquery-ui.js'); ?>
<?php echo $this->Html->script('dwa_risk.js'); ?>
<script>
    $(function() {
        $("#datepicker").datepicker({dateFormat: 'dd-mm-yy'});
        $("#datepicker1").datepicker({dateFormat: 'dd-mm-yy'});
    });

</script>
<div class="colleges form">
    <?php echo $this->Form->create('College'); ?>
    <fieldset>
        <legend><?php echo __('Edit College'); ?></legend>
        <div class="form-area2">
            <div class="left-area">
                <?php
                echo $this->Form->input('id');
                echo $this->Form->input('college_code', array('required'=>false));
                echo $this->Form->input('university_id', array('empty' => 'Select','required'=>false));
                echo $this->Form->input('name', array('required'=>false));
                echo $this->Form->input('address1', array('required'=>false));
                echo $this->Form->input('address2');
                echo $this->Form->input('address3');
                echo $this->Form->input('state_id', array('empty' => 'Select', 'id' => 'editcollegestate', 'style' => 'width:200px','required'=>false));
                echo $this->Form->input('city_id', array('id' => 'editcollegecity', 'style' => 'width:200px','required'=>false));
                echo $this->Form->input('pincode');
                echo $this->Form->hidden('created_by');
                //echo $this->Form->input('CollegeSubSubjects', array('type' => 'select', 'multiple' => 'checkbox', 'label' => __('Subject Group'), 'class' => 'multiple-chb', 'options' => $groupsubjects));
                ?>
            </div>
            <div class="right-area"> 
                <?php
                echo $this->Form->input('contact_person', array('required'=>false));
                echo $this->Form->input('email', array('required'=>false));
                echo $this->Form->input('website');
                echo $this->Form->input('phone_no', array('required'=>false));
                echo $this->Form->input('mobile_no');
                echo $this->Form->input('no_of_seats', array('required'=>false));
                echo $this->Form->input('affilated_from', array('type' => 'text', 'id' => 'datepicker'));
                echo $this->Form->input('affilated_to', array('type' => 'text', 'id' => 'datepicker1'));
                ?>
            </div>
        </div>
        <legend><?php echo __('Edit Subjects'); ?></legend>
        <?php
        foreach ($groupsubjects as $data) {
            $groupsubjectsID[] = $data['GroupSubjects']['id'];
        }
        if (!empty($CollegeGroupSubject)) {
            foreach ($CollegeGroupSubject as $data) {
                $colleggroupsubid[] = $data['CollegeGroupSubject']['group_subjects_id'];
            }
        } else {
            $colleggroupsubid = array();
        }


        $excludedSubId = array_diff($groupsubjectsID, $colleggroupsubid);


        foreach ($groupsubjects as $gsub) {

            if (!empty($CollegeGroupSubject)) {

                foreach ($CollegeGroupSubject as $key => $val) {

                    if ($val['CollegeGroupSubject']['group_subjects_id'] == $gsub['GroupSubjects']['id']) {
                        ?>
                        <div class="right-area">
                            <?php
                            echo $this->Form->checkbox('CollegeGroupSubject.group_subjects_id', array('name' => 'data[CollegeGroupSubject][group_subjects_id][]', 'value' => $gsub['GroupSubjects']['id'], 'checked' => 'checked'));
                            echo $this->Form->label($gsub['GroupSubjects']['name']);

                            echo $this->Form->input('CollegeGroupSubject.no_of_seat', array('name' => 'data[CollegeGroupSubject][no_of_seat][]', 'type' => 'text', 'label' => false, 'div' => false, 'value' => $val['CollegeGroupSubject']['no_of_seat'], 'required' => true));
                            ?>
                        </div>
                    <?php
                    }
                }
                ?>

                <?php
            }
        }
        if (!empty($excludedSubId)) {
            foreach ($excludedSubId as $key => $val) {
                ?>
                <div class="left-area">
                    <?php
                    echo $this->Form->checkbox('CollegeGroupSubject.group_subjects_id', array('name' => 'data[CollegeGroupSubject][group_subjects_id][]', 'value' => $groupsubjects[$key]['GroupSubjects']['id']));
                    echo $this->Form->label($groupsubjects[$key]['GroupSubjects']['name']);

                    echo $this->Form->input('CollegeGroupSubject.no_of_seat', array('name' => 'data[CollegeGroupSubject][no_of_seat][]', 'type' => 'text', 'label' => false, 'div' => false));
                    ?> </div><?php
            }
            ?> 
            <?php
        }
        ?>

    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('College.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('College.id'))); ?></li>
        <li><?php echo $this->Html->link(__('List Colleges'), array('action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__('List Cities'), array('controller' => 'cities', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New City'), array('controller' => 'cities', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List States'), array('controller' => 'states', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New State'), array('controller' => 'states', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Universities'), array('controller' => 'universities', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New University'), array('controller' => 'universities', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List College Group Subjects'), array('controller' => 'college_group_subjects', 'action' => 'index')); ?> </li>
    </ul>
</div>
<script type="text/javascript">
    $('#editcollegestate').change(function() {
        $.ajax({
            type: 'POST',
            data: {State: $("#editcollegestate option:selected").val()},
            url: "<?php echo $this->webroot; ?>universities/getcitylist",
            success: function(data) {
                $('#editcollegecity').html(data);
            }
        });
        return true;
    });


</script>
