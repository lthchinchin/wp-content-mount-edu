<?php
class quizDto extends postTypeDto
{
    public $lp_duration;
    public $lp_preview;
    public $lp_pagination;
    public $lp_passing_grade;
    public $lp_quiz_id;
    public $quiz_id;
    public $itemsAddon; /*string json '[{"question_id":"456"},{}..]' section_id */
    public $quizSubmit; /*string json '[{"question_id":"456"},{}..]' section_id */
    

    function __construct($parameters) {
        parent::__construct($parameters);
        $this->lp_duration = isset($parameters['lp_duration']) && $parameters['lp_duration'] ? $parameters['lp_duration'] : '10 minute';
        $this->lp_preview = isset($parameters['lp_preview']) && $parameters['lp_preview'] ? $parameters['lp_preview'] : 'yes';
        $this->lp_pagination = isset($parameters['lp_pagination']) && $parameters['lp_pagination'] ? $parameters['lp_pagination'] : 1;
        $this->lp_passing_grade = isset($parameters['lp_passing_grade']) && $parameters['lp_passing_grade'] ? $parameters['lp_passing_grade'] : 50;

        $this->lp_quiz_id = isset($parameters['lp_quiz_id']) && $parameters['lp_quiz_id'] ? $parameters['lp_quiz_id'] : null;
        $this->itemsAddon =  isset($parameters['itemsAddon']) && $parameters['itemsAddon'] ? $parameters['itemsAddon'] : "";
        $this->quizSubmit =  isset($parameters['quizSubmit']) && $parameters['quizSubmit'] ? $parameters['quizSubmit'] : "";

        $this->quiz_id =  isset($parameters['quiz_id']) && $parameters['quiz_id'] ? $parameters['quiz_id'] : null;

    }

    function quiz_logged_valid(){
        $returnArr = array();
        if(!$this->quiz_id){       
            $returnArr['label'] = "expected a quiz id!";
            $returnArr['value'] = false;
            return $returnArr;
        }
        if(!$this->userid){
            $returnArr['label'] = "please loggin!";
            $returnArr['value'] = false;
            return $returnArr;
        }
    }

    function get_quizs()
    {
        $quizs = parent::get_all_post();
        foreach ($quizs['data'] as $key => $value) {

            $quiz_id = $value->ID;
            $value->attach_quiz = get_field('file_quiz',$quiz_id);

        }
        return $quizs;

    }

    function insert_quiz()
    {
        $id_insert = parent::insert_post();

        if($id_insert):
            update_post_meta($id_insert,'_lp_duration',$this->lp_duration);
            update_post_meta($id_insert,'_lp_pagination',$this->lp_pagination);
            update_post_meta($id_insert,'_lp_preview',$this->lp_preview);
            update_post_meta($id_insert,'_lp_passing_grade',$this->lp_passing_grade);
        endif;
        return $id_insert;
    }

    function update_quiz()
    { 
        $data = array(
            'ID' => $this->lp_quiz_id,
            'post_title' => $this->post_title,
            'post_content' => $this->post_content,
           );
        $id_update = wp_update_post( $data );

        if($id_update):
            update_post_meta($id_insert,'_lp_duration',$this->lp_duration);
            update_post_meta($id_insert,'_lp_pagination',$this->lp_pagination);
            update_post_meta($id_insert,'_lp_preview',$this->lp_preview);
            update_post_meta($id_insert,'_lp_passing_grade',$this->lp_passing_grade);
        endif;

        return $id_update;
    }

    function addon_question_quiz(){
        global $wpdb;
        $table = $wpdb->prefix . 'learnpress_quiz_questions';
        $arrs = array();

        $results = $wpdb->get_results( "SELECT `question_order` FROM $table WHERE  `quiz_id` = {$this->lp_quiz_id} ORDER BY `question_order` DESC LIMIT 1" );

        $currentKeyQuestion = $results[0]->question_order;

        $itemsArr = json_decode($this->itemsAddon,true);

        foreach ($itemsArr as $item) {
            $currentKeyQuestion++;
            $data = array(
                'quiz_id' => $this->lp_quiz_id,
                'question_id' => $item['question_id'],
                'question_order' => $currentKeyQuestion
            );
            array_push($arrs,$wpdb->insert($table,$data));
        }
        return $arrs;
    }

    function check_anwser_question($answer_id){
        global $wpdb;
        $table = $wpdb->prefix . 'learnpress_question_answers';
        $results = $wpdb->get_results( "SELECT `is_true` FROM $table WHERE `question_answer_id` = {$answer_id}" );
        return $results[0]->is_true == 'yes' ? true : false;
    }

