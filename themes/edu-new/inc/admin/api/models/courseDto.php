<?php
class courseDto extends postTypeDto
{
    public $lp_level;
    public $lp_block_finished;
    public $files;
    public $lp_sale_price;
    public $lp_regular_price;
    public $sections;

    function __construct($objPostType, $files = [])
    {
        parent::__construct($objPostType);
        $this->files = $files;
        $this->lp_level = isset($objPostType['lp_level']) && $objPostType['lp_level'] ? $objPostType['lp_level'] : 'beginner';
        $this->lp_block_finished = isset($objPostType['lp_block_finished']) && $objPostType['lp_block_finished'] ? $objPostType['lp_block_finished'] : 'no';
        $this->lp_regular_price = isset($objPostType['lp_regular_price']) && $objPostType['lp_regular_price'] ? $objPostType['lp_regular_price'] : '';
        $this->sections = isset($objPostType['sections']) && $objPostType['sections'] ? $objPostType['sections'] : '';
        $this->review = isset($objPostType['review']) && $objPostType['review'] ? $objPostType['review'] : '';

        $this->course_id = isset($objPostType['course_id']) && $objPostType['course_id'] ? $objPostType['course_id'] : '';
        $this->offsetRv = isset($objPostType['offsetRv']) && $objPostType['offsetRv'] ? $objPostType['offsetRv'] : 0;
        $this->filter = isset($objPostType['filter']) && $objPostType['filter'] ? $objPostType['filter'] : '';
        $this->limit = isset($objPostType['limit']) && $objPostType['limit'] ? $objPostType['limit'] : 3;

        // 
        // 
        // $this->userid = isset($this->userid) && $this->userid ? $this->userid : null;

    }

    function insert_course()
    {
        $files                        = $this->files;
        $data_link                    = array();
        $array_images                 = array();

        $clazzBaseService = new BaseService();

        $id_insert = parent::insert_post();

        if ($id_insert) :
            for ($i = 0; $i < count($files['files']['name']); $i++) {
                $data = array(
                    'name'     => $files['files']['name'][$i],
                    'type'     => $files['files']['type'][$i],
                    'tmp_name' => $files['files']['tmp_name'][$i],
                    'error'    => $files['files']['error'][$i],
                    'size'     => $files['files']['size'][$i],
                );
                array_push($data_link, $clazzBaseService->varsland_user_upload_image($data));
            }
            update_post_meta($id_insert, '_lp_level', $this->lp_level);
            update_post_meta($id_insert, '_lp_block_finished', $this->lp_block_finished);
            update_post_meta($id_insert, '_lp_regular_price', $this->lp_regular_price);
            update_post_meta($id_insert, '_lp_sale_price', $this->lp_sale_price);


            $attachment_thumb_id = $data_link[0]['attachment_id'];
            if ($attachment_thumb_id) :
                set_post_thumbnail($id_insert, $attachment_thumb_id);
            endif;

        endif;

        return $id_insert;
    }

    function countLessonQuiz($lp_lesson_type, $course_id)
    {
        global $wpdb;
        $table1 = $wpdb->prefix . 'learnpress_section_items';
        $table2 = $wpdb->prefix . 'learnpress_sections';
        $results = $wpdb->get_results("SELECT COUNT(*) AS numcount FROM `$table1` WHERE section_id IN (SELECT section_id FROM `$table2` WHERE section_course_id = $course_id) AND item_type = '$lp_lesson_type'");
        return $results[0]->numcount;
    }

    function countLessonQuizComplete($course_id, $user_id = null)
    {
        global $wpdb;
        $tb_useritems = $wpdb->prefix . 'learnpress_user_items';
        $user_id = $user_id ? $user_id : $this->userid;
        $results = $wpdb->get_results("SELECT COUNT(*) AS numcount FROM `$tb_useritems` WHERE `ref_id` = $course_id AND `user_id` = $user_id AND `item_type` = 'lp_lesson' AND `$tb_useritems`.`status` = 'completed'");
        return $results[0]->numcount;
    }

    function get_source_complete_info()
    {
        $objInfo = new StdClass();
        $course_lqnum =  $this->countLessonQuiz('lp_lesson', $this->course_id);
        $course_lqcomplete =  $this->countLessonQuizComplete($this->course_id);
        
        $objInfo->total =  $course_lqnum;
        $objInfo->complete = $course_lqcomplete;
        $objInfo->percent = round(($course_lqcomplete / $course_lqnum) * 100, 2);

        $returnArr['label'] = "success active!";
        $returnArr['value'] = $objInfo;
        return $returnArr;
    }

