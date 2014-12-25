<div class="employees view">
<?php echo $this->Html->addCrumb('Employee', '/Employees');?>
    <h2><?php echo __('Employee'); ?></h2>
    <dl>
        <dt><?php echo __('Employee Code'); ?></dt>
        <dd>
            <?php echo h($employee['Employee']['code']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Name'); ?></dt>
        <dd>
            <?php echo h($employee['Employee']['name']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Date Of Joining'); ?></dt>
        <dd>
            <?php $joiningddate = date("d-m-Y", strtotime($employee['Employee']['date_of_joining'])); ?>
            <?php echo h($joiningddate); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Date Of Confirm Joining'); ?></dt>
        <dd>
            <?php $confirmationddate = date("d-m-Y", strtotime($employee['Employee']['date_of_confirm_joining'])); ?>
            <?php echo h($confirmationddate); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Experience'); ?></dt>
        <dd>
            <?php echo h($employee['Employee']['experiance'])." Year"; ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Date Of Resignation'); ?></dt>
        <dd>
            <?php $resigonddate = date("d-m-Y", strtotime($employee['Employee']['date_of_resignation'])); ?>
            <?php echo h($resigonddate); ?>
            &nbsp;
        </dd>

        <dt><?php echo __('Created'); ?></dt>
        <dd>
            <?php echo h($employee['Employee']['created']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Created By'); ?></dt>
        <dd>
                        <?php echo h($createuser); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Modified'); ?></dt>
        <dd>
			<?php echo h($employee['Employee']['modified']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Modified By'); ?></dt>
        <dd>
                        <?php echo h($modifyuser); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Document'); ?></dt>
        <dd>

            <a href="<?php echo $this->webroot; ?>employees/download/<?php echo $employee['Employee']['id'] ?>"><input type="button" id="download" value="Download Document" width="100px"></a>
            &nbsp;
        </dd>
    </dl>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Edit Employee'), array('action' => 'edit', $employee['Employee']['id'])); ?> </li>
        <li><?php echo $this->Form->postLink(__('Delete Employee'), array('action' => 'delete', $employee['Employee']['id']), null, __('Are you sure you want to delete # %s?', $employee['Employee']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__('List Employees'), array('action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Employee'), array('action' => 'add')); ?> </li>
    </ul>
</div>

<script>
    $(document).ready(function() {
        $("#download").css('width', '24%');
    });
</script>