    function get_list_anwser_by_question($quiz_id){
        global $wpdb;
        $table_quiz_questions = $wpdb->prefix . 'learnpress_quiz_questions';
        $table_question_answers = $wpdb->prefix . 'learnpress_question_answers';

        $questions = $wpdb->get_results( "SELECT `question_id` FROM $table_quiz_questions WHERE `quiz_id` = {$quiz_id}" );
        $arr = array();
        

        foreach ($questions as $question) {
            $obj = array();
            $obj['question_id'] = $question->question_id;
            $obj['question_title'] = get_the_title($question->question_id);

            $anwsers = $wpdb->get_results( "SELECT `question_answer_id`,`title`,`is_true` FROM $table_question_answers WHERE `question_id` = {$question->question_id} ORDER BY `order` ASC" );

            $obj['anwsers']= $anwsers;

            array_push($arr,$obj);
        }
        return $arr;
    }

    function save_exam_entries(){
        global $wpdb;
        $table_quiz_exam = $wpdb->prefix . 'quiz_exam';

        $time_per_request = 2;
        // echo '<pre>';
        // print_r($this->quizSubmit);
        // echo '</pre>';

        $returnArr = array();
        $this->quiz_logged_valid();

        $exm = json_encode($this->quizSubmit);
        $is_exist = $wpdb->get_results( "SELECT COUNT(*) AS count FROM `{$table_quiz_exam}` WHERE `user_id` = $this->userid AND `quiz_id` = {$this->quiz_id}" )[0]->count ? true : false;

        if($is_exist){
            // check overtime
            $exam_stt = $this->get_field_from_tbl_quiz_exam('exam_stt');
            $result = $this->get_field_from_tbl_quiz_exam('result');

            if(!$exam_stt && !$result){
                $returnArr['label'] = "time up, force submit your exam!";
                $returnArr['value'] = -1;
                return $returnArr;
            }

            if($exam_stt == 0){
                $returnArr['label'] = "this exam is submited!";
                $returnArr['value'] = -2;
                return $returnArr;
            }

            // upd
            $update_data = $wpdb->query($wpdb->prepare("UPDATE $table_quiz_exam SET `exam` = '{$exm}', `spend_time` = `spend_time`+$time_per_request  where `quiz_id` =  $this->quiz_id and `user_id` = $this->userid"));
            $returnArr['label'] = "success upd exist entry!";
            $returnArr['value'] = $update_data;
            return $returnArr;

        }else{ 
            
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $date = date('Y-m-d h:i:s', time());
            $duration_str = get_field('_lp_duration',$this->quiz_id);

			if ( preg_match( '~([0-9]+) (second|minute|hour|day|week)~', $duration_str, $m ) ) {
				$s = array(
					'second' => 1,
					'minute' => 60,
					'hour'   => 3600,
					'day'    => 3600 * 24,
					'week'   => 3600 * 24 * 7,
					'month'  => 3600 * 30,
				);
				$duration_time = $m[1] * $s[ $m[2] ];
			}

            // var_dump($duration_time);

            $data = array(
                'user_id' => $this->userid,
                'quiz_id' => $this->quiz_id,
                'exam' => json_encode($this->quizSubmit),
                'start_quiz' => $date,
                'duration_quiz' => $duration_time,
                // 'stop_quiz' =>  date('Y-m-d h:i:s', time()+$duration_time),
                'exam_stt' => 1
            );
            // echo '------';
            // var_dump($data);

            $wpdb->insert($table_quiz_exam,$data);

            $retake = get_field('_lp_retake_count',$this->quiz_id);
            $times = $this->get_field_from_tbl_quiz_exam('times');

            if($times < $retake || $retake == -1){
                $returnArr['label'] = "can retake($times/$retake)!";
                $returnArr['value'] = true;
                return $returnArr;
                
            }else{
                $returnArr['label'] = "retake limited!";
                $returnArr['value'] = false;
                return $returnArr;
            }

            $returnArr['label'] = "success create new entry!";
            $returnArr['value'] = $wpdb->insert_id;
            return $returnArr;
        }

    }

    function retake_the_exam(){
        global $wpdb;
        $table_quiz_exam = $wpdb->prefix . 'quiz_exam';

       
        
        $returnArr = array();
        $this->quiz_logged_valid();

        $retake = get_field('_lp_retake_count',$this->quiz_id);
        $times = $this->get_field_from_tbl_quiz_exam('times');
        $exam_stt =$this->get_field_from_tbl_quiz_exam('exam_stt');

        if($times < $retake || $retake == -1){

            if($exam_stt==1){
                $returnArr['label'] = "the exam is in progress!";
                $returnArr['value'] = false;
                return $returnArr;
            }

            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $date = date('Y-m-d h:i:s', time());
            // bat dau 1 phien lam bai
            $retake = $wpdb->query($wpdb->prepare("UPDATE $table_quiz_exam SET `exam` = '[]',`start_quiz` = '{$date}',`stop_quiz` = null,`spend_time` = 0,`exam_stt` = 1 WHERE `quiz_id` =  {$this->quiz_id} AND `user_id` = $this->userid"));
            $returnArr['label'] = "retake success!";
            $returnArr['value'] = true;
            return $returnArr;
        }else{
            $returnArr['label'] = "retake limited!";
            $returnArr['value'] = false;
            return $returnArr;
        }
    }

