<?php
/*
* Create variable custome fields loop.
*
*/
$pageID = get_option('page_on_front');
$arr_metakey = array(
  'host_event',
);
foreach ($arr_metakey as $key => $metakey) :
  $$metakey = get_field($metakey, $pageID);
endforeach;
?>
<div class="three-area-tab-wrapper mb-24">
    <div id="candidates-place" class="row row-cols-lg-4 row-cols-md-3 row-cols-1 g-lg-4 g-3">
        <?php
        $args = array(
          'post_type'         => 'ung-cu-vien',
          "orderby"        => "date",
          "order"          => "DESC",
          'posts_per_page'     => 12,
        );
        $wp_query = new WP_Query($args);
        ?>
        <?php if ($wp_query->have_posts()) while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
        <div class="col">
            <!-- param 'hori' switch horizontal layout -->
            <?php get_template_part('templates/block/desktop/candidate-blocks', 'none'); ?>
        </div>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    </div>
</div>