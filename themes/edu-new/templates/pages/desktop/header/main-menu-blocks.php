<div class="header-menu-wrap">
    <div class="absolute-logo">
        <img src="<?= TEMPLATE_DIR ?>/assets/images/header/top10-vars-vote-logo-img.png">
    </div>
    <div class="main-menu">
    <!-- Open mobile menu -->
        <a id="mobile-menu-button" href="#mobile_menu" class="icon-navbar">
            <div class="navbar-open">
                <span class="hamburger open-navbar"></span>
                <span class="icon-close close-navbar"></span>
            </div>
        </a>
    <!-- Main menu left -->
    <?php
    $primarymenu = array(
    'theme_location'  => 'primary',
    'menu_class'      => 'slimmenu',
    'menu_id'         => 'primary-menu',
    'echo'            => true,
    'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
    'walker'          => new wp_bootstrap_navwalker(),
    'items_wrap'      => '<ul data-breakpoint="800" id="%1$s" class="main-menu__left">%3$s</ul>',
    'depth'           => 0,
    );
    if (has_nav_menu('primary')) {
        wp_nav_menu($primarymenu);
    }
    ?>
        <!-- Logo -->
        <div class="main-menu__center">
            <a class="logo" href="<?php echo home_url(); ?>">
                <img src="<?php echo esc_html(get_theme_mod('html_logo_header')); ?>" alt="logo">
            </a>
        </div>
        <!-- Main menu right -->
        <?php
    $secondarymenu = array(
        'theme_location'  => 'secondary',
        'menu_class'      => 'slimmenu',
        'menu_id'         => 'secondary-menu',
        'echo'            => true,
        'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
        'walker'          => new wp_bootstrap_navwalker(),
        'items_wrap'      => '<ul data-breakpoint="800" id="%1$s" class="main-menu__right">%3$s</ul>',
        'depth'           => 0,
    );
    if (has_nav_menu('secondary')) {
        wp_nav_menu($secondarymenu);
    }
    ?>
    <div class="blank-div"></div>
    </div>
</div>