<?php

class BaseRestController extends WP_REST_Controller
{

    public $apiUnlock = array();

    function __construct()
    {
        $this->apiUnlock = array(
            'get_quizs',
            'get_sections',
            'get_reviews'
        );
    }

    public function getContextApiUrlV1()
    {
        return "/v1";
    }

    /**
     * Register the routes for the objects of the controller.
     */
    protected function register_Api($methods, $apiname, $clzz, $callbackFunctionStr)
    {

        if (in_array($apiname,$this->apiUnlock)){
            $funcAuth = 'aceptPass';
        }else{
            $funcAuth = 'authChecker';
        }

        register_rest_route($this->getContextApiUrlV1(), $apiname, array(
            'methods' => $methods,
            'callback' => array($clzz, $callbackFunctionStr),
            'permission_callback' => array($this, $funcAuth),
            'args'                => array()
        ));

    }

    function authChecker(WP_REST_Request $request)
    {
        $userInfoFromCMS = SSOHelper::getLoggedInData();
        $userId = $userInfoFromCMS ? get_user_by('login', $userInfoFromCMS->phone)->ID : null;
        if(!$userId){
            return false;
        }else{
            return true;
        }
    }
    
    function aceptPass()
    {
        return true;
    }


}