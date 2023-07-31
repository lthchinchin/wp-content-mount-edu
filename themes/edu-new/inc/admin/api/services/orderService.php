<?php

class orderService extends BaseService
{

    function handle_create_a_order(WP_REST_Request $request)
    {
        $parameters = $request->get_json_params();

        $data = (new orderDto($parameters))->create_a_order();

        return $this->responseData($data['value'],$data['label']);
    }

    function handle_set_success_order(WP_REST_Request $request)
    {
        $parameters = $request->get_json_params();

        $postId = (new orderDto($parameters))->setSuccessOrder();

        return $this->responseData($postId);
    }
}

