<?php

class lessonService extends BaseService
{

    function handle_get_lessons(WP_REST_Request $request)
    {
        $parameters = $request->get_json_params();

        $postId = (new lessonDto($parameters))->get_lessons();

        return $this->responseData($postId);
    }

    function handle_insert_lesson(WP_REST_Request $request)
    {
        $parameters = $request->get_body_params();

        $postId = (new lessonDto($parameters))->insert_lesson();

        return $this->responseData($postId);
    }

    function handle_update_lesson(WP_REST_Request $request)
    {
        $parameters = $request->get_body_params();

        $postId = (new lessonDto($parameters))->update_lesson();

        return $this->responseData($postId);
    }

    function handle_complete_lesson(WP_REST_Request $request)
    {
        $parameters = $request->get_json_params();

        $postId = (new lessonDto($parameters))->completed_lesson();

        return $this->responseData($postId);
    }

}