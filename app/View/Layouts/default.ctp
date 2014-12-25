<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
$cakeDescription = __d('dwa_risk', 'DWA RISK: Ministry of Higher Education, Science And Technology');
?>
<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $cakeDescription ?>:
            <?php echo $title_for_layout; ?>
        </title>
        <?php
        echo $this->Html->css('loginslider');
        echo $this->Html->script('jquery-1.7.2.min');
        echo $this->Html->script('common');
        echo $this->Html->script('jquery.slidepanel.setup');
        echo $this->Html->script('jquery.nivo.slider');
        echo $this->Html->script('dwa_risk');
        echo $this->Html->meta('icon');
        echo $this->Html->css('cake.generic');
        echo $this->Html->css('navi');
        echo $this->Html->css('forms');
        echo $this->Html->css('screen');
        echo $this->Html->css('nivo-slider');
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
        <script>
        
        </script>
    </head>
    <body>
        <div id="container">
            <div id="header">
            
                <?php if (!$loggedIn) { ?>
                    <div id="container-wrapper2" class="col0">  
                        <div id="container-wrapper">
                            <div id="topbar">
                                <div id="slidepanel">
                                    <div class="topbox">
                                        <h2>Ministry of higher education, science and technology</h2>
                                        <?php echo $this->element('logintext'); ?>
                                        <p class="readmore"><a href="<?php echo $this->webroot; ?>Abouts/generalaboutushtml">Continue Reading &raquo;</a></p>
                                    </div>

                                    <div class="topbox last" style="width:300px;">
                                        <h2 class="mar-left">Login Here</h2>
                                        <?php
                                        echo $this->Form->create('User', array('url'=>array('controller'=>'Users','action'=>'login'),'id'=>'UserLoginForm','onsubmit'=>'return checkvalidation();'));
                                        echo $this->Form->inputs(array(
                                            'legend' => __('Login'),
                                            'username'=>array('required'=>false,'class'=>'lower','id'=>'userid'),
                                            'password'=>array('required'=>false,'id'=>'pwd')
                                        ));
                                        ?>
                                        <br /><br />
                                  
                                        <label class='loginpagerror' id='lblmsg'></label>
                                        <label for="pupilremember">
                                            <?php
                                            echo $this->Form->input('remember_me', array('label' => false, 'div' => false, 'type' => 'checkbox'));
                                            echo 'Remember me | ';
                                            echo $this->Html->link("Forgot Password ?", array("controller" => "users", "action" => "forgotpassword"));
                                            ?>
                                        </label>

                                        <?php
                                        echo $this->Form->submit(
                                                'Login', array('class' => 'pupillogin', 'title' => 'Custom Title')
                                        );
                                        ?>
                                        <div class="reset">
                                            <?php
                                            echo $this->Form->reset(
                                                    'Reset', array('class' => 'pupillogin', 'title' => 'Custom Title','id'=>'reset','onclick'=>'return resetfield()')
                                            );
                                            echo $this->Form->end();
                                            ?>
                                        </div>
                                    </div>
                                    <br class="clear" />
                                </div>
                                <div id="loginpanel">
                                    <ul>
                                        <li class="left">&nbsp;</li>
                                        <li class="right" id="toggle"><a id="slideit" href="#slidepanel">Login Here</a><a id="closeit" style="display: none;" href="#slidepanel">Close Panel</a></li>
                                    </ul>
                                </div>
                                <br class="clear" />
                            </div>
                        </div>
                    </div>
                <?php } else { 
                    ?>

                    <div id="container-wrapper2" class="col0">  
                        <div id="container-wrapper">
                            <div id="topbar">
                                <div id="loginpanel">
                                    <ul>
                                        <li class="left">&nbsp;</li>
                                        <li class="right"><?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => "logout")); ?></li>
                                    </ul>
                                </div>
                                <br class="clear" />
                            </div>
                        </div>
                    </div>

                <?php } ?> 
                <!----- header logo area start ----->
                <div id="container-wrapper2" class="col1" style="padding-bottom:13px;">
                    <div id="container-wrapper">
                        <div id="logo">
                            <h1><a href="<?php echo $this->webroot; ?>"><img src="<?php echo $this->webroot; ?>img/demo/logo00.png" width="108" height="100" /></a> </h1>
                        </div>
                        <div id="logo1"><img src="<?php echo $this->webroot; ?>img/demo/logo12.png" /></div>
                         <?php if (!$loggedIn) { ?>  
                        <div class="fl_right">
<!--                            <p class="icon"> <a href="#"><img src="<?php //echo $this->webroot; ?>img/demo/in-icon1.png" /></a> <a href="#"><img src="<?php //echo $this->webroot; ?>img/demo/t-icon1.png" /></a> <a href="#"><img src="<?php //echo $this->webroot; ?>img/demo/f-icon1.png" /></a></p>-->
                            <p>Mail: info@moest.com</p>
                        </div>
                        <?php } ?>
                     <br class="clear" />
                    </div>
                </div>

                <?php
                if ($loggedIn) {
                    echo $this->element('menu');
                } else {
                    echo $this->element('guestmenu');
                }
                ?>
            </div>
            <div id="content" style="min-height:400px">
				
                <?php echo $this->Session->flash(); ?>
				
				<div id="breadcrum"><?php if($this->params['action']!='login'){ echo $this->Html->getCrumbs(' >> ','Home'); } //if($this->params['action']!='login' && $loggedIn==FALSE){} ?></div>
                <?php echo $this->fetch('content'); ?>

            </div>
            <div id="footer">



                <div id="footer-bg"> 
                <?php if (!$loggedIn) { ?>           
                    <div id="container-wrapper" class="col5">      
                        <div id="newsletter">
                            <h2>Admission Alert-Never Miss a Great Opportunity</h2>
                            <p>Please enter your email to know about courses of new admission.</p>
                            
                                <fieldset>
                                    <legend>News Letter</legend>
                                    <input type="text" value="Enter Email Here&hellip;" id="subscriberemail"  onfocus="this.value = (this.value == 'Enter Email Here&hellip;') ? '' : this.value;" style="text-transform:lowercase;"/>
                                    <input type="button" name="news_go" id="news_go" value="GO" onclick="return savesubscriber('news_go');"/>
                                </fieldset>
                            
                            <p>To unsubscribe please <a href="#" id="unsubscribe" onclick="return savesubscriber('unsubscribe');">click here &raquo;</a></p>
                        </div>
                        <div class="footbox">
                            <h2> More...</h2>
                            <ul>
                                <li><a href="<?php echo $this->webroot;?>Notices/generalnoticehtml">Notices</a></li>
                                <li><a href="<?php echo $this->webroot;?>PressReleases/generalpressreleasehtml">Press Release</a></li>
                                <li><a href="<?php echo $this->webroot;?>Sitemaps/index">Sitemap</a></li>
                                <li><a href="<?php echo $this->webroot;?>ContactDetails/generalcontactdetailhtml">Contact us</a></li>
                            </ul>
                        </div>                       
                        <div class="footbox">
                            <h2>About us</h2>
                            <ul>
                                <li><a href="<?php echo $this->webroot;?>Abouts/generalaboutushtml">About us MoEST-HE</a></li>
                                <li><a href="<?php echo $this->webroot;?>Overviews/generaloverviewhtml">Overview</a></li>
                                <li><a href="<?php echo $this->webroot;?>Visions/generalvisionhtml">Vision</a></li>
                                <li><a href="<?php echo $this->webroot;?>Missions/generalmissionhtml">Mission</a></li>
                                <li><a href="<?php echo $this->webroot; ?>Galleries">Gallery</a></li>
                            </ul>
                        </div>
                        <br class="clear" />
                    </div>
                    <!--div style="width:100%; float:left;"><?php
                    //echo $this->Html->link(
                    //$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')), 'http://www.cakephp.org/', array('target' => '_blank', 'escape' => false)
                    //);
                    ?></div-->
                     <?php } ?>
                </div>
               
          
                </div>


                <div id="copyright-bg">
                    <div id="container-wrapper" class="col6"> 
                        <div id="copyright">
 
                            <p class="fl_left" style="margin-top:5px;">Copyright &copy; 2014 - All Rights Reserved - MoEST-HE </p>
                            <?php if (!$loggedIn) { ?>
                                <p class="fl_right"> 
                                    <a href="#"><img src="<?php echo $this->webroot; ?>img/demo/in-icon1.png" style="float:right; margin-left:5px;"/></a> 
                                    <a href="#"><img src="<?php echo $this->webroot; ?>img/demo/t-icon1.png"  style="float:right; margin-left:5px;" /></a> 
                                    <a href="#"><img src="<?php echo $this->webroot; ?>img/demo/f-icon1.png"  style="float:right; margin-left:5px;" /></a></p>
                            <?php } ?>

                            <br class="clear" />
                        </div>
                    </div>
                </div>
            </div>    
