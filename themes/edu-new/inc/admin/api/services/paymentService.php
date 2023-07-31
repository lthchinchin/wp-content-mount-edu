<?php

class paymentService extends BaseService
{

    function handle_checking_password(WP_REST_Request $request)
    {
        $parameters = $request->get_json_params();
    
        $payment = (new paymentDto($parameters))->checking_password();

        return $this->responseData($payment);
    }

    function handle_accept_payment(WP_REST_Request $request)
    {
        $parameters = $request->get_json_params();
    
        $payment = (new paymentDto($parameters))->accept_payment();

        return $this->responseData($payment);
    }
}