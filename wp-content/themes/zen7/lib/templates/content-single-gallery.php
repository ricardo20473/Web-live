<?php
/**
 * Display a single post.
 *
 * @since 1.0.0
 *
 */
?>

<?php
$classes = array('post-container', 'post-container-single');
$meta_bottom_style = 'style="margin-bottom: -20px; margin-top:40px;"';
$zen_post_class = '';
?>

<div id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>

    <?php $zen_post_class = 'no_featured_image'; ?>

    <div class="<?php echo $zen_post_class; ?> content-post-blog fadeInUp">

        <?php if ( zen_is_title_active() ) : ?>
            <?php if ( is_single() ) : ?>

                <h1 class="title-post"><?php the_title(); ?></h1>

            <?php else : ?>

                <a href="<?php the_permalink(); ?>" class="title-post"><?php the_title(); ?></a>

            <?php endif; ?>
        <?php endif; ?>

        <?php the_content(); ?>

        <!-- Displaying post pagination links in case we have multiple page posts -->
        <?php zen_single_post_pagination(); ?>

        <h2 <?php echo $meta_bottom_style; ?>><?php zen_entry_meta(); ?><?php zen_comments_information(); ?> <?php zen_edit_link(); ?></h2>
        <?php zen_entry_tags(); ?>

    </div>

</div>