<?php //echo $this->element('sql_dump'); ?>

        </div>
        <script>
        function savesubscriber(subsription){
            
        var email = $("#subscriberemail").val();
        	email = email.toLowerCase();
 			var atpos = email.indexOf("@");
 			var dotpos = email.lastIndexOf(".");
 			if(atpos<1 || dotpos<atpos+2 || dotpos+2 == email.length){
 			alert("Not a valid email address");
 			return false;
 			}else{			
 			
 				if(subsription == 'news_go'){
 				
 				
				$.ajax({
				type: 'POST',
				data: {email: email},
				url: "<?php echo $this->webroot; ?>Subscribermails/addsubscriber",
				success: function(data) {
				
					alert(data);

				}
				});
				return true;
 			}else{
	 			$.ajax({
					type: 'POST',
					data: {email: email},
					url: "<?php echo $this->webroot; ?>Subscribermails/unsubscribe",
					success: function(data) {
				
						alert(data);

					}
					});
					return true;
 			}
 			}       
        }
        function checkvalidation(){
        	var user = $("#userid").val();
        	var pass = $("#pwd").val();
        	var status = '';
        	
        	var msg='';
        	
        	if(user=='' || user.length == 0){
        		msg='User name can\'t be null'; 
        		
        		status = false;
        	}else{
        		status = true;
        		$("#lblmsg").html(msg);
        	}
        	
        	if(status==true)
        	{
		    	if(pass=='' || pass.length==0){
		    		msg='Password can\'t be null';		    		
		    		status = false;
		    	}
        	}
        	
        	
        	if(status==true){
        		$("#lblmsg").html();
        		return true;
        	}else{
        		$("#lblmsg").show();
        		$("#lblmsg").html(msg);
        		return false;
        	}
        }
        $("#reset").click(function(){

        	$("#lblmsg").hide();
       			
        	$("#userid").val('');

        	$("#pwd").val('');

                return false;

        
        });
        </script>


    </body>
</html>
