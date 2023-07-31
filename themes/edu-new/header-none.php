<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="wrapper">
 *
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport"
        content="width=device-width, height=device-height, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" />
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="wrapper" class="site wrapper">
        <script>
        var course_id = '<?= get_the_ID() ?>';
        </script>
        <?php get_template_part('templates/block/desktop/notification', 'blocks' , array('type' => 'success')); ?>
        <?php get_template_part('templates/block/desktop/popup', 'blocks'); ?>