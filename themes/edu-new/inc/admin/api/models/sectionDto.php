<?php
class sectionDto
{
    public $section_id;
    public $section_course_id;
    public $sections; /*string json '[{"section_name":"456 Avenue Crt 1","section_description":"53.277720488429026"},{}..]'*/
    public $itemsAddon; /*string json '[{"item_id":"12","item_type":"lp_lesson"},{}..]' section_id */
    
    function __construct($parameters) {
        $this->section_id = isset($parameters['section_id']) && $parameters['section_id'] ? $parameters['section_id'] : null;
        $this->sections =  isset($parameters['sections']) && $parameters['sections'] ? $parameters['sections'] : "";
        $this->section_course_id = isset($parameters['section_course_id']) && $parameters['section_course_id'] ? $parameters['section_course_id'] : null;
        $this->itemsAddon =  isset($parameters['itemsAddon']) && $parameters['itemsAddon'] ? $parameters['itemsAddon'] : "";
        
        $userInfoFromCMS = SSOHelper::getLoggedInData();
        $userId = $userInfoFromCMS ? get_user_by('login', $userInfoFromCMS->phone)->ID : null;
        $this->userID = $userId;
    }

    function insert_section() {
        global $wpdb;
        $table = $wpdb->prefix . 'learnpress_sections';
        $arrs = array();
        
        $results = $wpdb->get_results( "SELECT `section_order` FROM $table WHERE  `section_course_id` = {$this->section_course_id} ORDER BY `section_id` DESC LIMIT 1" );
        $currentKeySection = $results[0]->section_order; 

        foreach ($this->sections as $section) {
            $currentKeySection++;
            $data = array(
                'section_name' => $section['section_name'],
                'section_description' => $section['section_description'],
                'section_course_id' => $this->section_course_id,
                'section_order' => $currentKeySection
            );
            array_push($arrs,$wpdb->insert($table,$data));
          }
        return $arrs;
    }

    function get_lessons_quizs_by_section_id($sect_id) {
        global $wpdb;
        $table = $wpdb->prefix . 'learnpress_sections';
        $arrs = array();
        
        $results = $wpdb->get_results( "SELECT `section_id`,`section_name` FROM $table WHERE  `section_course_id` = {$this->section_course_id}");
        $currentKeySection = $results[0]->section_order;
    }

    function isUserLessonComplete($userID, $lessonID){
        global $wpdb;
        
        $tb_lp_user_items = $wpdb->prefix . 'learnpress_user_items';
        $res = $wpdb->get_results(
        "SELECT `item_id`
        FROM $tb_lp_user_items
        WHERE  `user_id` = $userID AND `item_type` = 'lp_lesson' AND `item_id` = $lessonID AND `status` = 'completed'" 
        );
        return count($res) ? true : false;
        // return $res;
    }

    function get_sections() {
        global $wpdb;
        $table = $wpdb->prefix . 'learnpress_sections';
        $arrs = array();
        
        $results = $wpdb->get_results( "SELECT `section_id`,`section_name` FROM $table WHERE  `section_course_id` = {$this->section_course_id}");
        $currentKeySection = $results[0]->section_order;

        foreach ($results as $result) {
            
            $tb_sect_item = $wpdb->prefix . 'learnpress_section_items';
            $tb_posts = $wpdb->prefix . 'posts';
            $res = $wpdb->get_results(
                "SELECT $tb_posts.*
                FROM $tb_sect_item
                INNER JOIN $tb_posts ON $tb_posts.`ID`= $tb_sect_item.`item_id` 
                WHERE  $tb_posts.`post_type` ='lp_lesson' AND $tb_sect_item.`section_id` = {$result->section_id}"
                );
                $result->lessons = $res;
                $total_time = 0;
                foreach ($result->lessons as $lesson) {
                    $id = $lesson->ID;
                    $lp_duration = get_field('_lp_duration',$id);
                    $lp_preview = get_field('_lp_preview',$id);
                    $video_hls_url = get_field('course_video_url',$id);
                    $video_uploaded = get_field('course_video',$id);
                    $video = $video_hls_url ? $video_hls_url : $video_uploaded;
                    $isHasHls = $video_hls_url ? true : false;
                    $vido_thumbnail = get_field('thumbnail_lesson',$id) ? get_field('thumbnail_lesson',$id) : get_template_directory_uri() . '/assets/images/image_notfound.png';
                    $permalink = get_permalink($id);
                    $time_label = explode(" ",$lp_duration)[1];
                    $time_num = explode(" ",$lp_duration)[0];
                    
                    // $time_num ? int($time_num) : 0 ;
                    switch ($time_label) {
                    case "minute":
                        $time_label = "phút";
                        $total_time += $time_num*60;
                        break;
                    case "hour":
                        $time_label = "giờ";
                        $total_time += $time_num*3600;
                        break;
                    case "day":
                        $time_label = "ngày";
                        $total_time += $time_num*24*3600;
                        break;
                    default:
                    $time_label = "tuần";
                    $total_time += $time_num*24*3600*7;
                    }
                    
                    $time_display = $time_num ." ". $time_label;

                    switch ($lp_preview) {
                    case "yes":
                        $lp_preview = true;
                        break;
                    case "no":
                        $lp_preview = false;
                        break;
                    default:
                    $lp_preview = false;
                    }
                    
                    $isOwnerCourse = (new courseDto(null))->isOwnerCourse($this->userID, $this->section_course_id);

                    if($isOwnerCourse){
                        $lesson->is_completed =  $this->userID ? $this->isUserLessonComplete($this->userID,$id) : false;
                    }else{
                        $lesson->is_completed = null;
                    }
                    $lesson->duration =  $time_display;
                    $lesson->preview = $lp_preview; 
                    $lesson->permalink = $permalink; 
                    $lesson->video = $video;
                    $lesson->isHasHls = $isHasHls;
                    $lesson->thumbnail = $vido_thumbnail;
                    $lesson->isOwnerCourse = $isOwnerCourse;
                    $lesson->userID = $this->userID;
                    $lesson->lessonId = $id;
            }
            $result->total_duration = ($total_time/3600) < 1 ? ($total_time/60).' phút' : ($total_time/3600).' giờ';
            // $result->total_duration = $total_time;
        }
        return $results;
        // print_r($results);
    }

