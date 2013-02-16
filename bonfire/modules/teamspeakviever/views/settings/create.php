
<?php if (validation_errors()) : ?>
<div class="alert alert-block alert-error fade in ">
  <a class="close" data-dismiss="alert">&times;</a>
  <h4 class="alert-heading">Please fix the following errors :</h4>
 <?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs
if( isset($teamspeakviever) ) {
    $teamspeakviever = (array)$teamspeakviever;
}
$id = isset($teamspeakviever['id']) ? $teamspeakviever['id'] : '';
?>
<div class="admin-box">
    <h3>TeamspeakViever</h3>
<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <fieldset>
        <div class="control-group <?php echo form_error('teamspeakviever_tsip') ? 'error' : ''; ?>">
            <?php echo form_label('TeamSpeak IP'. lang('bf_form_label_required'), 'teamspeakviever_tsip', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="teamspeakviever_tsip" type="text" name="teamspeakviever_tsip" maxlength="18" value="<?php echo set_value('teamspeakviever_tsip', isset($teamspeakviever['teamspeakviever_tsip']) ? $teamspeakviever['teamspeakviever_tsip'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('teamspeakviever_tsip'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('teamspeakviever_servername') ? 'error' : ''; ?>">
            <?php echo form_label('Servername'. lang('bf_form_label_required'), 'teamspeakviever_servername', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="teamspeakviever_servername" type="text" name="teamspeakviever_servername" maxlength="255" value="<?php echo set_value('teamspeakviever_servername', isset($teamspeakviever['teamspeakviever_servername']) ? $teamspeakviever['teamspeakviever_servername'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('teamspeakviever_servername'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('teamspeakviever_query_port') ? 'error' : ''; ?>">
            <?php echo form_label('Query Port'. lang('bf_form_label_required'), 'teamspeakviever_query_port', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="teamspeakviever_query_port" type="text" name="teamspeakviever_query_port" maxlength="6" value="<?php echo set_value('teamspeakviever_query_port', isset($teamspeakviever['teamspeakviever_query_port']) ? $teamspeakviever['teamspeakviever_query_port'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('teamspeakviever_query_port'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('teamspeakviever_srvpassword') ? 'error' : ''; ?>">
            <?php echo form_label('Password', 'teamspeakviever_srvpassword', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="teamspeakviever_srvpassword" type="password" name="teamspeakviever_srvpassword" maxlength="255" value="<?php echo set_value('teamspeakviever_srvpassword', isset($teamspeakviever['teamspeakviever_srvpassword']) ? $teamspeakviever['teamspeakviever_srvpassword'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('teamspeakviever_srvpassword'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('teamspeakviever_server_id') ? 'error' : ''; ?>">
            <?php echo form_label('Server ID'. lang('bf_form_label_required'), 'teamspeakviever_server_id', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="teamspeakviever_server_id" type="text" name="teamspeakviever_server_id" maxlength="3" value="<?php echo set_value('teamspeakviever_server_id', isset($teamspeakviever['teamspeakviever_server_id']) ? $teamspeakviever['teamspeakviever_server_id'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('teamspeakviever_server_id'); ?></span>
        </div>


        </div>



        <div class="form-actions">
            <br/>
            <input type="submit" name="save" class="btn btn-primary" value="Create TeamspeakViever" />
            or <?php echo anchor(SITE_AREA .'/settings/teamspeakviever', lang('teamspeakviever_cancel'), 'class="btn btn-warning"'); ?>
            
        </div>
    </fieldset>
    <?php echo form_close(); ?>


</div>
