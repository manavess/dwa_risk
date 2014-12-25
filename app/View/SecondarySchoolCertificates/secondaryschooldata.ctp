<?php  echo $this->Html->addCrumb('Secondary School Certificate', '/SecondarySchoolCertificates'); ?>
<h2>Secondary School Certificate Data</h2>
<div class="demo-info" style="margin-bottom:10px">
    <div class="demo-tip icon-tip">&nbsp;</div>
    <div>Double click the row to begin editing.</div>
</div>
<?php //echo $this->Form->create('SecondarySchoolCertificate'); ?>
<table id="dg" title="Students Data" style="height: 350px; width: 1980px; overflow: hidden;"
       toolbar="#toolbar" pagination="true" idField="id"
       rownumbers="true" fitColumns="true" singleSelect="true">
    <thead>
        <tr>
            <th field="studentname" editor="{type:'validatebox',options:{required:true}}">Student Name</th>
            <th field="dateofbirth" id="datepicker" dateformate="d-m-y" editor="{type:'validatebox',options:{required:true}}">Date of Birth</th>
            <th field="certificatenumber" editor="{type:'validatebox',options:{required:true}}">Certificate Number</th>
            <th field="certificatedate" id="datepicker1" dateformate="d-m-y" editor="{type:'validatebox',options:{required:true}}">Certificate Date</th>
            <th field="certificatetype" editor="{type:'validatebox',options:{required:true}}">Certificate Type</th>
            <th field="COMP1" editor="text">COMP1</th>
            <th field="COMP2" editor="text">COMP2</th>
            <th field="COMP3" editor="text">COMP3</th>
            <th field="COMP4" editor="text">COMP4</th>
            <th field="COMP5" editor="text">COMP5</th>
            <th field="OPT1" editor="text">OPT1</th>
            <th field="OPT2" editor="text">OPT2</th>
            <th field="OPT3" editor="text">OPT3</th>
            <th field="OPT4" editor="text">OPT4</th>
            <th field="OPT5" editor="text">OPT5</th>
            <th field="OPT6" editor="text">OPT6</th>
            <th field="OPT7" editor="text">OPT7</th>
            <th field="OPT8" editor="text">OPT8</th>
            <th field="OPT9" editor="text">OPT9</th>
            <th field="OPT10" editor="text">OPT10</th>
            <th field="OPT11" editor="text">OPT11</th>
            <th field="OPT12" editor="text">OPT12</th>
            <th field="OPT13" editor="text">OPT13</th>
            <th field="OPT14" editor="text">OPT14</th>
            <th field="OPT15" editor="text">OPT15</th>
            <th field="OPT16" editor="text">OPT16</th>
            <th field="OPT17" editor="text">OPT17</th>
            <th field="OPT18" editor="text">OPT18</th>
            <th field="OPT19" editor="text">OPT19</th>
            <th field="OPT20" editor="text">OPT20</th>
            <th field="OPT21" editor="text">OPT21</th>
            <th field="OPT22" editor="text">OPT22</th>
            <th field="OPT23" editor="text">OPT23</th>
            <th field="OPT24" editor="text">OPT24</th>
        </tr>
    </thead>
</table>
<div id="toolbar">
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#dg').edatagrid('addRow')">New</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#dg').edatagrid('destroyRow')">Destroy</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#dg').edatagrid('saveRow')">Save</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#dg').edatagrid('cancelRow')">Cancel</a>
</div>

<?php echo $this->Html->css('easyui_themes_default_easyui.css');?>
<?php echo $this->Html->css('easyui_themes_icon.css');?>
<?php echo $this->Html->css('easyui_demo_demo.css');?>

<?php echo $this->Html->script('easyui.min.js');?>
<?php echo $this->Html->script('edatagrid.js');?>

<script type="text/javascript">
        $(function() {
            $('#dg').edatagrid({
                //url: 'get_users.php',
                saveUrl: '<?php echo $this->webroot;?>secondary_school_certificates/secondaryschooldata',
                //updateUrl: 'update_user.php',
                //destroyUrl: 'destroy_user.php'
            });
        });
</script>
<script type="text/javascript">
    $(function() {
        $("#datepicker").datepicker({dateFormat: 'dd-mm-yy'});
        $("#datepicker1").datepicker({dateFormat: 'dd-mm-yy'});
    });
</script>