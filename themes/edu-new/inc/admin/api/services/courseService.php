<?php

class courseService extends BaseService
{

    function handle_insert_course(WP_REST_Request $request)
    {
        $parameters = $request->get_body_params();

        $files = $request->get_file_params();

        // var_dump($files);

        $postId = (new courseDto($parameters,$files))->insert_course();

        return $this->responseData($postId);
    }

    function handle_review_courses(WP_REST_Request $request)
    {
        $parameters = $request->get_json_params();

        $review = (new courseDto($parameters))->addReview();

        return $this->responseData($review);
    }

    function handle_get_reviews(WP_REST_Request $request)
    {
        $parameters = $request->get_json_params();

        $reviews = (new courseDto($parameters))->getReviews();

        return $this->responseData($reviews);
    }
    
    function handle_get_courses(WP_REST_Request $request)
    {
        $parameters = $request->get_json_params();

        $courses = (new courseDto($parameters))->get_courses();

        return $this->responseData($courses);
    }
    function handle_get_courses_own(WP_REST_Request $request)
    {
        $parameters = $request->get_json_params();

        $courses = (new courseDto($parameters))->get_courses_own();

        return $this->responseData($courses);
    }
    function handle_get_quizs_own(WP_REST_Request $request)
    {
        $parameters = $request->get_json_params();

        $quizs = (new courseDto($parameters))->get_quizs_own();

        return $this->responseData($quizs);
    }

    function handle_get_countRate_bycourseid(WP_REST_Request $request)
    {
        $parameters = $request->get_json_params();

        $courses = (new courseDto($parameters))->countRate();

        return $this->responseData($courses);
    }

    function handle_active_course(WP_REST_Request $request)
    {
        $parameters = $request->get_json_params();

        $courses = (new courseDto($parameters))->activeCourse();

        return $this->responseData($courses);
    }

    function handle_get_source_complete_info(WP_REST_Request $request)
    {
        $parameters = $request->get_json_params();

        $courses = (new courseDto($parameters))->get_source_complete_info();

        return $this->responseData($courses);
    }
    
}