    function ownCourseStatus($course_id, $user_id = null)
    {
        global $wpdb;
        $tb_useritems = $wpdb->prefix . 'learnpress_user_items';
        $user_id = $user_id ? $user_id : $this->userid;
        $results = $wpdb->get_results("SELECT `status` FROM `$tb_useritems` WHERE `item_id` = $course_id AND `user_id` = $user_id AND `item_type` = 'lp_course'");
        return $results[0]->status;
    }

    function countRegistered($course_id)
    {
        global $wpdb;
        $table1 = $wpdb->prefix . 'posts';
        $table2 = $wpdb->prefix . 'learnpress_order_items';

        $results = $wpdb->get_results("SELECT COUNT(*) AS numcount FROM `$table2` WHERE order_id IN (SELECT ID FROM `$table1` WHERE post_type = 'lp_order' AND post_status = 'lp-completed' ) AND item_id = $course_id");
        return $results[0]->numcount;
    }

    function countBuy($course_id)
    {
        global $wpdb;
        $table1 = $wpdb->prefix . 'posts';
        $table2 = $wpdb->prefix . 'learnpress_order_items';

        $results = $wpdb->get_results("SELECT COUNT(*) AS numcount FROM `$table2` WHERE order_id IN (SELECT ID FROM `$table1` WHERE post_type = 'lp_order' AND post_status = 'lp-completed' ) AND item_id = $course_id");
        return $results[0]->numcount;
    }

    function avgRating($course_id)
    {
        global $wpdb;
        $table1 = $wpdb->prefix . 'comments';
        $table2 = $wpdb->prefix . 'commentmeta';

        $results = $wpdb->get_results("SELECT AVG(`$table2`.`meta_value`) AS avg_rating FROM `wp_comments`, `$table2` WHERE `$table1`.comment_post_ID = $course_id and `$table2`.comment_id = `$table1`.comment_ID AND `$table2`.meta_key = 'course_rating'");
        return $results[0]->avg_rating;
    }

    function countRate($course_id)
    {
        global $wpdb;
        $table1 = $wpdb->prefix . 'commentmeta';
        $table2 = $wpdb->prefix . 'comments';

        $results = $wpdb->get_results(
            "SELECT  meta_value as star , COUNT(meta_value) AS star_count FROM $table1
        WHERE comment_id IN (SELECT comment_ID FROM $table2 WHERE comment_post_ID = $course_id) AND meta_key = 'course_rating'
        GROUP BY meta_value
        ORDER BY star DESC;
        "
        );

        return $results;
    }

    function addReview()
    {
        global $wpdb;
        $table1 = $wpdb->prefix . 'comments';
        $table2 = $wpdb->prefix . 'commentmeta';

            $author_obj = get_user_by('id', $this->userid);
            $author_fn = get_user_meta($this->userid, 'first_name', true);
            $author_ln = get_user_meta($this->userid, 'last_name', true);
            $user_name = $author_obj->display_name;
            $author_fullname = $author_fn || $author_ln ? $author_fn . ' ' . $author_ln : $user_name;

            

            if(!$this->isOwnerCourse($this->userid, $this->review['comment_post_ID'])){
                return array(
                    'label' => 'you must buy & active before review this course',
                    'value' => false
                );
            }

            $data = array(
                'comment_post_ID' => $this->review['comment_post_ID'],
                'comment_author' => $author_fullname,
                'comment_author_email' => $author_obj->user_email,
                'comment_content' => $this->review['comment_content'],
                'user_id' => $this->userid,
                'comment_approved' => 0,
                'comment_date' => current_time('mysql')
            );

            $wpdb->insert($table1, $data);
            $review_id = $wpdb->insert_id;
            $rating_id = 0;

            if ($review_id) {
                if ($this->review['rate']) {
                    $data_rating = array(
                        'comment_id' => $review_id,
                        'meta_key' => 'course_rating',
                        'meta_value' => $this->review['rate'],
                    );
                    $wpdb->insert($table2, $data_rating);
                    $rating_id = $wpdb->insert_id;
                }
            }

        return array('review_id' => $review_id, 'rating_id' => $rating_id, 'value' => true);
    }



