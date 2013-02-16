<div>
	<h3 class="page-header">TeamspeakViewer</h3>
	<?php if (isset($tsserver) && is_array($tsserver) && count($tsserver)) : ?>
			<?php if(!preg_match('/Socket error:/',$tsserver[0])) : ?>
				<?php foreach ($tsserver as $record) : ?>
					<?php $record = (array)$record;?>
					<?php foreach($record as $field => $value) : ?>
						<?php if ($field != 'id') : ?>
							<?php echo ($field == 'deleted') ? (($value > 0) ? lang('teamspeakviever_true') : lang('teamspeakviever_false')) : $value; ?>
						<?php endif; ?>
					<?php endforeach; ?>
				<?php endforeach; ?>
			<?php endif;?>
	<?php endif; ?>
</div>
