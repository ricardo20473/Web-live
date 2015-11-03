<?php
/* Template Name: Contact Style 2 */

add_action('wp_enqueue_scripts', 'zen_maps_enqueue', 15);

global $zen7_data;

// Function for email address validation
function isEmail($verify_email) {

    return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|me|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i",$verify_email));

}

$error_name = false;
$error_email = false;
$error_message = false;

if (isset($_POST['contact_submit'])) {

    // Initialize the variables
    $name = '';
    $email = '';
    $url = '';
    $message = '';
    $website = '';
    $receiver_email = '';

    // Get the name
    if (trim($_POST['contact_name']) === '') {
        $error_name = true;
    } else {
        $name = trim($_POST['contact_name']);
    }

    // Get the email
    if (trim($_POST['contact_email']) === '' || !isEmail($_POST['contact_email'])) {
        $error_email = true;
    } else {
        $email = trim($_POST['contact_email']);
    }

    // Get the message
    if (trim($_POST['contact_message']) === '') {
        $error_message = true;
    } else {
        $message = stripslashes(trim($_POST['contact_message']));
    }

    // Get the url
    if (trim($_POST['contact_url']) === '') {
        $error_website = true;
    } else {
        $website = stripslashes(trim($_POST['contact_url']));
    }

    // Check if we have errors
    if (!$error_name && !$error_email && !$error_message) {

        // Get the receiver email from the backend
        $receiver_email = $zen7_data['contact-email'];

        // If none is specified, get the WP admin email
        if (!isset($receiver_email) || $receiver_email == '') {
            $receiver_email = get_option('admin_email');
        }

        $subject = $name;
        $body .= $message . PHP_EOL . PHP_EOL;
        $body .= "You can contact $name via email at $email";
        if ($website != '') { $body .= " and website $website"; }
        $body .= PHP_EOL . PHP_EOL;

        $headers = "From: $email" . PHP_EOL;
        $headers .= "Reply-To: $email" . PHP_EOL;
        $headers .= "MIME-Version: 1.0" . PHP_EOL;
        $headers .='X-Mailer: PHP/' . phpversion() . PHP_EOL;
        $headers .= "Content-type: text/plain; charset=utf-8" . PHP_EOL;
        $headers .= "Content-Transfer-Encoding: quoted-printable" . PHP_EOL;

        if (mail($receiver_email, $subject, $body, $headers)) {
            $email_sent = true;
        } else {
            $email_sent_error = true;
        }
    }
}

$prefix = 'zen_';

if ( function_exists( 'rwmb_meta' ) ) {

    $option = rwmb_meta( "{$prefix}page_sidebar" );

    if( $option == 'none' ) {
        $has_widget = false;
        $content_class = 'col-sm-12';
    } else {
        $has_widget = true;
        $content_class = 'col-sm-9';
    }

} else {

    $content_class = 'col-sm-9';
    $has_widget = true;

}

get_header(); ?>

<?php do_action('zen_before_content'); ?>

<?php while ( have_posts() ) : the_post(); ?>

    <?php mva_maps_show_map_sec(get_the_ID(), $zen7_data['contact-address']); ?>

    <div class="container container-m-tb">
        <div class="<?php echo $content_class; ?>">
            <div class="contact-form">
                <?php if(isset($email_sent_error) && $email_sent_error == true) { //If errors are found ?>
                    <div class="alert alert-warning fade in">
                        <div class="icon-alert"></div>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php _e('Please check if you\'ve filled all the fields with valid information and try again. Thank you.','zen7'); ?>
                    </div>
                <?php } ?>

                <?php if(isset($email_sent) && $email_sent == true) { //If email is sent ?>
                    <div class="alert alert-success fade in">
                        <div class="icon-alert"></div>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php _e('Message Successfully Sent!','zen7'); ?>
                    </div>
                <?php } ?>
                <!-- Start Single Content -->
                <?php the_content(); ?>
                <!-- End Single Content -->
                <div class="comment-respond">
                    <form action="<?php the_permalink(); ?>" method="post" class="comment-form">
                        <textarea name="contact_message" id="contact_message" placeholder="<?php _e('Escriba su mensaje aquí *','zen7'); ?>"><?php if (isset($_POST['contact_message'])) echo stripslashes($_POST['contact_message']); ?></textarea>
                        <ul class="comment-form-inputs">
                            <li>
                                <input id="contact_name" name="contact_name" type="text" value="<?php if (isset($_POST['contact_name'])) echo $_POST['contact_name']; ?>" aria-required="true" placeholder="<?php _e('Su nombre completo *','zen7'); ?>">
                            </li>
                            <li>
                                <input id="contact_email" name="contact_email" type="text" value="<?php if (isset($_POST['contact_email'])) echo $_POST['contact_email']; ?>" aria-required="true" placeholder="<?php _e('E-mail *','zen7'); ?>">
                            </li>
                            <li>
                                <input id="contact_url" name="contact_url" type="text" value="<?php if (isset($_POST['contact_url'])) echo $_POST['contact_url']; ?>" placeholder="<?php _e('Website','zen7'); ?>">
                            </li>
                        </ul>
                        <div class="clear"></div>
                        <p class="form-submit">
                            <input type="hidden" id="contact_submit" name="contact_submit" value="true" />
                            <input name="submit" type="submit" id="submit" value="<?php _e('Enviar','zen7'); ?>">
                        </p>
                    </form>
                </div>
            </div>
        </div>


        <!-- WIDGETS SIDEBAR -->
        <?php if ( $has_widget ) : ?>
            <!-- Widgets Sidebar Container -->
            <div class="col-sm-3">

                <?php get_sidebar('contact-sidebar'); ?>

            </div>
            <!-- End Widgets Sidebar Container -->
        <?php endif; ?>
    </div>


<?php endwhile; ?>

<?php get_footer(); ?>