<?php
get_header();
$queried_object = get_queried_object();
global $post;
?>
<?php
      $args = array(
        'posts_per_page'     => -1,
        // 'post_type'          => '',
        'orderby'            => 'date',
        'order'              => 'DESC',
        'paged'             => get_query_var('paged'),
        's'                  => get_search_query()
    );
?>
<?php $getposts = new WP_query($args); ?>
<?php if ($getposts->have_posts()) : ?>
<?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
<?php the_permalink(); ?>
<?php the_post_thumbnail_url('full') ?>
<?php echo get_the_terms(get_the_ID(), 'category')[0]->name; ?>
<?php echo wp_trim_words(get_the_content(), $num_words = 50, $more = null); ?>
<?php the_title(); ?>
<?php endwhile; ?>
<?php wp_reset_postdata(); ?>
<?php endif; ?>
<?php resdii_wp_pagination($getposts, $paged); ?>

<?php get_footer(); ?>