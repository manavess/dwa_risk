<?php echo $this->Html->css('jquery-ui.css'); ?>
<?php echo $this->Html->script('jquery-1.9.1.js'); ?>
<?php echo $this->Html->script('jquery-ui.js'); ?>
<script>
    $(function() {
        $("#datepicker").datepicker({dateFormat: 'dd-mm-yy'});
        $("#datepicker1").datepicker({dateFormat: 'dd-mm-yy'});
    });
</script>
<?php echo $this->Html->addCrumb('College', '/Colleges');?>
<div class="colleges form">
    <?php echo $this->Form->create('College',array('url'=>array('controller'=>'colleges','action'=>'add','novalidate'=>'novalidate','onsubmit'=>'return calculatenumofseat();'))); ?>
    <fieldset>
        <legend><?php echo __('Add College'); ?></legend>
        <div class="form-area">
            <div class="left-area">
                <?php
                echo $this->Form->input('college_code', array('required'=>false));
                echo $this->Form->input('university_id', array('empty' => 'Select','required'=>false));
                echo $this->Form->input('name', array('required'=>false));
                echo $this->Form->input('address1', array('required'=>false));
                echo $this->Form->input('address2');
                echo $this->Form->input('address3');
                echo $this->Form->input('state_id', array('empty' => 'Select', 'id' => 'collegestate', 'style' => 'width:200px','required'=>false));
                echo $this->Form->input('city_id', array('options' => array('empty' => ' Select ',$cities),'id' => 'collegecity', 'style' => 'width:200px','required'=>false));
                echo $this->Form->input('pincode',array('required'=>false));
                ?>
            </div>
            <div class="right-area">
                <?php
                echo $this->Form->input('contact_person', array('required'=>false));
                echo $this->Form->input('email', array('required'=>false));
                echo $this->Form->input('website');
                echo $this->Form->input('phone_no', array('required'=>false));
                echo $this->Form->input('mobile_no', array('required'=>false));
                echo $this->Form->input('no_of_seats', array('required'=>false,'readonly','value'=>0)); ?>
               <div class="calendar"><?php  echo $this->Form->input('affilated_from', array('type' => 'text', 'id' => 'datepicker','readonly','required'=>false)); ?></div>
               <div class="calendar"> <?php echo $this->Form->input('affilated_to', array('type' => 'text', 'id' => 'datepicker1','readonly','required'=>false)); ?></div>
            </div>
        </div>
        <legend><?php echo __('Group Subject Name'); ?></legend>
        <?php $i=0;
        $a=2;
         $class1='testdiv1';
        $class2='testdiv2';
        $subjectgroupname = '';
        foreach ($groupsubjects as $gsub) {
             if($a%2==0){
            ?>
          <div class="<?php echo $class1; ?>">
                <?php
                echo $this->Form->checkbox('CollegeGroupSubject.group_subjects_id',array('name'=>'data[CollegeGroupSubject][group_subjects_id][]','value' => $gsub['GroupSubjects']['id'],'id'=>'grpsubid'.$i,'onclick'=>'grpsubcheck('.$i.')'));
               $subjectgroupname = trim($gsub['GroupSubjects']['name']); 
              ?> <label> <?php  echo $subjectgroupname; ?> </label>
               
               <?php
                echo $this->Form->input('CollegeGroupSubject.no_of_seat', array('name'=>'data[CollegeGroupSubject][no_of_seat][]','type' => 'text','placeholder'=>'No of seats', 'id'=>'grpsubvalue'.$i,'label' => false, 'div' => false, 'class'=>'numofseat','value'=>'','readonly'));
                ?>
            </div> 
            <?php } else {?>
         <div class="<?php echo $class2; ?>">
                <?php
                echo $this->Form->checkbox('CollegeGroupSubject.group_subjects_id',array('name'=>'data[CollegeGroupSubject][group_subjects_id][]','value' => $gsub['GroupSubjects']['id'],'id'=>'grpsubid'.$i,'onclick'=>"grpsubcheck(".$i.")"));
               $subjectgroupname = trim($gsub['GroupSubjects']['name']); 
              ?> <label> <?php  echo $subjectgroupname; ?> </label>
               
               <?php
                echo $this->Form->input('CollegeGroupSubject.no_of_seat', array('name'=>'data[CollegeGroupSubject][no_of_seat][]','type' => 'text','placeholder'=>'No of seats', 'id'=>'grpsubvalue'.$i,'label' => false, 'div' => false,'class'=>'numofseat','value'=>'','readonly'));
                ?>
            </div> <?php } $a++;?>
            <?php  $i++;
            
        }
        ?>
    </fieldset>
    <div id="form-button">
    <?php echo $this->Form->end(__('Submit')); ?>
    	<div class="submit">
                <?php echo $this->Form->reset('Reset', array('title' => 'Reset','value'=>'Reset','type' => 'submit')); ?>
            </div>
   </div>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

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
    $('#collegestate').change(function() {
        $.ajax({
            type: 'POST',
            data: {State: $("#collegestate option:selected").val()},
            url: "<?php echo $this->webroot; ?>universities/getcitylist",
            success: function(data) {
                $('#collegecity').html(data);
            }
        });
        return true;
    });

   $(document).ready(function(){
       $(".testdiv2").css('margin-top','-48px');
   });
 function calculatenumofseat(){
 var grpsubnumofseat=0; 
 $(".numofseat").each(function(){
 	if ($(this).val() != ''){
 	grpsubnumofseat = parseInt(totalnumofseat)+parseInt($(this).val());
 	}
 })
 	var totalnumofseat = $("#CollegeNoOfSeats").val();
 	
 	if(totalnumofseat>=grpsubnumofseat){
 		return true;
 	}else{
 	 	return false;
 	}
 	
 }
function grpsubcheck(i){
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
