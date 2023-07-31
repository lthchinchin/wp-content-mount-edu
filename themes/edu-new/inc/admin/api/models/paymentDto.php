<?php
class paymentDto
{
    public $psw;
    
    function __construct($parameters) {
        $this->psw = isset($parameters['password']) && $parameters['password'] ? $parameters['password'] : null;

        $this->merchantReferId = isset($parameters['merchantReferId']) && $parameters['merchantReferId'] ? $parameters['merchantReferId'] : null;
        $this->actualVars = isset($parameters['actualVars']) && $parameters['actualVars'] ? $parameters['actualVars'] : null;
        $this->orderId = isset($parameters['orderId']) && $parameters['orderId'] ? $parameters['orderId'] : null;
        $this->transactionContent = isset($parameters['transactionContent']) && $parameters['transactionContent'] ? "Thanh toán đơn hàng: " . $this->orderId : null;
        
        $userInfoFromCMS = SSOHelper::getLoggedInData();
        $userId = $userInfoFromCMS ? get_user_by('login', $userInfoFromCMS->phone)->ID : null;

        $this->userID = $userId;
        $this->accessToken = $userInfoFromCMS->accessToken;
        $this->walletId = $userInfoFromCMS->wallet->walletId;
    }

    function checking_password($password = null) {
        $url = VARS_API_GATEWAY . '/vid/api/users/me/password/checking';
        $contentRes = wp_remote_post(
            $url,
            array(
                'body' =>
                json_encode(array(
                    "password" => $password ? $password : base64_decode($this->psw)
                )),
                'headers' => array(
                    'content-type' => 'application/json',
                    'Authorization' => 'Bearer ' . $this->accessToken,
                ),
            )
        );
        return wp_remote_retrieve_response_code($contentRes) === 200 ? true : false;
    }

    function checking_account_balance() {
        $url = VARS_API_GATEWAY . '/vcms/wallets/me/' . $this->walletId;
        $contentRes = wp_remote_get(
            $url,
            array(
                'headers' => array(
                    'content-type' => 'application/json',
                    'Authorization' => 'Bearer ' . $this->accessToken,
                ),
            )
        );
        return wp_remote_retrieve_body($contentRes);
    }

    function transactions_consumption($merchantReferId = null, $actualVars = null, $transactionContent = null){
        $url = VARS_API_GATEWAY . '/vcms/wallets/me/' . $this->walletId . '/transactions/consumption';
        $json = json_encode(array(
            "merchant" => "VARS_EDU",
            "merchantReferId" => $merchantReferId ? $merchantReferId : $this->merchantReferId,
            "actualVars" => $actualVars ? $actualVars : $this->actualVars,
            "transactionContent" => $transactionContent ? $transactionContent : $this->transactionContent
        ));
        $contentRes = wp_remote_post(
            $url,
            array(
                'body' => $json,
                'headers' => array(
                    'content-type' => 'application/json',
                    'Authorization' => 'Bearer ' . $this->accessToken,
                ),
            )
        );

        $wp_remote_retrieve_body = wp_remote_retrieve_body($contentRes);
        
        if(json_decode($wp_remote_retrieve_body)->code == 200){
            $merchantReferId = json_decode($wp_remote_retrieve_body)->data->merchantReferId;
            $orderId = explode("-",$merchantReferId)[1];
            $setSuccessOrder = (new orderDto($parameters))->setSuccessOrder($orderId);   
        }
        return $wp_remote_retrieve_body;
    }

    function accept_payment(){
        $returnArr = array();

        if(!$this->checking_password()){
            $returnArr['label'] = "password incorrect!".$this->psw;
            $returnArr['value'] = 500;
            return $returnArr;
        }
        $checking_account_balance = $this->checking_account_balance();
        $balance = json_decode($checking_account_balance)->data->balance;
        
        if($balance < $this->actualVars){
            // $returnArr['label'] = "not enough balance!";
            $returnArr['label'] = $balance;
            $returnArr['value'] = false;
            return $returnArr;
        }

        $returnArr['label'] = 'transactions consumption success';
        $returnArr['value'] = $this->transactions_consumption();

        return $returnArr;

    }




}