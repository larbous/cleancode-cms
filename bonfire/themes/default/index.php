<?php echo theme_view('parts/_header'); ?>
<div class="container body narrow-body"> <!-- Start of Main Container -->
	<div class="hero-unit">
		<div class="news_row">
			<?php echo Modules::run('news/get_articles',5,0); ?>
		</div>
	</div>
</div><!--/.container-->
<?php echo Modules::run('anti_bot/getAntiBotLink'); ?>
<?php echo theme_view('parts/_footer'); ?>
