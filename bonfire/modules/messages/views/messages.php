<div class="view split-view">
	<!-- Role Editor -->
	<div id="content" class="view">
		<div class="scrollable" id="ajax-content">
		
				<h2><?php echo (isset($inbox)) ? lang('inbox') : lang('outbox'); ?></h2>
				
				<?php echo form_open(site_url('messages/delete')); ?>
				<?php if (isset($records) && is_array($records) && count($records)) : ?>
					<table>
						<thead>
						<th class="column-check"><input class="check-all" type="checkbox" /></th>
						<th><?php echo lang('sender'); ?></th>
						<th><?php echo lang('title'); ?></th>
						<th><?php echo lang('date'); ?></th>
						</thead>
						<tbody>
							<?php
							foreach ($records as $record) : ?>
								<tr>
									<td><input type="checkbox" name="checked[]" value="<?php echo $record->pm_id; ?>"></td>
									<td>
										<a href="<?php echo site_url('users/profile/'.$record->id); ?>" title="<?php echo $record->username; ?>">
											<?php echo $record->username; ?>
										</a>
									</td>
									<td>
										<a href="<?php echo site_url('messages/read/'.$record->pm_id); ?>" title="<?php echo $record->pm_title; ?>">
											<?php echo $record->pm_title; ?>
										</a>
									</td>
									<td><?php echo $record->created_on; ?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					
				<?php ;else: ?>
					<?php echo lang('messages_no_records'); ?>
				<?php endif; ?>
				
				<input type="submit" name="delete_checked" value="<?php echo lang('delete'); ?>" class="button">
				<?php echo form_close(); ?>
				
		</div>	<!-- /ajax-content -->
	</div>	<!-- /content -->
</div>
