<div class="admin-box">
	<h3>Blog</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<?php if ($this->auth->has_permission('Blog.Settings.Delete') && isset($records) && is_array($records) && count($records)) : ?>
					<th class="column-check"><input class="check-all" type="checkbox" /></th>
					<?php endif;?>
					
					<th>Title</th>
					<th>slug</th>
					<th>body</th>
					<th>created_on</th>
					<th>modified_on</th>
					<th>deleted</th>
				</tr>
			</thead>
			<?php if (isset($records) && is_array($records) && count($records)) : ?>
			<tfoot>
				<?php if ($this->auth->has_permission('Blog.Settings.Delete')) : ?>
				<tr>
					<td colspan="7">
						<?php echo lang('bf_with_selected') ?>
						<input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete') ?>" onclick="return confirm('<?php echo lang('blog_delete_confirm'); ?>')">
					</td>
				</tr>
				<?php endif;?>
			</tfoot>
			<?php endif; ?>
			<tbody>
			<?php if (isset($records) && is_array($records) && count($records)) : ?>
			<?php foreach ($records as $record) : ?>
				<tr>
					<?php if ($this->auth->has_permission('Blog.Settings.Delete')) : ?>
					<td><input type="checkbox" name="checked[]" value="<?php echo $record->id ?>" /></td>
					<?php endif;?>
					
				<?php if ($this->auth->has_permission('Blog.Settings.Edit')) : ?>
				<td><?php echo anchor(SITE_AREA .'/settings/blog/edit/'. $record->id, '<i class="icon-pencil">&nbsp;</i>' .  $record->blog_title) ?></td>
				<?php else: ?>
				<td><?php echo $record->blog_title ?></td>
				<?php endif; ?>
			
				<td><?php echo $record->blog_slug?></td>
				<td><?php echo $record->blog_body?></td>
				<td><?php echo $record->blog_created_on?></td>
				<td><?php echo $record->blog_modified_on?></td>
				<td><?php echo $record->blog_deleted?></td>
				</tr>
			<?php endforeach; ?>
			<?php else: ?>
				<tr>
					<td colspan="7">No records found that match your selection.</td>
				</tr>
			<?php endif; ?>
			</tbody>
		</table>
	<?php echo form_close(); ?>
</div>