<?php
/************************************************************/
/* This is the main footer of the Zen7. It will be used for all pages. */
/************************************************************/
?>
<?php global $zen7_data; ?>

    <!-- FOOTER -->
    <div class="container-m-tb footer">

        <div class="top-footer clearfix">

            <div class="container">

                <?php if($zen7_data['zen_footer_widget']) : ?>
                    <div class="col-md-3">
                        <div class="widget_text">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                <img src="<?php echo $zen7_data['zen_logo']['url']; ?>" alt="logo">
                            </a>
                            <p>
                                <?php echo $zen7_data['zen_footer_widget_text']; ?>
                            </p>
                        </div>
                    </div>
                <?php endif; ?>

                <?php get_sidebar('footer-sidebar'); ?>

            </div>

        </div>

        <div class="bottom-footer">

            <div class="container">

                <div class="col-md-3">

                    <div class="copy">

                        <?php echo $zen7_data['zen_footer_copy']; ?>

                    </div>

                </div>

                <div class="col-md-3 col-md-offset-6 footer-social">

                    <nav class="social">

                        <?php zen_socials_top_bottom(); ?>

                    </nav>

                </div>

            </div>

        </div>

    </div>
    <!-- END FOOTER -->

    <a href="#" class="btn back-to-top">
        <span></span>
    </a>

    <?php if (isset($zen7_data) && $zen7_data['zen_scrollbar_type'] == '2' ) : ?>
        <?php wp_enqueue_script('no-scrollbar', THEMEROOT . '/assets/js/disableFancy.js', array(), '1.0', true); ?>
    <?php endif; ?>

    <?php wp_footer(); ?>

</body>
</html>