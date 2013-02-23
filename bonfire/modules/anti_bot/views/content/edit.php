
<?php if (validation_errors()) : ?>
<div class="alert alert-block alert-error fade in ">
  <a class="close" data-dismiss="alert">&times;</a>
  <h4 class="alert-heading">Please fix the following errors :</h4>
 <?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs
if( isset($anti_bot) ) {
    $anti_bot = (array)$anti_bot;
}
$id = isset($anti_bot['id']) ? $anti_bot['id'] : '';
?>
<div class="admin-box">
    <h3>Anti-Bot</h3>
<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <fieldset>
        <div class="control-group <?php echo form_error('anti_bot_IP') ? 'error' : ''; ?>">
            <?php echo form_label('IP', 'anti_bot_IP', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="anti_bot_IP" type="text" name="anti_bot_IP" maxlength="11" value="<?php echo set_value('anti_bot_IP', isset($anti_bot['anti_bot_IP']) ? $anti_bot['anti_bot_IP'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('anti_bot_IP'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('anti_bot_useragent') ? 'error' : ''; ?>">
            <?php echo form_label('UserAgent', 'anti_bot_useragent', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="anti_bot_useragent" type="text" name="anti_bot_useragent" maxlength="200" value="<?php echo set_value('anti_bot_useragent', isset($anti_bot['anti_bot_useragent']) ? $anti_bot['anti_bot_useragent'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('anti_bot_useragent'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('anti_bot_date') ? 'error' : ''; ?>">
            <?php echo form_label('date', 'anti_bot_date', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="anti_bot_date" type="text" name="anti_bot_date"  value="<?php echo set_value('anti_bot_date', isset($anti_bot['anti_bot_date']) ? $anti_bot['anti_bot_date'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('anti_bot_date'); ?></span>
        </div>


        </div>



        <div class="form-actions">
            <br/>
            <input type="submit" name="save" class="btn btn-primary" value="Edit Anti-Bot" />
            or <?php echo anchor(SITE_AREA .'/content/anti_bot', lang('anti_bot_cancel'), 'class="btn btn-warning"'); ?>
            

    <?php if ($this->auth->has_permission('Anti_Bot.Content.Delete')) : ?>

            or <button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php echo lang('anti_bot_delete_confirm'); ?>')">
            <i class="icon-trash icon-white">&nbsp;</i>&nbsp;<?php echo lang('anti_bot_delete_record'); ?>
            </button>

    <?php endif; ?>


        </div>
    </fieldset>
    <?php echo form_close(); ?>


</div>
