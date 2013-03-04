
<?php if (validation_errors()) : ?>
<div class="alert alert-block alert-error fade in ">
  <a class="close" data-dismiss="alert">&times;</a>
  <h4 class="alert-heading">Please fix the following errors :</h4>
 <?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs
if( isset($impressum) ) {
    $impressum = (array)$impressum;
}
$id = isset($impressum['id']) ? $impressum['id'] : '';
?>
<div class="admin-box">
    <h3>Impressum</h3>
<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <fieldset>
        <div class="control-group <?php echo form_error('impressum_impress_text') ? 'error' : ''; ?>">
            <?php echo form_label('Impressum'. lang('bf_form_label_required'), 'impressum_impress_text', array('class' => "control-label") ); ?>
            <div class='controls'>
            <?php echo form_textarea( array( 'name' => 'impressum_impress_text', 'id' => 'impressum_impress_text', 'rows' => '5', 'cols' => '80', 'value' => set_value('impressum_impress_text', isset($impressum['impressum_impress_text']) ? $impressum['impressum_impress_text'] : '') ) )?>
            <span class="help-inline"><?php echo form_error('impressum_impress_text'); ?></span>
        </div>

        </div>



        <div class="form-actions">
            <br/>
            <input type="submit" name="save" class="btn btn-primary" value="Create Impressum" />
            or <?php echo anchor(SITE_AREA .'/settings/impressum', lang('impressum_cancel'), 'class="btn btn-warning"'); ?>
            
        </div>
    </fieldset>
    <?php echo form_close(); ?>


</div>