    function getReviews($course_id = null)
    {
        global $wpdb;
        $tb_comments = $wpdb->prefix . 'comments';
        $tb_commentmeta = $wpdb->prefix . 'commentmeta';

        !isset($course_id) ? $course_id = $this->course_id : '';

        $res = $wpdb->get_results(
            "SELECT $tb_comments.`comment_ID`,$tb_comments.`user_id`,$tb_comments.`comment_content`, $tb_comments.`comment_author`,  $tb_comments.`comment_date`, $tb_commentmeta.`meta_value` 
        AS course_rating 
        FROM $tb_comments
        LEFT JOIN $tb_commentmeta ON $tb_comments.`comment_ID`= $tb_commentmeta.`comment_id` 
        WHERE  $tb_comments.`comment_approved` = 1 AND $tb_comments.`comment_post_ID` = $course_id
        ORDER BY $tb_comments.`comment_ID` DESC
        LIMIT $this->offsetRv,3
        "
        );

        foreach ($res as $key => $value) {

            $lp_profile_picture = get_user_meta($value->user_id, '_lp_profile_picture')[0];

            $user_ava_url = $lp_profile_picture ? wp_upload_dir()['baseurl'] . "$lp_profile_picture" : get_avatar_url($value->user_id);
            $value->ava_url = $user_ava_url;
            // print_r($value);
        }
        return $res;
    }

    function get_courses_own()
    {

        global $wpdb;
        $tb_posts = $wpdb->prefix . 'posts';
        $tb_orderitems = $wpdb->prefix . 'learnpress_order_items';


        if (!$this->userid) :
            return;
        endif;

        $res = $wpdb->get_results(
            "SELECT `item_id`
            FROM $tb_orderitems
            WHERE  `order_id` IN (SELECT `ID` FROM $tb_posts WHERE `post_author` = {$this->userid}  AND `post_type` = 'lp_order' AND `post_status` = 'lp-completed') 
            "
        );
        $arrId = array();
        foreach ($res as $value) {
            array_push($arrId, $value->item_id);
        }

        if (!count($arrId)) :
            return array();
        endif;

        $this->post_type = "lp_course";
        $this->tax_slug = "course_category";
        $this->post_in = $arrId;
        // $this->limit = 3;
        $this->offset     = (ceil($this->page) - 1) * $this->limit;

        $courses = parent::get_all_post();

        foreach ($courses['data'] as $key => $value) {


            $thumb_url = get_the_post_thumbnail_url($value->ID);
            !$thumb_url ? $thumb_url = get_template_directory_uri() . '/assets/images/image_notfound.png' : '';

            $author_id = get_post_field('post_author', $value->ID)[0];
            $author_fn = get_user_meta($author_id, 'first_name')[0];
            $author_ln = get_user_meta($author_id, 'last_name')[0];
            $user_name = get_userdata($author_id)->display_name;
            $author_fullname = $author_fn || $author_ln ? $author_fn . ' ' . $author_ln : $user_name;
            
            $lesson_id_first = (new sectionDto(null))->get_lesson_id_first($value->ID);
            $post = get_post($lesson_id_first); 
            $slug_lesson_id_first = $post->post_name;

            $value->pml_study = get_permalink($value->ID).get_option('learn_press_lesson_slug')."/".$slug_lesson_id_first ;
            $value->lesson_completed = $this->countLessonQuizComplete($value->ID);
            $value->lesson_course = $this->countLessonQuiz('lp_lesson', $value->ID);
            $value->permalink = get_permalink($value->ID);
            $value->thumb_url = $thumb_url;
            $value->teacher = $author_fullname;
            $value->learn_type = get_field('learn_type', $value->ID);
            $value->own_course_stt = $this->ownCourseStatus($value->ID);
            $value->is_active = $this->isOwnerCourse($this->userid, $value->ID);
            $value->filter = $this->filter;
        }

        if($this->filter){
            switch ($this->filter) {
                case 'finished':
                    $courses['data'] = array_values(array_filter($courses['data'],function($obj){ 
                        return $obj->own_course_stt === 'finished';
                    }));
                break;
                case 'processing':
                    $courses['data'] = array_values(array_filter($courses['data'],function($obj){ 
                        return $obj->is_active === true && $obj->own_course_stt != 'finished';
                    }));
                    break;
                case 'unactive':
                    $courses['data'] = array_values(array_filter($courses['data'],function($obj){ 
                        return $obj->is_active === false;
                        })); 
                break;
                default:
              }
        }
        return $courses;
    }

