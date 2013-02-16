<div>
	<h1 class="page-header">Blog</h1>
</div>

<br />
<?php if (isset($records) && is_array($records) && count($records)) : ?>
 
    <?php foreach ($records as $post) :?>
    <div class="post">
        <h2><?php e($post->blog_title) ?></h2>
 
        <?php echo ($post->blog_body) ?>
    </div>
    <?php endforeach; ?>
 
<?php else : ?>
    <div class="alert alert-info">
        No Posts were found.
    </div>
<?php endif; ?>