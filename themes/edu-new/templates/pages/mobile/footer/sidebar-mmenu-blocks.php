<nav id="mobile_menu" class="d-lg-none">
    <?php
    $primarymenu = array(
        'theme_location'  => 'menu_mobile',
        'menu_class'      => 'slimmenu',
        'menu_id'         => 'mobile-menu',
        'echo'            => true,
        'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
        'walker'          => new wp_bootstrap_navwalker(),
        'items_wrap'      => '<ul data-breakpoint="800" id="%1$s" class="main-menu-mobile">%3$s</ul>',
        'depth'           => 0,
    );
    if (has_nav_menu('primary')) {
        wp_nav_menu($primarymenu);
    }
    ?>
</nav>