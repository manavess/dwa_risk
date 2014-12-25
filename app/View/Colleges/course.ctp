<ul class="breadcrum" style="margin-left:245px!important"><li><?php echo $this->Html->addCrumb('Colleges','#'); ?>      
		>>&nbsp;Qualifying Subjects</li></ul>
		<div>&nbsp;</div>
    <div id="container">
        <div id="">
           
             <div>
                    <div style="margin-left:130px">
                        <table width="50%" style="width:50%!important;">
                            <tr>
                                <td width="100%" valign="top" align="left" class="td-txt" colspan="2"><strong><?php echo $colleges['College']['name']; ?></strong></td>
                              
                               
                            </tr>
                            	<tr>
		                            <td width="20%" valign="top" align="left" class="td-txt">
		                                Number of Seats:
		                                
		                            </td>
		                            <td valign="top" align="left" class="td-txt">
		                                <?php echo $colleges['College']['no_of_seats']; ?>
		                                
		                            </td>
                                </tr>
                                <tr>
				                        <td class="td-txt">
				                        Subjects :
				                        </td>
				                        <td class="td-txt">
				                        <?php echo $subjects; ?>
				                        </td>
                                </tr>
                           
                            </tr>
                        </table>
                    </div>
                </div>
        </div>
     </div>
