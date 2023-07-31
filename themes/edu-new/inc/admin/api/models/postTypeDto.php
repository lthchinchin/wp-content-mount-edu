<?php
class postTypeDto
{
    public $post_title;
    public $post_content;

    public $post_type;
    public $limit;
    public $page;
    public $offset;
    public $orderby;
    public $cat_id;
    public $tax_slug;
    
    function __construct($objPostType) {

        $this->post_title = isset($objPostType['post_title']) && $objPostType['post_title'] ? $objPostType['post_title'] : '';
        $this->post_content = isset($objPostType['post_content']) && $objPostType['post_content'] ? $objPostType['post_content'] : '';
        $this->post_status = isset($objPostType['post_status']) && $objPostType['post_status'] ? $objPostType['post_status'] : 'pending';

        $this->post_type = isset($objPostType['post_type']) && $objPostType['post_type'] ? $objPostType['post_type'] : 'post';
        $this->limit      = isset($objPostType['limit']) && $objPostType['limit'] ? $objPostType['limit'] : 10;
        $this->page       = isset($objPostType['page']) && $objPostType['page'] > 1 ? $objPostType['page'] : 1;
        $this->offset     = (ceil($this->page) - 1) * $this->limit;
        $this->orderby    = isset($objPostType['orderby']) && $objPostType['orderby'] ? $objPostType['orderby'] : 'newest';
        $this->cat_id     = isset($objPostType['cat_id']) && $objPostType['cat_id'] ? $objPostType['cat_id'] : '';
        $this->tax_slug     = isset($objPostType['tax_slug']) && $objPostType['tax_slug'] ? $objPostType['tax_slug'] : '';
        $this->s     = isset($objPostType['s']) && $objPostType['s'] ? $objPostType['s'] : '';

        $this->post_in  = isset($objPostType['post_in']) && $objPostType['post_in'] ? $objPostType['post_in'] : [];
        $this->post_author = isset($objPostType['post_author']) && $objPostType['post_author'] ? $objPostType['post_author'] : 1;

        $userInfoFromCMS = SSOHelper::getLoggedInData();
        $userId = $userInfoFromCMS ? get_user_by('login', $userInfoFromCMS->phone)->ID : null;
        $this->userid = isset($userId) && $userId ? $userId : null;
    }

    function insert_post() {
        $my_post = array(
            'post_title'  => $this->post_title,
            'post_content' =>  $this->post_content,
            'post_type' => $this->post_type,
            'post_status' => $this->post_status,
            'post_author' => $this->post_author,
        );
    
        $post_id = wp_insert_post( $my_post );
        return $post_id;
    }

    function get_all_post() {

        $cat_args = null;

        if (!empty($this->cat_id) && !empty($this->tax_slug)) {
            $cat_args = array(
                'taxonomy'  => $this->tax_slug,
                'field'     => 'slug',
                'terms'     => $this->cat_id,
            );
        }

        $args = array(
            'post_type' => $this->post_type,
            'tax_query'        => array(
                $cat_args
            ),
            'posts_per_page' => $this->limit,
            'offset'           => $this->offset,
            'orderby' => 'date',
            'order' => 'DESC',
            's' => $this->s,
            'post__in' => $this->post_in

        );

        $getposts = new WP_Query($args);
        $data = $getposts->posts;
        
        $total_items = $getposts->found_posts;
        $total_pages = ceil($total_items / $this->limit);

        $response = array(
            'status'         => 200,
            'data'         => $data,
            'limit'        => (int) $this->limit,
            'current_page' => (int) $this->page,
            'total_items'  => (int) $total_items,
            'total_pages'  => (int) $total_pages
        );

        return $response;
    }



}