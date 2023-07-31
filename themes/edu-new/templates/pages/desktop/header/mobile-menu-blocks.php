<div class="header-menu-mobile">
  <div class="main-menu">
    <!-- Main menu left -->
    <ul>
      <?php wp_nav_menu(array(
        'theme_location' => 'menu_mobile',
        'menu_class' => '',
        'container' => false,
        'items_wrap' => '%3$s'
      ));
      ?>
    </ul>
  </div>
</div>