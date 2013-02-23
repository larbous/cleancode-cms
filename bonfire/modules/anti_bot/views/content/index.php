<div class="admin-box">
	<h3>Anti-Bot</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<?php if ($this->auth->has_permission('Anti_Bot.Content.Delete') && isset($records) && is_array($records) && count($records)) : ?>
					<th class="column-check"><input class="check-all" type="checkbox" /></th>
					<?php endif;?>
					
					<th>IP</th>
					<th>UserAgent</th>
					<th>date</th>
				</tr>
			</thead>
			<?php if (isset($records) && is_array($records) && count($records)) : ?>
			<tfoot>
				<?php if ($this->auth->has_permission('Anti_Bot.Content.Delete')) : ?>
				<tr>
					<td colspan="4">
						<?php echo lang('bf_with_selected') ?>
						<!-- <input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete') ?>" onclick="return confirm('<?php echo lang('anti_bot_delete_confirm'); ?>')">-->
					</td>
				</tr>
				<?php endif;?>
			</tfoot>
			<?php endif; ?>
			<tbody>
			<?php if (isset($records) && is_array($records) && count($records)) : ?>
			<?php foreach ($records as $record) : ?>
				<tr>
					<?php if ($this->auth->has_permission('Anti_Bot.Content.Delete')) : ?>
					<!--  <td><input type="checkbox" name="checked[]" value="<?php //echo $record->id ?>" /></td>-->
					<?php endif;?>
					
				<?php //if ($this->auth->has_permission('Anti_Bot.Content.Edit')) : ?>
				<!--  <td><?php //echo anchor(SITE_AREA .'/content/anti_bot/edit/'. $record->id, '<i class="icon-pencil">&nbsp;</i>' .  $record->anti_bot_IP) ?></td>-->
				<?php //else: ?>
				<td><?php echo $record->anti_bot_IP ?></td>
				<?php //endif; ?>
			
				<td><?php echo $record->anti_bot_useragent?></td>
				<td><?php echo $record->anti_bot_date?></td>
				</tr>
			<?php endforeach; ?>
			<?php else: ?>
				<tr>
					<td colspan="4">No records found that match your selection.</td>
				</tr>
			<?php endif; ?>
			</tbody>
		</table>
	<?php echo form_close(); ?>
</div>