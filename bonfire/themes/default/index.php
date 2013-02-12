<?php echo theme_view('parts/_header'); ?>

<div class="container body narrow-body"> <!-- Start of Main Container -->
<?php

	echo Template::message();
	echo isset($content) ? $content : Template::yield();
?>

</div><!--/.container-->
<?php echo theme_view('parts/_footer'); ?>
