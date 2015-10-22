<?php
/**
 * The default template for displaying content error. Used for both single and index/archive/search.
 *
 * @package StylishThemes
 * @subpackage Zen7
 * @since Zen7 1.0.0
 */
$has_widgets = Zen_Blog_Shortcode::get_instance()->has_widgets;
?>

<div class="blog-post-min clearfix fadeInUp">
    <div class="<?php if ($has_widgets) {echo 'col-sm-1-5';} else {echo 'col-sm-1';} ?> row-left">

    </div>
    <div class="<?php if ($has_widgets) {echo 'col-sm-11-5';} else {echo 'col-sm-11';} ?> row-right">
        <div class="alert alert-warning fade in">
            <div class="icon-alert"></div>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php _e('No posts found. Sorry! :(', 'zen7'); ?>
        </div>
    </div>
</div>