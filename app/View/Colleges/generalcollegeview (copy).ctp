<?php ?>
<ul class="breadcrum"><li><?php echo $this->Html->addCrumb('Colleges','#'); ?>      
		</li></ul>
		&nbsp;
    <div id="container" style="width:950px; margin:0 auto;">
      <div id="" class = "form-area2">
                      
            <?php $i=0; $cls = ''; $class = 'left-area'; foreach ($colleges as $college) {  ?>
            <?php if(!empty($college)) : ?> 
                  <?php
                  if ($i == 10) {
                      $i = 0;
                      $class = 'right-area';
                      ?> 
                  <?php }  if($i%2==0){ $cls = 'style="clear:both"'; }else{ $cls = ''; }?>
             <div class="<?php echo $class; ?>" <?php echo $cls; ?>>
                    
                    
                        <table class="width:100%!important;">
                            <tr>
                               <td width="20%" valign="top" align="left" colspan="5" nowrap="nowrap" style="word-wrap:break-word;"><strong><?php echo $college['College']['name']; ?></strong></td>
                                
                                
                            </tr>
                            <tr>
                                
                                <td width="20%" valign="top" align="left" class="td-txt">
                                    <strong>University:</strong><br>
                                    <strong>City :</strong><br>
                                    <strong>State :</strong><br>
                                    <strong>Contact Person: </strong><br>
                                    <strong>Contact No:</strong><br>
                                   <strong> Email: </strong><br>
                                    <strong>Web site:</strong><br>
                                    

                                </td>
                              <?php if(!empty($college)){?>  
                                <td width="80%" valign="top" align="left" colspan="5" class="td-txt" nowrap="nowrap">
                                    <?php echo $college['University']['name']; ?><br>
                                    <?php echo $college['City']['name']; ?><br>
                                    <?php echo $college['State']['name']; ?><br>
                                    <?php echo $college['College']['contact_person']; ?> <br>
                                    <?php echo $college['College']['phone_no']; ?><br>
                                    <?php echo strtolower($college['College']['email']); ?><br>
                                    <?php echo $college['College']['website']; ?><br>
                                    <?php echo $this->html->link('Qualifying Subjects', array('action'=>'course',$college['College']['id']));?>
                                </td>
                              <?php } ?>
                               
                            <tr>
                                <td valign="top" align="left" colspan="5">&nbsp;</td>
                            </tr>
                            
                        </table>
                    
                 
                </div>
          
            <?php   $i++; $cls = 'style="clear:both;"'; endif;
            }  ?>
       
       
    <div>&nbsp;</div>
</div>
        <div>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</div>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
    </div>
</div>



