<h2><?php echo $record->pm_title; ?></h2>
<span>
	<a href="<?php echo site_url('users/profile/'.$record->id); ?>" title="<?php echo $record->username; ?>"><?php echo $record->username; ?></a>
	 - <?php echo $record->created_on; ?>
</span>

<article>
	<?php echo nl2br($record->pm_message); ?>
</article>

<nav>
	<ul>
		<li>
			<a href="<?php echo site_url('messages/send/'.$record->id.'/'.$record->pm_id); ?>" title=""><?php echo lang('reply'); ?></a>
		</li>
		<li>
			<a href="<?php echo site_url('messages/delete/'.$record->pm_id); ?>" title="Delete message"><?php echo lang('delete'); ?></a>
		</li>
	</ul>
</nav>

<style>
ul, li{ 
	padding:0; margin: 0;
	list-style: none;
}
ul{
	overflow: hidden;
}
ul li{
	float: left;
	margin-right: 10px;
}
nav a{ font-size: 8pt; }
</style>