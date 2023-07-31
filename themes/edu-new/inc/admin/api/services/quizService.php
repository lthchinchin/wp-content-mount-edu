<?php

class quizService extends BaseService
{

    function handle_get_quizs(WP_REST_Request $request)
    {
        $parameters = $request->get_json_params();

        $postId = (new quizDto($parameters))->get_quizs();

        return $this->responseData($postId);
    }

    function handle_insert_quiz(WP_REST_Request $request)
    {
        $parameters = $request->get_body_params();

        $postId = (new quizDto($parameters))->insert_quiz();

        return $this->responseData($postId);
    }

    function handle_update_quiz(WP_REST_Request $request)
    {
        $parameters = $request->get_body_params();

        $postId = (new quizDto($parameters))->update_quiz();

        return $this->responseData($postId);
    }
    
    function handle_addon_question_quiz(WP_REST_Request $request)
    {
        $parameters = $request->get_body_params();

        $postId = (new quizDto($parameters))->addon_question_quiz();

        return $this->responseData($postId);
    }


    function handle_submit_anwsers(WP_REST_Request $request)
    {
        $parameters = $request->get_json_params();

        $res = (new quizDto($parameters))->submit_anwsers();

        return $this->responseData($res['value'],$res['label']);

    }

    function handle_save_exam_entries(WP_REST_Request $request)
    {
        $parameters = $request->get_json_params();

        $res = (new quizDto($parameters))->save_exam_entries();

        return $this->responseData($res['value'],$res['label']);

    }

    function handle_get_continue_exam_entry(WP_REST_Request $request)
    {
        $parameters = $request->get_json_params();

        $res = (new quizDto($parameters))->get_continue_exam_entry();

        return $this->responseData($res['value'],$res['label']);

    }

    function handle_get_count_down_quiz(WP_REST_Request $request)
    {
        $parameters = $request->get_json_params();

        $res = (new quizDto($parameters))->get_count_down_quiz();

        return $this->responseData($res['value'],$res['label']);

    }

    function handle_get_results_exam(WP_REST_Request $request)
    {
        $parameters = $request->get_json_params();

        $res = (new quizDto($parameters))->get_results_exam();

        return $this->responseData($res['value'],$res['label']);

    }
    function handle_is_can_retake(WP_REST_Request $request)
    {
        $parameters = $request->get_json_params();

        $res = (new quizDto($parameters))->is_can_retake();

        return $this->responseData($res['value'],$res['label']);
    }
    function handle_retake_the_exam(WP_REST_Request $request)
    {
        $parameters = $request->get_json_params();

        $res = (new quizDto($parameters))->retake_the_exam();

        return $this->responseData($res['value'],$res['label']);
    }

}