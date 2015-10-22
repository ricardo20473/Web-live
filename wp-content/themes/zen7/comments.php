<?php

/***********************************************************************************************/
/* Prevent the direct loading of comments.php */
/***********************************************************************************************/
if (!empty($_SERVER['SCRIPT-FILENAME']) && basename($_SERVER['SCRIPT-FILENAME']) == 'comments.php') {
    die(__('You cannot access this page directly.', 'zen7'));
}

/***********************************************************************************************/
/* If the post is password protected then display text and return */
/***********************************************************************************************/
if (post_password_required()) : ?>
    <p>
        <?php
        _e( 'This post is password protected. Enter the password to view the comments.', 'zen7');
        return;
        ?>
    </p>

<?php endif;

/***********************************************************************************************/
/* If we have comments to display, we display them */
/***********************************************************************************************/
if (have_comments()) : ?>
    <a href="#respond" class="article-add-comment"></a>
    <h1 class="title-comments">
        <?php comments_number(__('No thoughts on', 'zen7'), __('One thought on', 'zen7'), __('% thoughts on', 'zen7')); ?>
        <span class="blue">"<?php the_title(); ?>"</span>
    </h1>

    <ul class="comments">
        <?php wp_list_comments('callback=zen_comments'); ?>
    </ul>

    <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>

        <div class="comment-nav-section clearfix">

            <p class="fl"><?php previous_comments_link(__( '&larr; Older Comments', 'zen7')); ?></p>
            <p class="fr"><?php next_comments_link(__( 'Newer Comments &rarr;', 'zen7')); ?></p>

        </div> <!-- end comment-nav-section -->

    <?php endif; ?>

<?php
/***********************************************************************************************/
/* If we don't have comments and the comments are closed, display a text */
/***********************************************************************************************/

elseif (!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>

<?php endif;

/***********************************************************************************************/
/* Display the comment form */
/***********************************************************************************************/
comment_form();

?>