<div class="menus view">
<?php echo $this->Html->addCrumb("Menu", '/Menus'); ?>
<h2><?php  echo __('Menu'); ?></h2>
	<dl>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($menu['Menu']['name']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Url'); ?></dt>
		<dd>
			<?php echo h($menu['Menu']['url']); ?>
			&nbsp;
		</dd>
                 <dt><?php echo __('Require_login'); ?></dt>
		<dd><?php if(!empty($menu['Menu']['require_login']) && $menu['Menu']['require_login']=='Y'){ $isloginreq = "Yes"; } else if(!empty($menu['Menu']['require_login']) && $menu['Menu']['require_login']=='N'){ $isloginreq = "No"; }else{ $isloginreq = ""; } ?>
			<?php echo $isloginreq; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd><?php if(!empty($menu['Menu']['status']) && $menu['Menu']['status']=='Y'){ $status = "Yes"; } else if(!empty($menu['Menu']['status']) && $menu['Menu']['status']=='N'){ $status = "No"; }else{ $status = ""; } ?>
			<?php echo $status; ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($menu['Menu']['created']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Created By'); ?></dt>
                <dd>
                        <?php echo h($createuser); ?>
			&nbsp;
                </dd>
                <dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($menu['Menu']['modified']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Modified By'); ?></dt>
                <dd>
                        <?php echo h($modifyuser); ?>
			&nbsp;
                </dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Menu'), array('action' => 'edit', $menu['Menu']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Menu'), array('action' => 'delete', $menu['Menu']['id']), null, __('Are you sure you want to delete # %s?', $menu['Menu']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Menus'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu'), array('action' => 'add')); ?> </li>
	</ul>
</div>