    function get_lesson_id_first($course_id) {
        global $wpdb;
        $table = $wpdb->prefix . 'learnpress_sections';
        $permalink = '';
        
        $results = $wpdb->get_results( "SELECT `section_id`,`section_name` FROM $table WHERE  `section_course_id` = $course_id");

        foreach ($results as $result) {
            $tb_sect_item = $wpdb->prefix . 'learnpress_section_items';
            $lessons = $wpdb->get_results(
                "SELECT `item_id`
                FROM $tb_sect_item
                WHERE  $tb_sect_item.`section_id` = {$result->section_id}"
                );
            foreach ($lessons as $lesson) {
                if($lesson->item_id){
                    return $lesson->item_id;
                }else{
                    return false;
                }
            }
        }
    }

    function get_lesson_video_first($course_id) {
        global $wpdb;
        $table = $wpdb->prefix . 'learnpress_sections';        
        $results = $wpdb->get_results( "SELECT `section_id`,`section_name` FROM $table WHERE  `section_course_id` = $course_id");

        foreach ($results as $result) {
            $tb_sect_item = $wpdb->prefix . 'learnpress_section_items';
            $lessons = $wpdb->get_results(
                "SELECT `item_id`
                FROM $tb_sect_item
                WHERE  $tb_sect_item.`section_id` = {$result->section_id}"
                );
            foreach ($lessons as $lesson) {
                $lesson_video_url = get_field('course_video',$lesson->item_id);
                if($lesson_video_url){
                    // return $lesson_video_url;
                    return get_permalink($lesson->item_id);
                }
            }
        }
        return false;
    }
 
    function update_section() {
        global $wpdb;
        $table = $wpdb->prefix . 'learnpress_sections';
        $isExistSectionId = $wpdb->get_var( "SELECT count(*) FROM $table WHERE  `section_id` = {$this->section_id}" );

        if($isExistSectionId):
            $sectionArr = json_decode($this->sections,true);
            $result = $wpdb->update($table, array('section_id'=>$this->section_id, 'section_name'=>$sectionArr[0]['title'], 'section_description'=>$sectionArr[0]['content']), array('section_id'=>$this->section_id));
            return $result;
        else:
            return false;
        endif;
    }

    function addon_item_section(){
        global $wpdb;
        $table = $wpdb->prefix . 'learnpress_section_items';
        $arrs = array();

        $results = $wpdb->get_results( "SELECT `item_order` FROM $table WHERE  `section_id` = {$this->section_id} ORDER BY `item_order` DESC LIMIT 1" );

        $currentKeySection = $results[0]->item_order; 

        $itemsArr = json_decode($this->itemsAddon,true);

        foreach ($itemsArr as $item) {
            $currentKeySection++;
            $data = array(
                'section_id' => $this->section_id,
                'item_id' => $item['item_id'],
                'item_order' => $currentKeySection,
                'item_type' => $item['item_type']
            );
            // print_r($data);
            array_push($arrs,$wpdb->insert($table,$data));
        }
        // print_r($results);
        return $arrs;
    }
}