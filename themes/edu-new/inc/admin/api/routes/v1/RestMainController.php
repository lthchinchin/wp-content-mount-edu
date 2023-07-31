<?php
require get_template_directory() . '/inc/admin/api/routes/v1/BaseRestController.php';
require get_template_directory() . '/inc/admin/api/services/BaseService.php';

require get_template_directory() . '/inc/admin/api/models/postTypeDto.php';
require get_template_directory() . '/inc/admin/api/models/sectionDto.php';
require get_template_directory() . '/inc/admin/api/models/courseDto.php';
require get_template_directory() . '/inc/admin/api/models/lessonDto.php';
require get_template_directory() . '/inc/admin/api/models/quizDto.php';
require get_template_directory() . '/inc/admin/api/models/questionDto.php';
require get_template_directory() . '/inc/admin/api/models/orderDto.php';

require get_template_directory() . '/inc/admin/api/models/InstructorVars.php';

require get_template_directory() . '/inc/admin/api/models/paymentDto.php';

require get_template_directory() . '/inc/admin/api/services/paymentService.php';

require get_template_directory() . '/inc/admin/api/services/postTypeService.php';
require get_template_directory() . '/inc/admin/api/services/sectionService.php';
require get_template_directory() . '/inc/admin/api/services/courseService.php';
require get_template_directory() . '/inc/admin/api/services/lessonService.php';
require get_template_directory() . '/inc/admin/api/services/quizService.php';
require get_template_directory() . '/inc/admin/api/services/questionService.php';
require get_template_directory() . '/inc/admin/api/services/orderService.php';


class RestMainController extends BaseRestController
{
    public function routes()
    {
        add_action('rest_api_init', array($this, 'register_resfull_api'));
    }

    public function register_resfull_api()
    {   

        //regist common api
        $clazzBaseService = new BaseService();
        $clazzpostTypeService = new postTypeService();
        $clazzcourseService = new courseService();
        $clazzsectionService = new sectionService();
        $clazzlessonService = new lessonService();
        $clazzquizService = new quizService();
        $clazzquestionService = new questionService();
        $clazzorderService = new orderService();
        $clazzpaymentService = new paymentService();

        $this->register_Api('GET', 'get_my_ip', $clazzBaseService, 'handle_get_my_ip');
        
        $this->register_Api('POST', 'get_all_post', $clazzpostTypeService, 'handle_get_all_post');
        $this->register_Api('POST', 'insert_a_post', $clazzpostTypeService, 'handle_insert_post');
        
        $this->register_Api('POST', 'insert_a_course', $clazzcourseService, 'handle_insert_course');
        $this->register_Api('POST', 'get_courses', $clazzcourseService, 'handle_get_courses');
        $this->register_Api('POST', 'get_courses_own', $clazzcourseService, 'handle_get_courses_own');
        $this->register_Api('POST', 'get_quizs_own', $clazzcourseService, 'handle_get_quizs_own');
        $this->register_Api('POST', 'review_courses', $clazzcourseService, 'handle_review_courses');
        $this->register_Api('POST', 'get_reviews', $clazzcourseService, 'handle_get_reviews');
        $this->register_Api('POST', 'get_count_rate', $clazzcourseService, 'handle_get_countRate_bycourseid');
        $this->register_Api('POST', 'active_course', $clazzcourseService, 'handle_active_course');
        $this->register_Api('POST', 'get_source_complete_info', $clazzcourseService, 'handle_get_source_complete_info');

        $this->register_Api('POST', 'get_sections', $clazzsectionService, 'handle_get_sections');
        $this->register_Api('POST', 'insert_sections', $clazzsectionService, 'handle_insert_sections');
        $this->register_Api('POST', 'update_section', $clazzsectionService, 'handle_update_section');
        $this->register_Api('POST', 'addon_item_section', $clazzsectionService, 'handle_addon_item_section');

        $this->register_Api('POST', 'get_lessons', $clazzlessonService, 'handle_get_lessons');
        $this->register_Api('POST', 'insert_lesson', $clazzlessonService, 'handle_insert_lesson');
        $this->register_Api('POST', 'update_lesson', $clazzlessonService, 'handle_update_lesson');
        $this->register_Api('POST', 'complete_lesson', $clazzlessonService, 'handle_complete_lesson');

        $this->register_Api('POST', 'get_quizs', $clazzquizService, 'handle_get_quizs');
        $this->register_Api('POST', 'insert_quiz', $clazzquizService, 'handle_insert_quiz');
        $this->register_Api('POST', 'update_quiz', $clazzquizService, 'handle_update_quiz');
        $this->register_Api('POST', 'addon_question_quiz', $clazzquizService, 'handle_addon_question_quiz');
        $this->register_Api('POST', 'submit_anwsers', $clazzquizService, 'handle_submit_anwsers');
        $this->register_Api('POST', 'save_exam_entries', $clazzquizService, 'handle_save_exam_entries');
        $this->register_Api('POST', 'get_continue_exam_entry', $clazzquizService, 'handle_get_continue_exam_entry');
        $this->register_Api('POST', 'get_count_down_quiz', $clazzquizService, 'handle_get_count_down_quiz');
        $this->register_Api('POST', 'get_results_exam', $clazzquizService, 'handle_get_results_exam');
        $this->register_Api('POST', 'is_can_retake', $clazzquizService, 'handle_is_can_retake');
        $this->register_Api('POST', 'retake_the_exam', $clazzquizService, 'handle_retake_the_exam');
        
        $this->register_Api('POST', 'insert_question', $clazzquestionService, 'handle_insert_question');
        $this->register_Api('POST', 'update_question', $clazzquestionService, 'handle_update_question');
        $this->register_Api('POST', 'addon_answer_question', $clazzquestionService, 'handle_addon_answer_question');
        
        $this->register_Api('POST', 'create_a_order', $clazzorderService, 'handle_create_a_order');
        $this->register_Api('POST', 'set_success_order', $clazzorderService, 'handle_set_success_order');

        $this->register_Api('POST', 'accept_payment', $clazzpaymentService , 'handle_accept_payment');

    }
}