<?php
class orderDto extends postTypeDto
{
    public $course_id;
    public $user_id;

    function __construct($parameters) {
        parent::__construct($parameters);
        $this->course_id = isset($parameters['course_id']) && $parameters['course_id'] ? $parameters['course_id'] : null;
        $this->subtotal = isset($parameters['subtotal']) && $parameters['subtotal'] ? $parameters['subtotal'] : 0;
        $this->order_id = isset($parameters['order_id']) && $parameters['order_id'] ? $parameters['order_id'] : null;
    }

    function isOderedCourse($user_id, $course_id){
        global $wpdb;
        $tbl_posts = $wpdb->prefix . 'posts';
        $tbl_order_items = $wpdb->prefix . 'learnpress_order_items';

        $results = $wpdb->get_results("SELECT `ID` as order_id FROM `{$tbl_posts}` as a INNER JOIN `{$tbl_order_items}` as b ON b.`order_id` = a.`ID` WHERE a.`post_author` = $user_id AND b.`item_id` = $course_id");
        $order_id = $results[0]->order_id;

        return $order_id ? $order_id : false;
    }

    function isBoughtCourse($user_id, $course_id){
        global $wpdb;
        $tbl_posts = $wpdb->prefix . 'posts';
        $tbl_order_items = $wpdb->prefix . 'learnpress_order_items';

        $results = $wpdb->get_results("SELECT COUNT(*) AS COUNT FROM `{$tbl_posts}` as a 
        INNER JOIN `{$tbl_order_items}` as b ON b.`order_id` = a.`ID` WHERE a.`post_author` = $user_id AND b.`item_id` = $course_id AND a.`post_status` = 'lp-completed'
        ");
        $rs_count = $results[0]->COUNT;
        return $rs_count ? true : false;
    }

    function create_a_order()
    {
        global $wpdb;
        $tbl_orders = $wpdb->prefix . 'learnpress_order_items';
        $tbl_orders_meta = $wpdb->prefix . 'learnpress_order_itemmeta';
        $tbl_post_meta = $wpdb->prefix . 'postmeta';
        $quantity = 1;
        $returnArr = array();

        $this->subtotal = get_field('_lp_sale_price',$this->course_id) ? get_field('_lp_sale_price',$this->course_id) : get_field('_lp_regular_price',$this->course_id) ;
        $this->post_type = 'lp_order';
        $this->post_status = 'lp-processing';
        $this->post_author = $this->userid;
        $this->post_name = $this->vn_str_filter($this->post_title);

        // expected a id param!
        if(!$this->userid || !$this->course_id){
            $returnArr['label'] = "expected a id param!";
            $returnArr['value'] = false;
            return $returnArr;
        }

        // you bought this course!
        if($this->isBoughtCourse($this->userid,$this->course_id)){
            $returnArr['label'] = "you bought this course!";
            $returnArr['value'] = 1;
            return $returnArr;
        }
        

        // you odered this course!
        if($this->isOderedCourse($this->userid,$this->course_id)){
            $odr_id = $this->isOderedCourse($this->userid,$this->course_id);
            $returnArr['label'] = "you odered this course!";
            $returnArr['value'] = $this->createOrderCode($odr_id,get_the_title($odr_id));
            return $returnArr;
        }

        $order_id = parent::insert_post(); //create a order
        
        // create order fail!
        if(!$order_id){
            $returnArr['label'] = "create order fail!";
            $returnArr['value'] = false;
            return $returnArr;
        }

        $post_meta_entries = array(
            array(
                'post_id' => $order_id,
                'meta_key' => '_order_total',
                'meta_value' => $this->subtotal * $quantity
            ),
            array(
                'post_id' => $order_id,
                'meta_key' => '_order_subtotal',
                'meta_value' => $this->subtotal
            ),
            array(
                'post_id' => $order_id,
                'meta_key' => '_user_id',
                'meta_value' => $this->userid
            ),
            array(
                'post_id' => $order_id,
                'meta_key' => '_course_id',
                'meta_value' => $this->course_id
                )
            );
    
            foreach ($post_meta_entries as $value) {
                $wpdb->insert($tbl_post_meta, $value);
            }

          
    
        $wpdb->insert($tbl_orders, array(
            'order_item_name' => get_the_title($this->course_id),
            'order_id' => $order_id,
            'item_id' => $this->course_id,
            'item_type' => 'lp_course'
        ));
    
        $order_item_id = $wpdb->insert_id;
    
        $orders_meta_entries = array(
            array(
                'learnpress_order_item_id' => $order_item_id,
                'meta_key' => '_course_id',
                'meta_value' => $this->course_id
            ),
            array(
                'learnpress_order_item_id' => $order_item_id,
                'meta_key' => '_quantity',
                'meta_value' => 1
            ),
            array(
                'learnpress_order_item_id' => $order_item_id,
                'meta_key' => '_subtotal',
                'meta_value' => $this->subtotal
            ),
            array(
                'learnpress_order_item_id' => $order_item_id,
                'meta_key' => '_total',
                'meta_value' => $this->subtotal * $quantity
            )
            );

            foreach ($orders_meta_entries as $value) {
                $wpdb->insert($tbl_orders_meta, $value);
            }

            $returnArr['label'] = "order success!";
            $returnArr['value'] =  $this->createOrderCode($order_id,get_the_title($this->course_id));
            return $returnArr;
        return;
    }
    
    function vn_str_filter ($str){
        $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd'=>'đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i'=>'í|ì|ỉ|ĩ|ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
			'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D'=>'Đ',
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );

        foreach($unicode as $nonUnicode=>$uni){
                $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
        $str = str_replace( array( '\'', '"',',' , ';', '<', '>' ), '', strtolower($str));       
		$str = join("-",explode( " ", $str )); 

        return $str;
    }

     function createOrderCode($code,$title)
    {
        $clean_vnese = $this->vn_str_filter($title);
        $clean_vnese_arr = explode( "-", $clean_vnese );
        $first_char_str = '';

        foreach ($clean_vnese_arr as $value) {
            $first_char_str.= strtoupper($value[0]);
        }

        return '#'.$first_char_str.'-'.$code;
    }

    function setSuccessOrder($order_id = null){
        global $wpdb;
        $tbl_orders = $wpdb->prefix . 'posts';

        $odi = $order_id ? $order_id : $this->order_id;

        if($this->order_id || $order_id){
            $sql = $wpdb->prepare("UPDATE $tbl_orders SET `post_status` = 'lp-completed' where `ID` = {$odi} and `post_type` = 'lp_order'");
            $upd_id = $wpdb->query($sql);
            return $this->order_id;
        }
        return;
    }

    function getOrderBy(){


    }


    
}