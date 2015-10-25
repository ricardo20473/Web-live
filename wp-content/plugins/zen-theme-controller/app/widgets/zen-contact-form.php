<?php
/***********************************************************************************************/
/* Widget that displays the contact form */
/***********************************************************************************************/

class Zen_Contact_Form extends WP_Widget {

    public function __construct() {

        parent::__construct(
            'zen_contact_form_w',
            'Zen Contact Form',
            array('description' => __('Displays a contact form in the sidebars.','zen-admin'))
        );

    }

    public function form($instance)  {

        $defaults = array(
            'email_address' => '',
            'title'         => ''
        );

        $instance = wp_parse_args((array) $instance, $defaults);

        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        } else {
            $title = __( 'New title', 'zen-admin' );
        }

        ?>

        <p>
            <i>Insert the email address where the emails will be sent.</i>
        </p>

        <!-- Checkbox for Albums -->
        <p>
            Widget title
            <input type="text" class="widefat" name="<?php echo $this->get_field_name('title'); ?>" id=
            "<?php echo $this->get_field_id('title'); ?>" value="<?php echo $instance['title']; ?>" />
        </p>
        <p>
            Email Address
            <input type="email" class="widefat" name="<?php echo $this->get_field_name('email_address'); ?>" id=
            "<?php echo $this->get_field_id('email_address'); ?>" value="<?php echo $instance['email_address']; ?>" />
        </p>

    <?php

    }

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        // The selected fields
        $instance['email_address'] = strip_tags($new_instance['email_address']);
        $instance['title'] = strip_tags($new_instance['title']);

        return $instance;
    }

    public function widget( $args, $instance ) {
        extract($args);

        echo $before_widget;

        $email_address = '';

        if(isset($instance['email_address'])) { $email_address = $instance['email_address']; }

        $title = ( ! empty( $title ) )
            ? ($args['before_title'] . $title . $args['after_title'])
            : (
                $args['before_title'] .
                    __('Contáctenos', 'zen7') .
                    $args['after_title']);

        echo $title;

        // Function for email address validation
        function isEmailwidget($verify_email) {

            return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|me|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i",$verify_email));

        }

        $error_name_widget = false;
        $error_email_widget = false;
        $error_message_widget = false;

        if (isset($_POST['contact_submit_widget'])) {


            // Initialize the variables
            $name_widget = '';
            $email_widget = '';
            $url_widget = '';
            $message_widget = '';
            $website_widget = '';
            $receiver_email_widget = '';

            // Get the name
            if (trim($_POST['contact_name_widget']) === '') {
                $error_name_widget = true;
            } else {
                $name_widget = trim($_POST['contact_name_widget']);
            }

            // Get the email
            if (trim($_POST['contact_email_widget']) === '' || !isEmailwidget($_POST['contact_email_widget'])) {
                $error_email_widget = true;
            } else {
                $email_widget = trim($_POST['contact_email_widget']);
            }

            // Get the message
            if (trim($_POST['contact_message_widget']) === '') {
                $error_message_widget = true;
            } else {
                $message_widget = stripslashes(trim($_POST['contact_message_widget']));
            }

            // Check if we have errors
            if (!$error_name_widget && !$error_email_widget && !$error_message_widget) {

                // Get the receiver email from the backend
                $receiver_email_widget = $email_address;

                // If none is specified, get the WP admin email
                if (!isset($receiver_email_widget) || $receiver_email_widget == '') {
                    $receiver_email_widget = get_option('admin_email');
                }

                $subject_widget = $name_widget;
                $body_widget = $message_widget . PHP_EOL . PHP_EOL;
                $body_widget .= "You can contact $name_widget via email at $email_widget";
                if ($website_widget != '') { $body_widget .= " and website $website_widget"; }
                $body_widget .= PHP_EOL . PHP_EOL;

                $headers_widget = "From: $email_widget" . PHP_EOL;
                $headers_widget .= "Reply-To: $email_widget" . PHP_EOL;
                $headers_widget .= "MIME-Version: 1.0" . PHP_EOL;
                $headers_widget .='X-Mailer: PHP/' . phpversion() . PHP_EOL;
                $headers_widget .= "Content-type: text/plain; charset=utf-8" . PHP_EOL;
                $headers_widget .= "Content-Transfer-Encoding: quoted-printable" . PHP_EOL;

                if (mail($receiver_email_widget, $subject_widget, $body_widget, $headers_widget)) {
                    $email_sent_widget = true;
                } else {
                    $email_sent_error_widget = true;
                }

            }
        }

        ?>

        <div class="clearfix">
            <?php global $wp;
            $current_url = add_query_arg( $wp->query_string, '', home_url( $wp->request ) ); ?>
            <?php if(isset($email_sent_error_widget) && $email_sent_error_widget == true) { //If errors are found ?>
                <div class="alert alert-warning fade in">
                    <div class="icon-alert"></div>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php _e('Please check if you\'ve filled all the fields with valid information and try again. Thank you.','zen7'); ?>
                </div>
            <?php } ?>

            <?php if(isset($email_sent_widget) && $email_sent_widget == true) { //If email is sent ?>
                <div class="alert alert-success fade in">
                    <div class="icon-alert"></div>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php _e('Message Successfully Sent!','zen7'); ?>
                </div>
            <?php } ?>
            <form action="#" method="post" class="contact-widget">
                <input class="form-control" id="contact_name_widget" name="contact_name_widget" type="text" value="<?php if (isset($_POST['contact_name_widget'])) echo $_POST['contact_name_widget']; ?>" aria-required="true" placeholder="<?php _e('Nombre completo *','zen7'); ?>">
                <input class="form-control" id="contact_email_widget" name="contact_email_widget" type="text" value="<?php if (isset($_POST['contact_email_widget'])) echo $_POST['contact_email_widget']; ?>" aria-required="true" placeholder="<?php _e('E-mail *','zen7'); ?>">
                <textarea class="form-control" rows="4" name="contact_message_widget" id="contact_message_widget" placeholder="<?php _e('Escribe tu mensaje aquí *','zen7'); ?>"><?php if (isset($_POST['contact_message_widget'])) echo stripslashes($_POST['contact_message_widget']); ?></textarea>
                <input type="hidden" id="contact_submit_widget" name="contact_submit_widget" value="true" />
                <input name="submit_widget" class="btn btn-default btn-sm" type="submit" id="submit_widget" value="<?php _e('Enviar','zen7'); ?>">
            </form>
        </div>

        <?php

        echo $after_widget;

    }

}

add_action('widgets_init', 'register_states_widget');
function register_states_widget() {
    register_widget('Zen_Contact_Form');
}

?>