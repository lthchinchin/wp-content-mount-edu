<?php
class questionDto extends postTypeDto
{
    public $lp_mark;
    public $lp_hint;
    public $lp_explanation;
    public $lp_type;
    
    public $lp_question_id;
    public $itemsAddon; /*string json '[{"title":"title sample of answer...","is_true":""},{}..]' section_id */


    function __construct($parameters) {
        parent::__construct($parameters);
        $this->lp_mark = isset($parameters['lp_mark']) && $parameters['lp_mark'] ? $parameters['lp_mark'] : 1;
        $this->lp_hint = isset($parameters['lp_hint']) && $parameters['lp_hint'] ? $parameters['lp_hint'] : '';
        $this->lp_explanation = isset($parameters['lp_explanation']) && $parameters['lp_explanation'] ? $parameters['lp_explanation'] : '';
        $this->lp_type = isset($parameters['lp_type']) && $parameters['lp_type'] ? $parameters['lp_type'] : 'true_or_false'; 
        /* true_or_false || multi_choice || single_choice || fill_in_blanks */

        $this->lp_question_id = isset($parameters['lp_question_id']) && $parameters['lp_question_id'] ? $parameters['lp_question_id'] : null;
        $this->itemsAddon =  isset($parameters['itemsAddon']) && $parameters['itemsAddon'] ? $parameters['itemsAddon'] : "";

    }

    function insert_question()
    {
        $id_insert = parent::insert_post();

        if($id_insert):
            update_post_meta($id_insert,'_lp_mark',$this->lp_mark);
            update_post_meta($id_insert,'_lp_hint',$this->lp_hint);
            update_post_meta($id_insert,'_lp_explanation',$this->lp_explanation);
            update_post_meta($id_insert,'_lp_type',$this->lp_type);
        endif;
        return $id_insert;
    }

    function update_question()
    { 
        $data = array(
            'ID' => $this->lp_question_id,
            'post_title' => $this->post_title,
            'post_content' => $this->post_content,
           );
        $id_update = wp_update_post( $data );

        if($id_update):
            update_post_meta($id_insert,'_lp_mark',$this->lp_mark);
            update_post_meta($id_insert,'_lp_hint',$this->lp_hint);
            update_post_meta($id_insert,'_lp_explanation',$this->lp_explanation);
            update_post_meta($id_insert,'_lp_type',$this->lp_type);
        endif;

        return $id_update;
    }

    function addon_answer_question(){
        global $wpdb;
        $table = $wpdb->prefix . 'learnpress_question_answers';
        $arrs = array();

        $results = $wpdb->get_results( "SELECT `order` FROM $table WHERE  `question_id` = {$this->lp_question_id} ORDER BY `order` DESC LIMIT 1" );

        $currentKeyQuestion = $results[0]->order;

        $itemsArr = json_decode($this->itemsAddon,true);

        foreach ($itemsArr as $item) {
            $currentKeyQuestion++;
            $data = array(
                'question_id' => $this->lp_question_id,
                'title' => $item['title'],
                'is_true' => $item['is_true'],
                'order' => $currentKeyQuestion
            );
            // print_r($data);
            array_push($arrs,$wpdb->insert($table,$data));
        }
        // print_r($results);
        return $arrs;
    }
    
}
