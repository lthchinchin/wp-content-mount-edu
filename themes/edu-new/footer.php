<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 */

/**
 * Create variable theme mod.
 *
 */
$arr_keymod = array(
  'html_facebook',
  'html_gmail',
  'html_instagram',
  'html_tiktok',
  'html_youtube',
  'html_twitter',
  'html_adroid_app',
  'html_ios_app',
  'html_footer_background',
  'html_footer_header',
  'html_phone',
  'html_address',
  'html_email',
  'html_bct_logo',
  'html_copyright',
);

foreach ($arr_keymod as $key => $keymod) :
  $$keymod = esc_html(get_theme_mod($keymod));
endforeach;
?>

<footer id="mastfoot" class="site-footer footer">
  <!-- Menu bar main-->
  <?php include(locate_template('templates/pages/desktop/footer/vars-vote-footer-blocks.php')); ?>
</footer>


<?php wp_footer(); ?>

</body>

</html>