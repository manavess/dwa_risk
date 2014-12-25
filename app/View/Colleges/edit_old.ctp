<?php echo $this->Html->css('jquery-ui.css'); ?>
<?php echo $this->Html->script('jquery-1.9.1.js'); ?>
<?php echo $this->Html->script('jquery-ui.js'); ?>
<?php echo $this->Html->script('dwa_risk.js'); ?>
<script>
    $(function() {
        $("#datepicker").datepicker({dateFormat: 'dd-mm-yy'});
        $("#datepicker1").datepicker({dateFormat: 'dd-mm-yy'});
    });

    function comparedate(){

    var fromDate = new Date($('#datepicker').val());
     var toDate = new Date($('#datepicker1').val()); 
    if (fromDate > toDate)
    {
     alert('Fromdate must be less than todate');
    }
    }
</script>
<div class="colleges form">
<?php echo $this->Html->addCrumb('College', '/Colleges');?>
    <?php  echo $this->Form->create('College',array('controller'=>'colleges','action'=>'edit','novalidate'=>'novalidate')); ?>
    <fieldset>
        <legend><?php echo __('Edit College'); ?></legend>
        <div class="form-area2">
            <div class="left-area">
                <?php
                echo $this->Form->input('id');
                echo $this->Form->input('college_code', array('required'=>false));
                echo $this->Form->input('university_id', array('empty' => 'Select','required'=>false));
                echo $this->Form->input('name');
                echo $this->Form->input('address1', array('required'=>false));
                echo $this->Form->input('address2');
                echo $this->Form->input('address3');
                echo $this->Form->input('state_id', array('empty' => 'Select', 'id' => 'editcollegestate', 'style' => 'width:200px','required'=>false));
                echo $this->Form->input('city_id', array('options' => array('empty' => ' Select ',$cities),'id' => 'editcollegecity', 'style' => 'width:200px','required'=>false));
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
                echo $this->Form->input('mobile_no',array('required'=>false));
                echo $this->Form->input('no_of_seats', array('required'=>false,'readonly'));
                echo $this->Form->input('affilated_from', array('type' => 'text', 'id' => 'datepicker','readonly'));
                echo $this->Form->input('affilated_to', array('type' => 'text', 'id' => 'datepicker1','onchange'=>'comparedate()','readonly'));
                ?>
            </div>
        </div>

        <legend><?php echo __('Edit Group Subject Name');
        $class1='testdiv1';
        $class2='testdiv2';
        ?></legend>
        
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

         $a=2;
         $i=0;
        foreach ($groupsubjects as $gsub) {

            if (!empty($CollegeGroupSubject)) {

                foreach ($CollegeGroupSubject as $key => $val) {

                    if ($val['CollegeGroupSubject']['group_subjects_id'] == $gsub['GroupSubjects']['id']) {
                        if($a%2==0){ ?>

                        <div class="<?php echo $class1; ?>">
                            <?php
                            echo $this->Form->checkbox('CollegeGroupSubject.group_subjects_id', array('name' => 'data[CollegeGroupSubject][group_subjects_id][]', 'value' => $gsub['GroupSubjects']['id'], 'checked' => 'checked','id'=>'grpsubid'.$i,'onclick'=>'editgrpsubcheck('.$i.')'));
                            ?><label><?php echo $gsub['GroupSubjects']['name']; ?></label>
                                <?php
                            echo $this->Form->input('CollegeGroupSubject.no_of_seat', array('name' => 'data[CollegeGroupSubject][no_of_seat][]', 'type' => 'text', 'label' => false, 'div' => false, 'value' => $val['CollegeGroupSubject']['no_of_seat'], 'id'=>'grpsubvalue'.$i,'placeholder'=>'No of seats'));
                            ?>
                        </div>
                    <?php
                        }else{?>
                             <div class="<?php echo $class2; ?>">
                            <?php
                            echo $this->Form->checkbox('CollegeGroupSubject.group_subjects_id', array('name' => 'data[CollegeGroupSubject][group_subjects_id][]', 'value' => $gsub['GroupSubjects']['id'], 'checked' => 'checked','id'=>'grpsubid'.$i,'onclick'=>'editgrpsubcheck('.$i.')'));
                             ?><label><?php echo $gsub['GroupSubjects']['name']; ?></label>
                                <?php

                            echo $this->Form->input('CollegeGroupSubject.no_of_seat', array('name' => 'data[CollegeGroupSubject][no_of_seat][]', 'type' => 'text', 'label' => false, 'div' => false, 'value' => $val['CollegeGroupSubject']['no_of_seat'], 'id'=>'grpsubvalue'.$i,'placeholder'=>'No of seats'));
                            ?>
                        </div>

                       <?php } $a++; $i++;
                    }
                }
                ?>

                <?php
            }
        }
            $b =2;
            if(!empty($a)){
            $b=$a;
            }
        
        if (!empty($excludedSubId)) {
            foreach ($excludedSubId as $key => $val) {
                if($b%2==0){
                        ?>
                           
                        <div class="<?php echo $class1; ?>">
                    <?php
                    echo $this->Form->checkbox('CollegeGroupSubject.group_subjects_id', array('name' => 'data[CollegeGroupSubject][group_subjects_id][]', 'value' => $groupsubjects[$key]['GroupSubjects']['id'],'id'=>'grpsubid'.$i,'onclick'=>'editgrpsubcheck('.$i.')'));
                    ?><label><?php echo $groupsubjects[$key]['GroupSubjects']['name'];?></label>
                    <?php

                    echo $this->Form->input('CollegeGroupSubject.no_of_seat', array('name' => 'data[CollegeGroupSubject][no_of_seat][]', 'type' => 'text', 'label' => false, 'div' => false, 'id'=>'grpsubvalue'.$i,'readonly','placeholder'=>'No of seats','value'=>''));
                    ?> </div>
                        <?php
                 }else{?>
                        <div class="<?php echo $class2; ?>">
                    <?php
                    echo $this->Form->checkbox('CollegeGroupSubject.group_subjects_id', array('name' => 'data[CollegeGroupSubject][group_subjects_id][]', 'value' => $groupsubjects[$key]['GroupSubjects']['id'],'id'=>'grpsubid'.$i,'onclick'=>'editgrpsubcheck('.$i.')'));
                    ?><label><?php echo $groupsubjects[$key]['GroupSubjects']['name'];?></label>
                    <?php

                    echo $this->Form->input('CollegeGroupSubject.no_of_seat', array('name' => 'data[CollegeGroupSubject][no_of_seat][]', 'type' => 'text', 'label' => false, 'div' => false, 'id'=>'grpsubvalue'.$i,'readonly','placeholder'=>'No of seats','value'=>''));
                    ?> </div>
                     
               <?php  } $b++; $i++;
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

        <li><?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('College.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('College.id'))); ?></li>
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

function editgrpsubcheck(i){
if($("#grpsubid"+i).is(':checked')==true){
	$("#grpsubvalue"+i).removeAttr('readonly');
	$("#grpsubvalue"+i).removeAttr('placeholder','No of seats');
}else{
	$("#grpsubvalue"+i).attr('readonly','readonly');
	$("#grpsubvalue"+i).attr('placeholder','No of seats');

	$("#grpsubvalue"+i).val('');
}

}
</script>