    function get_questions_by_quiz_id($quizId)
    {
        global $wpdb;
        $tb_quiz_questions = $wpdb->prefix . 'learnpress_quiz_questions';
        $res = $wpdb->get_results(
            "SELECT COUNT(*) AS questions_count
                FROM $tb_quiz_questions 
                WHERE `quiz_id` =  $quizId"
        );

        return $res[0]->questions_count;
    }

    function get_course_by_quiz_id($quizId)
    {
        global $wpdb;
        $tb_sections = $wpdb->prefix . 'learnpress_sections';
        $tb_section_items = $wpdb->prefix . 'learnpress_section_items';

        $res = $wpdb->get_results(
            "SELECT $tb_sections.`section_course_id` 
            FROM $tb_sections
            INNER JOIN $tb_section_items ON $tb_sections.`section_id`= $tb_section_items.`section_id` 
            WHERE  $tb_section_items.`item_id` = {$quizId}"
            );

        return $res[0]->section_course_id;
    }

    function get_quizs_own()
    {
        global $wpdb;
        $tb_useritems = $wpdb->prefix . 'learnpress_user_items';
        $tb_lpsectionitems = $wpdb->prefix . 'learnpress_section_items';
        $tb_lpsections = $wpdb->prefix . 'learnpress_sections';

        if (!$this->userid) :
            return;
        endif;

        if(isset($this->course_id) && $this->course_id){
            $sql =
            "SELECT `item_id` 
            FROM $tb_lpsectionitems 
            WHERE `item_type` = 'lp_quiz' AND `section_id` IN (
                SELECT `section_id`
                FROM $tb_lpsections
                WHERE  `section_course_id` = $this->course_id 
            )";
        }else{
            $sql =
            "SELECT `item_id` 
            FROM $tb_lpsectionitems 
            WHERE `item_type` = 'lp_quiz' AND `section_id` IN (
                SELECT `section_id`
                FROM $tb_lpsections
                WHERE  `section_course_id` 
                IN (
                    SELECT `item_id`
                    FROM $tb_useritems
                    WHERE  `user_id` = $this->userid AND `item_type` = 'lp_course'
                    )
                )";
        }

        $res = $wpdb->get_results($sql);

        $arrId = array();
        foreach ($res as $value) {
            array_push($arrId, $value->item_id);
        }

        if (!count($arrId)) :
            return array();
        endif;

        $this->post_type = "lp_quiz";
        // $this->tax_slug = "course_category";
        $this->post_in = $arrId;
        // $this->limit = 3;

        $quizs = parent::get_all_post();


        foreach ($quizs['data'] as $key => $value) {
            $thumb_url = get_the_post_thumbnail_url($value->ID);
            !$thumb_url ? $thumb_url = get_template_directory_uri() . '/assets/images/image_notfound.png' : '';
            $course_id =  $this->get_course_by_quiz_id($value->ID);


            $value->quiz_code = 'QZ'.date("y").'-'.$value->ID;
            $value->thumbnail = $thumb_url;
            $value->permalink = get_permalink($value->ID);
            $value->duration = get_field('_lp_duration', $value->ID);
            $value->retake_number = get_field('_lp_retake_count', $value->ID);
            $value->passing_grade = get_field('_lp_passing_grade', $value->ID);
            $value->questions = $this->get_questions_by_quiz_id($value->ID);
            $value->course_title = get_the_title($course_id);
            $value->course_permalink = get_permalink($course_id);
            $value->lesson_completed = $this->countLessonQuizComplete($value->ID);
            $value->lesson_course = $this->countLessonQuiz('lp_lesson', $value->ID);
            $value->learn_type = get_field('learn_type', $value->ID);
            $value->own_course_stt = $this->ownCourseStatus($value->ID);
            // $value->is_active = $this->isOwnerCourse($this->userid, $value->ID);
        }
        return $quizs;
        // var_dump($quizs);

        // print_r($quizs);
    }

