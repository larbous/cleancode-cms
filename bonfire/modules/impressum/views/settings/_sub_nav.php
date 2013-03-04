<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/settings/impressum') ?>" id="list"><?php echo lang('impressum_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Impressum.Settings.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/settings/impressum/create') ?>" id="create_new"><?php echo lang('impressum_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>