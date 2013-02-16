
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
$id = isset($blog['id']) ? $blog['id'] : '';
?>
<div class="admin-box">
    <h3>Blog</h3>
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
            <?php echo form_label('slug'. lang('bf_form_label_required'), 'blog_slug', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="blog_slug" type="text" name="blog_slug" maxlength="255" value="<?php echo set_value('blog_slug', isset($blog['blog_slug']) ? $blog['blog_slug'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('blog_slug'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('blog_body') ? 'error' : ''; ?>">
            <?php echo form_label('body'. lang('bf_form_label_required'), 'blog_body', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="blog_body" type="text" name="blog_body"  value="<?php echo set_value('blog_body', isset($blog['blog_body']) ? $blog['blog_body'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('blog_body'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('blog_created_on') ? 'error' : ''; ?>">
            <?php echo form_label('created_on'. lang('bf_form_label_required'), 'blog_created_on', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="blog_created_on" type="text" name="blog_created_on"  value="<?php echo set_value('blog_created_on', isset($blog['blog_created_on']) ? $blog['blog_created_on'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('blog_created_on'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('blog_modified_on') ? 'error' : ''; ?>">
            <?php echo form_label('modified_on', 'blog_modified_on', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="blog_modified_on" type="text" name="blog_modified_on"  value="<?php echo set_value('blog_modified_on', isset($blog['blog_modified_on']) ? $blog['blog_modified_on'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('blog_modified_on'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('blog_deleted') ? 'error' : ''; ?>">
            <?php echo form_label('deleted', 'blog_deleted', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="blog_deleted" type="text" name="blog_deleted" maxlength="0" value="<?php echo set_value('blog_deleted', isset($blog['blog_deleted']) ? $blog['blog_deleted'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('blog_deleted'); ?></span>
        </div>


        </div>



        <div class="form-actions">
            <br/>
            <input type="submit" name="save" class="btn btn-primary" value="Create Blog" />
            or <?php echo anchor(SITE_AREA .'/settings/blog', lang('blog_cancel'), 'class="btn btn-warning"'); ?>
            
        </div>
    </fieldset>
    <?php echo form_close(); ?>


</div>
