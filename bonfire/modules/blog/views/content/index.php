<div class="admin-box">
	<h3>blog</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<?php if ($this->auth->has_permission('Blog.Content.Delete') && isset($records) && is_array($records) && count($records)) : ?>
					<th class="column-check"><input class="check-all" type="checkbox" /></th>
					<?php endif;?>
					
					<th>Title</th>
					<th>Slug</th>
					<th>Text</th>
					<th>Deleted</th>
					<th>Created</th>
					<th>Modified</th>
				</tr>
			</thead>
			<?php if (isset($records) && is_array($records) && count($records)) : ?>
			<tfoot>
				<?php if ($this->auth->has_permission('Blog.Content.Delete')) : ?>
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
					<?php if ($this->auth->has_permission('Blog.Content.Delete')) : ?>
					<td><input type="checkbox" name="checked[]" value="<?php echo $record->post_id ?>" /></td>
					<?php endif;?>
					
				<?php if ($this->auth->has_permission('Blog.Content.Edit')) : ?>
				<td><?php echo anchor(SITE_AREA .'/content/blog/edit/'. $record->post_id, '<i class="icon-pencil">&nbsp;</i>' .  $record->blog_title) ?></td>
				<?php else: ?>
				<td><?php echo $record->blog_title ?></td>
				<?php endif; ?>
			
				<td><?php echo $record->blog_slug?></td>
				<td><?php echo $record->blog_body?></td>
				<td><?php echo $record->deleted > 0 ? lang('blog_true') : lang('blog_false')?></td>
				<td><?php echo $record->created_on?></td>
				<td><?php echo $record->modified_on?></td>
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