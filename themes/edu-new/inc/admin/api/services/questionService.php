<?php

class questionService extends BaseService
{

    function handle_insert_question(WP_REST_Request $request)
    {
        $parameters = $request->get_body_params();

        $postId = (new questionDto($parameters))->insert_question();

        return $this->responseData($postId);
    }

    function handle_update_question(WP_REST_Request $request)
    {
        $parameters = $request->get_body_params();

        $postId = (new questionDto($parameters))->update_question();

        return $this->responseData($postId);
    }
    
    function handle_addon_answer_question(WP_REST_Request $request)
    {
        $parameters = $request->get_body_params();

        $postId = (new questionDto($parameters))->addon_answer_question();

        return $this->responseData($postId);
    }
}

