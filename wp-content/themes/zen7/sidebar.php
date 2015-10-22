<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('main-sidebar')) : ?>

    <div class="widget fadeInUp">

        <?php get_search_form(); ?>

    </div>

<?php endif; ?>