    function get_courses()
    {

        $this->post_type = "lp_course";
        $courses = parent::get_all_post();
        // return $courses;
        foreach ($courses['data'] as $key => $value) {
            $course_id = $value->ID;

            $author_id = get_post_field('post_author', $course_id)[0];
            $author_fn = get_user_meta($author_id, 'first_name')[0];
            $author_ln = get_user_meta($author_id, 'last_name')[0];
            $user_name = get_userdata($author_id)->display_name;
            $author_fullname = $author_fn || $author_ln ? $author_fn . ' ' . $author_ln : $user_name;
            $fake_students = get_post_meta($course_id, '_lp_students')[0];
            $lp_profile_picture = get_user_meta($author_id, '_lp_profile_picture')[0];
            $author_thumb = $lp_profile_picture ? wp_upload_dir()['baseurl'] . "$lp_profile_picture" : get_avatar_url($author_id);

            $value->categories = get_the_terms($course_id, 'course_category');
            $value->lp_duration = get_post_meta($course_id, '_lp_duration')[0];
            $value->lp_level = get_post_meta($course_id, '_lp_level')[0];
            $value->lp_price = get_post_meta($course_id, '_lp_price')[0];
            $value->lp_regular_price = get_post_meta($course_id, '_lp_regular_price')[0];
            $value->lp_sale_price = get_post_meta($course_id, '_lp_sale_price')[0];
            $value->lp_max_students = get_post_meta($course_id, '_lp_max_students')[0];
            $value->lp_lesson_num = $this->countLessonQuiz('lp_lesson', $course_id);
            $value->lp_quiz_num = $this->countLessonQuiz('lp_quiz', $course_id);
            $value->lp_register_course_num = $this->countRegistered($course_id);
            $value->avg_rating = $this->avgRating($course_id);
            $value->count_rate = $this->countRate($course_id);
            $value->author_name = $author_fullname;
            $value->fake_students = $fake_students;
            $value->author_thumb = $author_thumb;

            // print_r($value);
        }
        return $courses;
        // var_dump($courses['data']);
    }

    function isOwnerCourse($userID, $courseID)
    {
        global $wpdb;

        $tb_lp_user_items = $wpdb->prefix . 'learnpress_user_items';
        $res = $wpdb->get_results(
            "SELECT COUNT(*) AS count
        FROM $tb_lp_user_items
        WHERE  `user_id` = $userID AND `item_id` = $courseID AND `item_type` = 'lp_course'"
        );
        return $res[0]->count ? true : false;
        // var_dump($res);
    }

    function activeCourse()
    {
        global $wpdb;
        $active_tb = $wpdb->prefix . 'learnpress_user_items';
        $returnArr = array();

        // expected user loggin!
        if (!isset($this->userid) || !$this->userid) {
            $returnArr['label'] = "expected user loggin!";
            $returnArr['value'] = false;
            return $returnArr;
        }

        // buy before active this course!
        $isBoughtCourse = (new orderDto(null))->isBoughtCourse($this->userid, $this->course_id);
        if (!$isBoughtCourse) {
            $returnArr['label'] = "buy before active this course!";
            $returnArr['value'] = false;
            return $returnArr;
        }

        $order_id = (new orderDto(null))->isOderedCourse($this->userid, $this->course_id);

        // you are actived!
        $results = $wpdb->get_results("SELECT count(*) as count FROM `{$active_tb}` WHERE `user_id` = $this->userid AND `item_id` = {$this->course_id}");
        $user_item_id = $results[0]->count;
        $is_actived = $user_item_id ? true : false;
        if ($is_actived) {
            $returnArr['label'] = "you are actived!";
            $returnArr['value'] = false;
            return $returnArr;
        }

        $data = array(
            'user_id' => $this->userid,
            'item_id' => $this->course_id,
            // 'start_time' => ,
            // 'end_time' => ,
            'item_type' => 'lp_course',
            'status' => 'enrolled',
            'graduation' => 'in-progress',
            'access_level' => 50,
            'ref_id' => $order_id,
            'ref_type' => 'lp_order',
            'parent_id' => 0,
        );


        $wpdb->insert($active_tb, $data);
        $returnArr['label'] = "success active!";
        $returnArr['value'] = $wpdb->insert_id;
        return $returnArr;
    }

    function set_completed_status_owner_course($course_id, $user_id = null){
        global $wpdb;
        $tb_useritems = $wpdb->prefix . 'learnpress_user_items';
        $user_id = $user_id ? $user_id : $this->userid;
        $update_data = $wpdb->query($wpdb->prepare("UPDATE $tb_useritems SET `status` = 'finished' WHERE `item_id` =  {$course_id}  AND `user_id` = {$user_id} AND `item_type` = 'lp_course'"));
        return $update_data;
    }


}