    function is_can_retake(){
        global $wpdb;
        $table_quiz_exam = $wpdb->prefix . 'quiz_exam';
        $returnArr = array();
        $this->quiz_logged_valid();

        $retake = get_field('_lp_retake_count',$this->quiz_id);
        $times = $this->get_field_from_tbl_quiz_exam('times');

        if($times < $retake || $retake == -1){
            $returnArr['label'] = "can retake($times/$retake)!";
            $returnArr['value'] = true;
            return $returnArr;
            
        }else{
            $returnArr['label'] = "retake limited!";
            $returnArr['value'] = false;
            return $returnArr;
        }
    }

    function get_continue_exam_entry(){
        global $wpdb;
        $table_quiz_exam = $wpdb->prefix . 'quiz_exam';
        $returnArr = array();
        $this->quiz_logged_valid();
        
        $is_can_continue = $this->get_field_from_tbl_quiz_exam('exam_stt');

        $has_entry = $wpdb->get_results( "SELECT count(*) as count FROM `{$table_quiz_exam}` WHERE `user_id` = $this->userid AND `quiz_id` = {$this->quiz_id}" )[0]->count;

        if(!$has_entry){
            $returnArr['label'] = "first-time";
            $returnArr['value'] = $result;
            return $returnArr;
        }
        
        if(intval($is_can_continue)==0){
            $result = $this->get_field_from_tbl_quiz_exam('result');

            $returnArr['label'] = "exam-finished";
            $returnArr['value'] = $result;
            return $returnArr;
        }

        $exam = $this->get_field_from_tbl_quiz_exam('exam');
        $returnArr['label'] = "exam-continue";
        $returnArr['value'] = $exam;
        return $returnArr;
    }

    function get_results_exam(){
        global $wpdb;
        $table_quiz_exam = $wpdb->prefix . 'quiz_exam';
        $returnArr = array();
        $this->quiz_logged_valid();

        $results = $this->get_field_from_tbl_quiz_exam('result'); 

        $returnArr['label'] = "get results list";
        $returnArr['value'] = $results;
        return $returnArr;
    }

