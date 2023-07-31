<?php
class InstructorVars
{
    public $id;
    public $author_id;
    
    function __construct($parameters, $isAuthorId = false) {
        $this->id = $parameters;
        $post_author_id = get_field('teaching_main',$this->id) ? get_field('teaching_main',$this->id)->ID : get_post_field('post_author',$this->id);
        $this->author_id = $isAuthorId ? $parameters : $post_author_id;
    }
    
    public static function get_test() {
        return 'test=====';
    }

    public function get_full_name() {
        $author_fn = get_user_meta($this->author_id, 'first_name')[0];
        $author_ln = get_user_meta($this->author_id, 'last_name')[0];
        $user_name = get_userdata($this->author_id)->display_name;

        $author_fullname = $author_fn || $author_ln ? $author_fn . ' ' . $author_ln : $user_name;

        return $author_fullname; 
    }

    public function get_exps() {
        return get_field('exps', 'user_' . $this->author_id);
    }

    public function get_strengths() {
        return get_field('strengths', 'user_' . $this->author_id);
    }

    public function get_description() {
        return  get_field('ttcn_info', 'user_' . $this->author_id);
    }

    public function get_avatar_url() {
        $lp_profile_picture = get_field('vars_mentor_ava', 'user_' . $this->author_id);
        $ava_url = $lp_profile_picture ? $lp_profile_picture : get_template_directory_uri() . '/assets/images/image_notfound.png';
        return $ava_url;
    }

    public function get_socials() {
        $user_socials = get_user_meta($this->author_id, '_lp_extra_info', true);
        return $user_socials;
    }
    public function is_debut() {
        $is_debut = get_user_meta($this->author_id, 'debut', true);
        return $is_debut;
    }



}