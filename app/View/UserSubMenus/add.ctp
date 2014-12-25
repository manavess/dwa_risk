<div class="userSubMenus form">
<?php echo $this->Form->create('UserSubMenu'); ?>
	<fieldset>
		<legend><?php echo __('Add User Sub Menu'); ?></legend>
	<?php
		echo $this->Form->input('user_id', array('empty' => 'Select'));
		   echo '<div id="menus">Please Select Users..</div>'
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List User Sub Menus'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sub Menus'), array('controller' => 'sub_menus', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sub Menu'), array('controller' => 'sub_menus', 'action' => 'add')); ?> </li>
	</ul>
</div>
<script type="text/javascript">
    $("#UserSubMenuUserId").bind("change", function() {
        var html = 'Please wait...';
         $('#menus').html(html);
         var webroot='<?php echo $this->webroot; ?>';
        $.ajax({
            type: "POST",
            url: webroot+"userSubMenus/getmenusubmenulist",
            data: {id: $(this).val()},
            dataType: "json",
            success: function(msg) {
                                var html = '<div><table width="100%">';
                $.each(msg.Menus, function() {
                    menu = this.Menu.id;
                    ismenucheck = false;
                    $.each(msg.Permission, function() {
                        if (this.Menu.id === menu)
                        {
                            ismenucheck = true;

                        }
                    });
                    if (ismenucheck)
                        html += '<tr><td style="font-weight:bold;"><input name="data[UserSubMenu][menu_id][]" type="checkbox" checked="checked" value="' + this.Menu.id + '" />' + this.Menu.name + '</td><td>';
                    else
                        html += '<tr><td style="font-weight:bold;"><input name="data[UserSubMenu][menu_id][]" type="checkbox" value="' + this.Menu.id + '" />' + this.Menu.name + '</td><td>';
                    if (this.SubMenu.length > 0)
                    {
                        html += '<table>';
                        var i = 0;
                        $.each(this.SubMenu, function() {
                            var submenu = this.id;
                            var ischeck = false;
                            $.each(msg.Permission, function() {
                                if (this.SubMenu.id === submenu)
                                {
                                    ischeck = true;
                                }
                            });
//                            if (i % 3 === 0)
//                                html += '</tr><tr>';
//                            i++;
                            if (ischeck)
                                html += '<tr><td>' + this.name + '<input name="data[UserSubMenu][subMenu_id][]" type="checkbox" checked="checked" value="' + this.id + '" /> </td><td>';
                            else
                                html += '<tr><td>' + this.name + '<input name="data[UserSubMenu][subMenu_id][]" type="checkbox" value="' + this.id + '" /> </td><td>';

                            if (this.MenuAction.length > 0)
                            {
                                html += '<table style="font-size: 11px;"><tr>';
                                $.each(this.MenuAction, function() {
                                    var action = this.id;
                                    var isactioncheck = false;
                                    $.each(msg.Permission, function() {
                                        if (this.MenuAction.id === action)
                                        {
                                            isactioncheck = true;
                                        }
                                    });
                                    if (isactioncheck)
                                        html += '<td>' + this.name + '<input name="data[UserSubMenu][MenuAction_id][]" checked="checked" type="checkbox" value="' + this.id + '" /> </td><td>';
                                    else
                                        html += '<td>' + this.name + '<input name="data[UserSubMenu][MenuAction_id][]" type="checkbox" value="' + this.id + '" /> </td><td>';
                                });
                                html += '</tr></table>';
                            }
                            html += '</td></tr>';


                        });
                        html += '</table>';
                    }
                    html += '</td></tr>';
                });
                html += '</table></div>';
                $('#menus').html(html);
            }
        });
    });
</script>
