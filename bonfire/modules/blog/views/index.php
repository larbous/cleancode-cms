<div>
	<h2 class="page-header">Blog</h2>
</div>

<?php if (isset($posts) && is_array($posts) && count($posts)) :?>
 
    <?php foreach ($posts as $post) :?>
    <div class="news_body well well-large">
        <h2><?php e($post->blog_title) ?></h2>
 
        <?php echo $post->blog_body ?>
    </div>
    <?php endforeach; ?>
 
<?php else : ?>
    <div class="alert alert-info">
        No Posts were found.
    </div>
<?php endif; ?>