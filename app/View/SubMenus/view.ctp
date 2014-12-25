<div class="subMenus view">
<?php  echo $this->Html->addCrumb("Sub Menu", '/SubMenus'); ?>
<h2><?php  echo __('Sub Menu'); ?></h2>
	<dl>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($subMenu['SubMenu']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Menu'); ?></dt>
		<dd>
			<?php echo $this->Html->link($subMenu['Menu']['name'], array('controller' => 'menus', 'action' => 'view', $subMenu['Menu']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Url'); ?></dt>
		<dd>
			<?php echo h($subMenu['SubMenu']['url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd><?php if(!empty($subMenu['SubMenu']['status']) && $subMenu['SubMenu']['status']=='Y'){ $status = "Yes"; } else if(!empty($subMenu['SubMenu']['status']) && $subMenu['SubMenu']['status']=='N'){ $status = "No"; }else{ $status = ""; } ?>
			<?php echo $status; ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($subMenu['SubMenu']['created']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Created By'); ?></dt>
                <dd>
                        <?php echo h($createuser); ?>
			&nbsp;
                </dd>
                <dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($subMenu['SubMenu']['modified']); ?>
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
		<li><?php echo $this->Html->link(__('Edit Sub Menu'), array('action' => 'edit', $subMenu['SubMenu']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Sub Menu'), array('action' => 'delete', $subMenu['SubMenu']['id']), null, __('Are you sure you want to delete # %s?', $subMenu['SubMenu']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Sub Menus'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sub Menu'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Menus'), array('controller' => 'menus', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu'), array('controller' => 'menus', 'action' => 'add')); ?> </li>
	</ul>
</div>
