<?php
class postTypeService extends BaseService
{
    function handle_get_all_post(WP_REST_Request $request)
    {
        $parameters = $request->get_json_params();

        $postTypeDto = (new postTypeDto($parameters))->get_all_post();

        return $this->responseData($postTypeDto);
    }
    function handle_insert_post(WP_REST_Request $request)
    {
        $parameters = $request->get_body_params();

        $postId = (new postTypeDto($parameters))->insert_post();

        return $this->responseData($postId);
    }
}