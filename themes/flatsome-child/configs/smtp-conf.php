<?php 
add_action( 'phpmailer_init', 'wpse8170_phpmailer_init' );
function wpse8170_phpmailer_init( PHPMailer $phpmailer ) {
    $phpmailer->Host = 'your.smtp.server.here';
    $phpmailer->Port = 25; // could be different
    $phpmailer->Username = 'your_username@example.com'; // if required
    $phpmailer->Password = 'yourpassword'; // if required
    $phpmailer->SMTPAuth = true; // if required
    // $phpmailer->SMTPSecure = 'ssl'; // enable if required, 'tls' is another possible value

    $phpmailer->IsSMTP();
}