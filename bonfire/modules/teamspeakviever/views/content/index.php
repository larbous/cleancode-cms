<div class="admin-box">
	<h3>TeamspeakViever</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<?php if ($this->auth->has_permission('TeamspeakViever.Content.Delete') && isset($records) && is_array($records) && count($records)) : ?>
					<th class="column-check"><input class="check-all" type="checkbox" /></th>
					<?php endif;?>
					
					<th>TeamSpeak IP</th>
					<th>Servername</th>
					<th>Query Port</th>
					<th>Password</th>
					<th>Server ID</th>
				</tr>
			</thead>
			<?php if (isset($records) && is_array($records) && count($records)) : ?>
			<tfoot>
				<?php if ($this->auth->has_permission('TeamspeakViever.Content.Delete')) : ?>
				<tr>
					<td colspan="6">
						<?php echo lang('bf_with_selected') ?>
						<input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete') ?>" onclick="return confirm('<?php echo lang('teamspeakviever_delete_confirm'); ?>')">
					</td>
				</tr>
				<?php endif;?>
			</tfoot>
			<?php endif; ?>
			<tbody>
			<?php if (isset($records) && is_array($records) && count($records)) : ?>
			<?php foreach ($records as $record) : ?>
				<tr>
					<?php if ($this->auth->has_permission('TeamspeakViever.Content.Delete')) : ?>
					<td><input type="checkbox" name="checked[]" value="<?php echo $record->id ?>" /></td>
					<?php endif;?>
					
				<?php if ($this->auth->has_permission('TeamspeakViever.Content.Edit')) : ?>
				<td><?php echo anchor(SITE_AREA .'/content/teamspeakviever/edit/'. $record->id, '<i class="icon-pencil">&nbsp;</i>' .  $record->teamspeakviever_tsip) ?></td>
				<?php else: ?>
				<td><?php echo $record->teamspeakviever_tsip ?></td>
				<?php endif; ?>
			
				<td><?php echo $record->teamspeakviever_servername?></td>
				<td><?php echo $record->teamspeakviever_query_port?></td>
				<td><?php echo $record->teamspeakviever_srvpassword?></td>
				<td><?php echo $record->teamspeakviever_server_id?></td>
				</tr>
			<?php endforeach; ?>
			<?php else: ?>
				<tr>
					<td colspan="6">No records found that match your selection.</td>
				</tr>
			<?php endif; ?>
			</tbody>
		</table>
	<?php echo form_close(); ?>
</div>