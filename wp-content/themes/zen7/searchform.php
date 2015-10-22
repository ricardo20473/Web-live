<form action="<?php echo home_url( '/' ); ?>" method="get" class="search-sidebar clearfix">

    <input name="s" id="s" type="text" placeholder="<?php _e('Search...','zen7'); ?>" value="">

    <?php if ( defined('ICL_LANGUAGE_CODE') ) : ?>
        <input type="hidden" name="lang" value="<?php echo(ICL_LANGUAGE_CODE); ?>" />
    <?php endif; ?>

</form>