
<?php if (validation_errors()) : ?>
<div class="notification error">
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs    
if( isset($messages) ) {
	$messages = (array)$messages;
}
$id = isset($messages['pm_id']) ? "/".$messages['pm_id'] : '';
?>
<?php echo form_open($this->uri->uri_string(), 'class="constrained ajax-form"'); ?>
<?php if(isset($message)) : ?>
	<input id="pm_title" type="hidden" name="pm_title"  value="re:<?php echo $message->pm_title; ?>"  />
<?php ;else: ?>
	<div>
			<?php echo form_label('Title', 'pm_title'); ?> <span class="required">*</span>
			<input id="pm_title" type="text" name="pm_title"  value="<?php echo set_value('pm_title', isset($messages['pm_title']) ? $messages['pm_title'] : ''); ?>"  />
	</div>
<?php endif; ?>

<div>
        <?php echo form_label('Message', 'pm_message'); ?> <span class="required">*</span>
	<?php echo form_textarea( array( 'name' => 'pm_message', 'rows' => '5', 'cols' => '80', 'value' => set_value('pm_message', isset($messages['pm_message']) ? $messages['pm_message'] : '') ) )?>
</div>

	<div class="text-right">
		<br/>
		<input type="submit" name="submit" value="Create messages" /> or <?php echo anchor('admin/messages/messages', lang('messages_cancel')); ?>
	</div>