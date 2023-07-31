<?php

class BaseService
{
    function get_client_ip()
    {
        $ipaddress = array();
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            array_push($ipaddress, $_SERVER['HTTP_CLIENT_IP']);
        }
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            array_push($ipaddress, $_SERVER['HTTP_X_FORWARDED_FOR']);
        }
        if (isset($_SERVER['HTTP_X_FORWARDED'])) {
            array_push($ipaddress, $_SERVER['HTTP_X_FORWARDED']);
        }
        if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            array_push($ipaddress, $_SERVER['HTTP_FORWARDED_FOR']);
        }
        if (isset($_SERVER['HTTP_FORWARDED'])) {
            array_push($ipaddress, $_SERVER['HTTP_FORWARDED']);
        }
        if (isset($_SERVER['REMOTE_ADDR'])) {
            array_push($ipaddress, $_SERVER['REMOTE_ADDR']);
        }
        return $ipaddress;
    }

    function responseData($data,$message = '')
    {
        $response_obj = array();  
        $response_obj["status"] = "success";
        $response_obj["data"] = $data;
        $response_obj["message"] = $message;
        $response = new WP_REST_Response($response_obj);
        return $response;
    }

    function responseError($code, $message)
    {
        return new WP_Error($code, $message, array('status' => $code));
    }

    function handle_get_my_ip()
    {
        $ipaddress = $this->get_client_ip();
        return $this->responseData($ipaddress);
    }

    function varsland_user_upload_image( $file = array(), $rotate_deg = 0 ) {
        require_once( ABSPATH . 'wp-admin/includes/admin.php' );
        $file_return = wp_handle_upload( $file, array('test_form' => false ) );
    
        if ( isset( $file_return['error'] ) || isset( $file_return['upload_error_handler'] ) ) {
            return false;
        } else {
            $image = wp_get_image_editor(  $file_return['file'] );
            
            $image->rotate( $rotate_deg * -1);
            $image->save(  $file_return['file'] );
            
            $filename = $file_return['file'];
            $attachment = array(
                'post_mime_type' => $file_return['type'],
                'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
                'post_content'   => '',
                'post_status'    => 'inherit',
                'guid'           => $file_return['url']
            );
            $attachment_id = wp_insert_attachment( $attachment, $file_return['url'] );
            require_once(ABSPATH . 'wp-admin/includes/image.php');
            $attachment_data = wp_generate_attachment_metadata( $attachment_id, $filename );
            wp_update_attachment_metadata( $attachment_id, $attachment_data );
            if ( 0 < intval( $attachment_id ) ) {
                return array(
                    'url' => $file_return['url'], 
                    'attachment_id'  => $attachment_id
                );
            }
        }
        return false;
    }
    function res_get(){
        return "okkkkkk";
    }

}
