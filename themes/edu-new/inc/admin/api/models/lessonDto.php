<?php
class lessonDto extends postTypeDto
{
    public $lp_duration;
    public $lp_preview;
    public $lp_lesson_id;
    public $course_id;

    function __construct($parameters) {
        parent::__construct($parameters);
        $this->lp_duration = isset($parameters['lp_duration']) && $parameters['lp_duration'] ? $parameters['lp_duration'] : '0 minute';
        $this->lp_preview = isset($parameters['lp_preview']) && $parameters['lp_preview'] ? $parameters['lp_preview'] : 'no';
        $this->lp_lesson_id = isset($parameters['lp_lesson_id']) && $parameters['lp_lesson_id'] ? $parameters['lp_lesson_id'] : null;
        
        $this->course_id = isset($parameters['course_id']) && $parameters['course_id'] ? $parameters['course_id'] : null;
    }

    function get_lessons()
    {
        global $wpdb;
        $tbl_lp_sects = $wpdb->prefix . 'learnpress_sections';
        $tbl_lp_sect_items = $wpdb->prefix . 'learnpress_section_items';
        $arrs = array();

        // $results = $wpdb->get_results( "SELECT `section_id` FROM $tbl_lp_sects WHERE  `section_course_id` = {$this->course_id}" );
        $results = $wpdb->get_results( 
        "SELECT $tbl_lp_sect_items.`item_id`,$tbl_lp_sect_items.`item_type`
        FROM $tbl_lp_sects,$tbl_lp_sect_items 
        WHERE  $tbl_lp_sects.`section_course_id` = {$this->course_id} AND  $tbl_lp_sect_items.`section_id` = $tbl_lp_sects.`section_id` " );
            foreach ($results as $result):
                $result->title = get_the_title($result->item_id);
                $result->content = get_the_content($result->item_id);
                $result->permalink = get_permalink($result->item_id);
                $result->thumbnail = get_field('thumbnail_lesson',$result->item_id)['sizes']['medium'];
                $result->thumbnail_large = get_field('thumbnail_lesson',$result->item_id)['sizes']['large'];
                $result->video = get_field('course_video',$result->item_id);
            endforeach;
        return $results;
    }

    function insert_lesson()
    {
        $id_insert = parent::insert_post();
        if($id_insert):
            update_post_meta($id_insert,'_lp_duration',$this->lp_duration);
            update_post_meta($id_insert,'_lp_preview',$this->lp_preview);
        endif;
        return $id_insert;
    }

    function update_lesson()
    { 
        $data = array(
            'ID' => $this->lp_lesson_id,
            'post_title' => $this->post_title,
            'post_content' => $this->post_content,
           );
        $id_update = wp_update_post( $data );

        if($id_update):
            update_post_meta($id_update,'_lp_duration',$this->lp_duration);
            update_post_meta($id_update,'_lp_preview',$this->lp_preview);
        endif;

        return $id_update;
    }

    function completed_lesson()
    {
        global $wpdb;
        $complete_lesson_tb = $wpdb->prefix . 'learnpress_user_items';
        $returnArr = array();

        // expected user loggin!
        if (!isset($this->userid) || !$this->userid) {
            $returnArr['label'] = "expected user loggin!";
            $returnArr['value'] = false;
            return $returnArr;
        }

        // buy course before active this lesson!
        $isBoughtCourse = (new orderDto(null))->isBoughtCourse($this->userid, $this->course_id);
        if (!$isBoughtCourse) {
            $returnArr['label'] = "buy course before complete this lesson!";
            $returnArr['value'] = false;
            return $returnArr;
        }

        // active course before complete this lesson!
        $isActivedCourse = (new courseDto(null))->isOwnerCourse($this->userid, $this->course_id);
        if (!$isActivedCourse) {
            $returnArr['label'] = "active course before complete this lesson!";
            $returnArr['value'] = false;
            return $returnArr;
        }

        // you are completed!
        $results = $wpdb->get_results("SELECT `user_item_id` FROM `{$complete_lesson_tb}` WHERE `user_id` = $this->userid AND `item_id` = {$this->lp_lesson_id}");
        $user_item_id = $results[0]->user_item_id;
        $is_actived = $user_item_id ? true : false;
        if ($is_actived) {
            $update_data = $wpdb->query($wpdb->prepare("UPDATE $complete_lesson_tb SET `status` = 'completed' WHERE `user_item_id` =  {$user_item_id}"));
            $returnArr['label'] = "you are completed! upd status: $update_data";
            if($update_data){
                $returnArr['value'] = true;
            }else{
                $returnArr['value'] = false;
            }
            return $returnArr;
        }

        $data = array(
            'user_id' => $this->userid,
            'item_id' => $this->lp_lesson_id,
            'start_time' => date('Y-m-d h:i:s'),
            'end_time' => date('Y-m-d h:i:s'),
            'item_type' => 'lp_lesson',
            'status' => 'completed',    
            'graduation' => '',
            'access_level' => 50,
            'ref_type' => 'lp_course',
            'ref_id' => $this->course_id,
            'parent_id' => 0,
        );


        $wpdb->insert($complete_lesson_tb, $data);
        $returnArr['label'] = "success completed lesson!";
        $returnArr['value'] = $wpdb->insert_id;
        return $returnArr;
    }
    
}