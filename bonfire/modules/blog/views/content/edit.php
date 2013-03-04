
<?php if (validation_errors()) : ?>
<div class="alert alert-block alert-error fade in ">
  <a class="close" data-dismiss="alert">&times;</a>
  <h4 class="alert-heading">Please fix the following errors :</h4>
 <?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs
if( isset($blog) ) {
    $blog = (array)$blog;
}
$id = isset($blog['post_id']) ? $blog['post_id'] : '';
?>
<div class="admin-box">
    <h3>blog</h3>
<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <fieldset>
        <div class="control-group <?php echo form_error('blog_title') ? 'error' : ''; ?>">
            <?php echo form_label('Title'. lang('bf_form_label_required'), 'blog_title', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="blog_title" type="text" name="blog_title" maxlength="255" value="<?php echo set_value('blog_title', isset($blog['blog_title']) ? $blog['blog_title'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('blog_title'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('blog_slug') ? 'error' : ''; ?>">
            <?php echo form_label('Slug'. lang('bf_form_label_required'), 'blog_slug', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="blog_slug" type="text" name="blog_slug" maxlength="255" value="<?php echo set_value('blog_slug', isset($blog['blog_slug']) ? $blog['blog_slug'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('blog_slug'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('blog_body') ? 'error' : ''; ?>">
            <?php echo form_label('Text'. lang('bf_form_label_required'), 'blog_body', array('class' => "control-label") ); ?>
            <div class='controls'>
            <?php echo form_textarea( array( 'name' => 'blog_body', 'id' => 'blog_body', 'rows' => '5', 'cols' => '80', 'value' => set_value('blog_body', isset($blog['blog_body']) ? $blog['blog_body'] : '') ) )?>
            <span class="help-inline"><?php echo form_error('blog_body'); ?></span>
        </div>

        </div>



        <div class="form-actions">
            <br/>
            <input type="submit" name="save" class="btn btn-primary" value="Edit blog" />
            or <?php echo anchor(SITE_AREA .'/content/blog', lang('blog_cancel'), 'class="btn btn-warning"'); ?>
            

    <?php if ($this->auth->has_permission('Blog.Content.Delete')) : ?>

            or <button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php echo lang('blog_delete_confirm'); ?>')">
            <i class="icon-trash icon-white">&nbsp;</i>&nbsp;<?php echo lang('blog_delete_record'); ?>
            </button>

    <?php endif; ?>


        </div>
    </fieldset>
    <?php echo form_close(); ?>


</div>
