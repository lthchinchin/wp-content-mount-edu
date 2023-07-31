<?php

class sectionService extends BaseService
{

    function handle_get_sections(WP_REST_Request $request)
    {


        $parameters = $request->get_json_params();

        
        $sections = (new sectionDto($parameters))->get_sections();
        // var_dump($sections);

        return $this->responseData($sections);
    }

    function handle_update_section(WP_REST_Request $request)
    {
        $parameters = $request->get_body_params();

        $postId = (new sectionDto($parameters))->update_section();

        return $this->responseData($postId);
    }

    function handle_addon_item_section(WP_REST_Request $request)
    {
        $parameters = $request->get_body_params();

        $postId = (new sectionDto($parameters))->addon_item_section();

        return $this->responseData($postId);
    }
}