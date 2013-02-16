<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/content/teamspeakviever') ?>" id="list"><?php echo lang('teamspeakviever_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('TeamspeakViever.Content.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/content/teamspeakviever/create') ?>" id="create_new"><?php echo lang('teamspeakviever_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>