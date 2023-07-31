<div class="sidebar-highlight-news mb-4">
    <div class="sidebar-highlight-news__title">
        Có thể bạn quan tâm
    </div>
    <div class="sidebar-highlight-news__content">
        <?php
        $args = array(
            'posts_per_page' => 5,
            'orderby' => 'rand',
            'order' => 'DESC',
        );
        $myposts = get_posts($args);
        foreach ($myposts as $post) : setup_postdata($post);
        ?>
            <div class="item">
                <div class="row">
                    <div class="col-4">
                        <div class="thumb"><img src="<?php the_post_thumbnail_url('full'); ?>" alt="img"></div>
                    </div>
                    <div class="col-8">
                        <div class="title">
                            <a href="<?php the_permalink(); ?>">
                                <h6 class="line-2"><?php the_title(); ?></h6>
                            </a>
                            <span class="date"><i class="fal fa-calendar-alt"></i>
                                <?php echo get_the_date("d/m/Y") ?></span>
                        </div>

                    </div>
                </div>
            </div>
        <?php endforeach;
        wp_reset_postdata(); ?>
    </div>
</div>