    function submit_anwsers(){

        global $wpdb;
        $table_user_item_results = $wpdb->prefix . 'learnpress_user_item_results';
        $table_quiz_exam = $wpdb->prefix . 'quiz_exam';
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = date('Y-m-d h:i:s', time());
       
        
        $returnArr = array();
        $this->quiz_logged_valid();

        
        /* check correct || incorrect */
        $arrReturn = array();
        $questionCorrect = 0;
        // question w anwser list
        $questions = (new quizDto($parameters))->get_list_anwser_by_question($this->quiz_id);
        // arr submit question id & answered id
        $submitQuestionId = array_column($this->quizSubmit,'questionId');
        $submitAnswered = array_column($this->quizSubmit,'answered');

        // arr expected(correct) answered id 
        $expect_results = $this->result_by_quiz_id($this->quiz_id);
        $expect_result_ids = array_column($expect_results,'question_answer_id');

        // incorrect question return 
        $incorrectObj = array();
        $incorrectQues = array();

        // loop qua ket qua dung de check submit
        foreach($expect_results as $expect_item){
            $incorrectQesIds= array_unique(array_column($incorrectQues,'question_id'));
            $question_answer_id = $expect_item->question_answer_id;

            //  cau tra loi dung khong co trong submit -> ban da lam cau nay sai
            if (!in_array($question_answer_id, $submitAnswered)){
                if(!in_array($expect_item->question_id, $incorrectQesIds)){

                    $key = array_search($expect_item->question_id, $submitQuestionId);

                    $incorrectObj['question_id'] = $expect_item->question_id;
                    $incorrectObj['expected_answer_id'] = $expect_item->question_answer_id;
                    $incorrectObj['answerd_id'] = $submitAnswered[$key];

                    // arr nhung cau ban lam sai
                    array_push($incorrectQues,  $incorrectObj);
                }
                
            }
        }

        // var_dump($incorrectQues);

        // case multi select
        if(count($submitAnswered) > count($expect_result_ids)){
            // arr nhung cau sai cua multi select
            $array_diff = array_diff($submitAnswered,$expect_result_ids);

            foreach($array_diff as $diff_item){
                $incorrectQesIds= array_unique(array_column($incorrectQues,'question_id'));
    
                $question_answer_id = $diff_item;
                $key = array_search($question_answer_id, $submitAnswered);
            
                    if(!in_array($submitQuestionId[$key], $incorrectQesIds)){
                        $incorrectObj['question_id'] = $submitQuestionId[$key];
                        $incorrectObj['expected_answer_id'] = null;
                        $incorrectObj['answer_id'] = null;

                        // arr nhung cau ban lam sai
                        array_push($incorrectQues,  $incorrectObj);
                    }  
            }
        }

        /* return data */
        $passing_grade = (int)get_field('_lp_passing_grade',$this->quiz_id);
        $question_count = count($questions);
        $question_wrong = count($incorrectQues);
        $question_answered = count(array_unique($submitQuestionId));
        $question_empty = $question_count-$question_answered;
        $questionCorrect = $question_count - $question_wrong; 
        $user_mark = round(($questionCorrect / $question_count)*100,1) ;

        $result_noti = $user_mark < $passing_grade ? 'fail' : 'pass';

        $arrReturn['quiz_id'] = $this->quiz_id;
        $arrReturn['incorrect_answers'] = $incorrectQues;
        $arrReturn['passing_grade'] = $passing_grade;
        $arrReturn['mark'] = $user_mark;
        $arrReturn['user_mark']= $user_mark;
        $arrReturn['question_count']= $question_count;
        $arrReturn['question_empty']= $question_empty;
        $arrReturn['question_answered']= $question_answered;
        $arrReturn['question_wrong']= $question_wrong;
        $arrReturn['question_correct']= $questionCorrect;
        $arrReturn['result']= $result_noti;
        $spend_time = $this->get_field_from_tbl_quiz_exam('spend_time');
        $arrReturn['spend_time']= $spend_time;
        $startTime =$this->get_field_from_tbl_quiz_exam('start_quiz');
        $arrReturn['start_quiz'] = $startTime;
        $arrReturn['stop_quiz'] = $date;
        
        // check da tung lam bai lan nao chua, de luu ket qua
        $resultArrJson = $this->get_field_from_tbl_quiz_exam('result');
        $resultArr = json_decode($resultArrJson);
        if(!$resultArr){
            $result = json_encode(array($arrReturn));
        }else{
            array_push($resultArr,$arrReturn);
            $result = json_encode($resultArr);
        }

        $times = count(json_decode($result));
        $update_data = $wpdb->query($wpdb->prepare("UPDATE $table_quiz_exam SET `result` = '{$result}',`stop_quiz` = '{$date}',`spend_time` = `duration_quiz`,`times` = $times WHERE `quiz_id` =  {$this->quiz_id} AND `user_id` = $this->userid"));
        
        // set completed status_owner_course after submit quiz
        if($result_noti === 'pass'){
            $course_id = (new courseDto($parameters))->get_course_by_quiz_id($this->quiz_id);
            $set_completed = (new courseDto($parameters))->set_completed_status_owner_course($course_id);
        }
        
        $arrReturn['save_result_stt'] = $update_data;
        $returnArr['label'] = "submit success!";
        $returnArr['value'] = $arrReturn;   
        return $returnArr;
    }

    function result_by_quiz_id($id){
        global $wpdb;
        $table_quiz_questions = $wpdb->prefix . 'learnpress_quiz_questions';
        $table_question_answers = $wpdb->prefix . 'learnpress_question_answers';

        $entries = $wpdb->get_results( 
            "SELECT a.`quiz_id`, a.`question_id` , `question_answer_id` , `title` 
             FROM `{$table_quiz_questions}` 
             AS a JOIN `{$table_question_answers}` AS b ON a.`question_id` = b.`question_id`
             WHERE a.`quiz_id` = {$id} AND b.`is_true` = 'yes'
             "
        );
        return $entries;
    }

    function is_question_multi_select($id){
        global $wpdb;
        $table_question_answers = $wpdb->prefix . 'learnpress_question_answers';
        
        $anwsers = $wpdb->get_results( "SELECT count(*) as count FROM $table_question_answers WHERE `question_id` = {$id} AND `is_true` = 'yes'" );

        return $anwsers[0]->count > 1 ? true : false; 
    }

    function get_count_down_quiz(){
        global $wpdb;
        $table_quiz_exam = $wpdb->prefix . 'quiz_exam';
       
        
        $returnArr = array();
        $this->quiz_logged_valid();

        $count_down = $this->get_field_from_tbl_quiz_exam('count_down');

        $returnArr['label'] = "quiz finish after this count down!";
        $returnArr['value'] = $count_down;
        return $returnArr;
    }
    
    function get_field_from_tbl_quiz_exam($fieldName){
        global $wpdb;
        $table_quiz_exam = $wpdb->prefix . 'quiz_exam';
        return $wpdb->get_results("SELECT `$fieldName` FROM $table_quiz_exam WHERE `quiz_id` =  {$this->quiz_id} AND `user_id` = $this->userid")[0]->$fieldName;
    }



}