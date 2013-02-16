<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/settings/blog') ?>" id="list"><?php echo lang('blog_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Blog.Settings.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/settings/blog/create') ?>" id="create_new"><?php echo lang('blog_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>